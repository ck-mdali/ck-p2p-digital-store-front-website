<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-900">Transactions</h1>
        </div>

        <!-- Flash Message Section -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-md text-sm">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg shadow-md text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filter Form Section -->
        <div class="flex gap-4 mb-6 items-center">
            <form method="GET" action="{{ route('transactions.index') }}" class="flex gap-4 w-full max-w-4xl mx-auto">
                <!-- Search input -->
                <input type="text" name="search" placeholder="Search by Transaction ID or Order ID" 
                    value="{{ old('search', $search) }}" 
                    class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm w-full max-w-xs">

                <!-- Status select -->
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 text-sm w-36">
                    <option value="">Status</option>
                    <option value="pending" @selected('pending' == $statusFilter)>Pending</option>
                    <option value="completed" @selected('completed' == $statusFilter)>Completed</option>
                    <option value="failed" @selected('failed' == $statusFilter)>Failed</option>
                    <option value="cancelled" @selected('cancelled' == $statusFilter)>Cancelled</option>
                </select>

                <!-- Payment Type select -->
                <select name="payment_type" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 text-sm w-36">
                    <option value="">Payment Type</option>
                    @foreach($paymentTypes as $paymentType)
                        <option value="{{ $paymentType->id }}" @selected($paymentType->id == $paymentTypeFilter)>
                            {{ $paymentType->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Apply Filter button -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition duration-200 text-sm">
                    Apply Filters
                </button>
            </form>
        </div>

        <!-- Table Section -->
        @if($transactions->count())
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-4 text-left text-sm font-medium">Transaction ID</th>
                            <th class="p-4 text-left text-sm font-medium">Order ID</th>
                            <th class="p-4 text-left text-sm font-medium">Amount (USD)</th>
                            <th class="p-4 text-left text-sm font-medium">Payment Type</th>
                            <th class="p-4 text-left text-sm font-medium">Status</th>
                            <th class="p-4 text-left text-sm font-medium">Date</th>
                            <th class="p-4 text-left text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($transactions as $transaction)
                            <tr class="border-t hover:bg-gray-50 transition duration-200">
                                <td class="p-4 text-sm">{{ $transaction->trx_id }}</td>
                                <td class="p-4 text-sm">{{ $transaction->order_id }}</td>
                                <td class="p-4 text-sm">${{ number_format($transaction->amount_usd, 2) }}</td>
                                <td class="p-4 text-sm">{{ $transaction->paymentType->name ?? 'N/A' }}</td>
                                <td class="p-4 text-sm">
                                    <span class="px-3 py-1 text-xs font-semibold rounded 
                                        @if($transaction->status == 'pending') bg-orange-300
                                        @elseif($transaction->status == 'completed') bg-green-300
                                        @elseif($transaction->status == 'failed') bg-red-300
                                        @elseif($transaction->status == 'cancelled') bg-gray-300
                                        @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm">{{ $transaction->created_at->diffForHumans() }}</td>
                                <td class="p-4 text-sm flex gap-3">
                                    <a href="{{ route('p2p.order', $transaction->order->id) }}" 
                                       class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md text-sm font-semibold text-center hover:bg-indigo-700 transition duration-200">
                                        View
                                    </a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        @else
            <p class="text-center text-gray-500 py-8">No transactions found.</p>
        @endif
    </div>
</x-app-layout>
