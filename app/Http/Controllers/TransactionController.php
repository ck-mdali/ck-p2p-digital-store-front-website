<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Order;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;


class TransactionController extends Controller
{
    public function index(Request $request)
{
    $search = $request->get('search');
    $statusFilter = $request->get('status');
    $paymentTypeFilter = $request->get('payment_type');

    $transactions = Transaction::query()
        ->when($search, function ($query, $search) {
            return $query->where('trx_id', 'like', "%$search%")
                         ->orWhere('order_id', 'like', "%$search%");
        })
        ->when($statusFilter, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->when($paymentTypeFilter, function ($query, $paymentType) {
            return $query->where('payment_type_id', $paymentType);
        })
        ->latest()
        ->paginate(10);

    $paymentTypes = PaymentType::all();

    return view('transactions.index', compact('transactions', 'search', 'statusFilter', 'paymentTypeFilter', 'paymentTypes'));
}

    // Create a new transaction
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'amount_usd' => 'required|numeric',
            'amount_inr' => 'required|numeric',
            'payment_type_id' => 'required|exists:payment_types,id', // Ensure it exists in payment_types
            'trx_id' => 'required|string|unique:transactions',
        ]);

        // Create a new transaction for the order
        $transaction = Transaction::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'verified_by' => null, // Set after admin verifies payment
            'amount_usd' => $request->amount_usd,
            'amount_inr' => $request->amount_inr,
            'payment_type_id' => $request->payment_type_id,
            'trx_id' => $request->trx_id,
            'notes' => $request->notes,
            'status' => 'pending', // Set the initial status as pending
        ]);

        return redirect()->route('p2p.index')->with('success', 'Transaction Created Successfully');
    }

    // Admin verifies the payment
    public function verify(Transaction $transaction)
    {
        // Only an admin can verify a transaction
        $this->authorize('verify', Transaction::class);

        $transaction->update([
            'verified_by' => auth()->id(),
            'status' => 'completed',
        ]);

        return redirect()->route('p2p.index')->with('success', 'Payment Verified');
    }
}
