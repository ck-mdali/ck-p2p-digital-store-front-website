<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\DB;

use App\Mail\OrderPlacedMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMarkedPaidMail;
use App\Mail\OrderStatusUpdatedMail;

class P2pController extends Controller
{

    public function index(Request $request)
    {
        // if(Auth::user()->role != 'user'){
        //     return redirect()->route('dashboard')->with('error', 'Access denied.');
        // }   
        // Get search input from the user
        $search = $request->input('search');
        $statusFilter = $request->input('status');
        $dateFilter = $request->input('date_range');
        
        // Start building the query
        $ordersQuery = Order::where('user_id', Auth::id())->with('product')->orderBy('created_at', 'desc');
        
        // Apply search filter if provided
        if ($search) {
            $ordersQuery->whereHas('product', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        
        // Apply status filter if provided
        if ($statusFilter) {
            $ordersQuery->where('status', $statusFilter);
        }

        // Apply date range filter if provided
        if ($dateFilter) {
            $ordersQuery->whereDate('created_at', '=', $dateFilter);
        }

        // Get the filtered orders
        $orders = $ordersQuery->paginate(8); // Pagination with 10 orders per page

        // Pass data to the view
        return view('p2p.index', compact('orders', 'search', 'statusFilter', 'dateFilter'));
    }

    /**
     * Show the P2P checkout page for a specific product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function checkout($id)
    {
        // Find the product by ID
        $product = Product::find($id);

        // If the product doesn't exist, redirect to a 404 page
        if (!$product) {
            return redirect()->route('page.404');
        }

        // Get payment types (you can customize this query as per your need)
        $paymentTypes = PaymentType::where('status', 'active')->get();

        return view('p2p.checkout', compact('product', 'paymentTypes'));
    }

    /**
     * Handle the order creation and payment type selection.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function orderCreate(Request $request, $product_id)
    {
        // Find the product by ID
        $product = Product::find($product_id);

        // If the product doesn't exist, redirect to a 404 page
        if (!$product) {
            return redirect()->route('page.404');
        }

        // Validate the order request
        $request->validate([
            // 'payment_type_id' => 'required|exists:payment_types,id', // Ensure the payment type is valid
            'agree' => 'accepted', // Validate the agreement checkbox
        ]);

        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to place an order.');
        }

        // Get the payment type
        // $paymentType = PaymentType::find($request->payment_type_id);

        // Create the new order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->product_id = $product->id;
        $order->status = 'new'; // The order is "new" initially
        $order->amount_usd = $product->price_usd; // Assuming the product has these fields
        $order->amount_inr = $product->price_inr;
        // $order->payment_type_id = 1;
        $order->notes = $request->notes; // Optional: Allow users to add notes (can be null)
        $order->save();

        Mail::to(Auth::user()->email)->send(new OrderPlacedMail($order));

        // Redirect to the P2P order page with the order ID
        return redirect()->route('p2p.order', ['id' => $order->id])
                         ->with('success', 'Order placed successfully!');
    }

    /**
     * Show the P2P order page with the details and payment instructions.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function order($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        $user = Auth::user();

        // If the order doesn't exist or doesn't belong to the authenticated user, redirect to 404
         if ($user->id !== $order->user_id && $user->role !== 'admin') {
            return route('login');
        }

        // update admin has saw the order
        if($user->role == 'admin' && $order->admin_read == 0){
            $order->admin_read = 1;
            $order->save();
        }

        // Fetch the payment type and product details
        $paymentTypes = PaymentType::where('status', 'active')->get();
        $product = $order->product;

        return view('p2p.order', compact('order', 'paymentTypes', 'product', 'user'));
    }

    public function orderUpdatePaid(Request $request)
    {
        // Validate the request
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'payment_mode' => 'required',
        ]);

        // Find the order
        $order = Order::find($request->order_id);

        // Ensure the order belongs to the authenticated user
        if ($order->user_id != Auth::id()) {
            return redirect()->route('page.404');
        }

        // Update the order status
        $order->status = 'pending';
        $order->payment_type_id = $request->payment_mode;
        $order->save();

        Mail::to(Auth::user()->email)->send(new OrderMarkedPaidMail($order));

        return redirect()->route('p2p.order', ['id' => $order->id])
                         ->with('success', 'Order Marked as Paid!');
    }

    public function exportOrdersExcel(Request $request)
    {
        // Apply filters to the query if any
        $search = $request->input('search');
        $statusFilter = $request->input('status');
        $dateFilter = $request->input('date_range');
        
        $ordersQuery = Order::where('user_id', Auth::id())->with('product');
        
        if ($search) {
            $ordersQuery->whereHas('product', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($statusFilter) {
            $ordersQuery->where('status', $statusFilter);
        }

        if ($dateFilter) {
            $ordersQuery->whereDate('created_at', '=', $dateFilter);
        }

        $orders = $ordersQuery->get(); // Get all filtered orders

        // Export to Excel
        return Excel::download(new OrdersExport($orders), 'orders.xlsx');
    }

    public function exportOrdersPDF(Request $request)
    {
        // Apply filters to the query if any
        $search = $request->input('search');
        $statusFilter = $request->input('status');
        $dateFilter = $request->input('date_range');
        
        $ordersQuery = Order::where('user_id', Auth::id())->with('product');
        
        if ($search) {
            $ordersQuery->whereHas('product', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($statusFilter) {
            $ordersQuery->where('status', $statusFilter);
        }

        if ($dateFilter) {
            $ordersQuery->whereDate('created_at', '=', $dateFilter);
        }

        $orders = $ordersQuery->get(); // Get all filtered orders

        // Share data with the view
        $pdf = PDF::loadView('p2p.orders_pdf', compact('orders'));

        // Return the PDF
        return $pdf->download('orders.pdf');
    }

    public function printOrders(Request $request)
    {
        // Get the filtered orders from the request (use the same filters applied in the index)
        $search = $request->input('search');
        $statusFilter = $request->input('status');
        $dateFilter = $request->input('date_range');

        // Build the query based on the filters
        $ordersQuery = Order::where('user_id', Auth::id())->with('product')->orderBy('created_at', 'desc');

        if ($search) {
            $ordersQuery->whereHas('product', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($statusFilter) {
            $ordersQuery->where('status', $statusFilter);
        }

        if ($dateFilter) {
            $ordersQuery->whereDate('created_at', '=', $dateFilter);
        }

        // Fetch the orders
        $orders = $ordersQuery->get(); // No need for pagination since it's for printing

        // Pass the orders data to the view
        return view('p2p.print_orders', compact('orders'));
    }

    public function adminConsole()
    {
        if(Auth::user()->role != 'admin'){
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }   

        $orders = Order::with('user', 'product')->orderBy('created_at', 'desc')->paginate(26);
        return view('admin.console', compact('orders'));

    }

    public function adminMarkOrder(Request $request)
    {
        if(Auth::user()->role != 'admin'){
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        } 

        // Validate the request first
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required'
        ]);

        $order = Order::find($request->order_id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // If already verified, prevent duplicate transaction
        if ($order->status == 'completed' && $request->status == 'completed') {
            return redirect()->back()->with('error', 'Order already verified.');
        }

        try {
            DB::transaction(function () use ($order, $request) {
                // Update order status
                $order->status = $request->status;
                $order->save();

                // Create transaction entry
                \App\Models\Transaction::create([
                    'order_id'       => $order->id,
                    'user_id'        => $order->user_id,
                    'verified_by'    => Auth::id(),
                    'amount_usd'     => $order->amount_usd,
                    'amount_inr'     => $order->amount_inr,
                    'payment_type_id'=> $order->payment_type_id,
                    'trx_id'         => 'TRX' . strtoupper(uniqid()), // Dummy trx ID
                    'notes'          => 'Order updated by admin.',
                    'status'         => $request->status === 'completed' ? 'verified' : 'denied',
                ]);
            });

        } catch (\Exception $e) {
            // Log the error or handle it accordingly
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    public function checkNew()
    {
        if(Auth::user()->role != 'admin'){
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }   
        $newOrderExists = Order::where('admin_read', 0)->exists();
        return response()->json([
            'new_orders' => $newOrderExists
        ]);
    }

}