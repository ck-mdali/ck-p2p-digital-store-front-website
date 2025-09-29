<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadsController extends Controller
{
    /**
     * Display the downloads page with a list of verified orders.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Fetch verified orders for the authenticated user, with search functionality
        $ordersQuery = Order::where('user_id', Auth::id())
                            ->where('status', 'completed') // Only get verified orders
                            ->with('product'); // Eager load the product data

        // If there is a search query, apply the filter
        if ($search) {
            $ordersQuery->whereHas('product', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        // Execute the query and get the results
        $orders = $ordersQuery->get();

        // Pass the orders data and the search term to the view
        return view('downloads.index', compact('orders', 'search'));
    }

    public function download($order_id)
    {
        // Find the order
        $order = Order::find($order_id);

        // Ensure the order belongs to the authenticated user and is verified
        if (!$order || $order->user_id !== Auth::id() || $order->status !== 'completed') {
            return redirect()->route('downloads.index')->with('error', 'Invalid order or access denied.');
        }

        // Get the product associated with the order
        $product = $order->product;

        // Check if the product has a download path (ensure it's stored securely)
        if (!$product || !$product->download_path || !file_exists($product->download_path)) {
            return redirect()->route('downloads.index')->with('error', 'No download available for this product.');
        }

        // Return the file as a download response
        return response()->download($product->download_path);
    }
    
}
