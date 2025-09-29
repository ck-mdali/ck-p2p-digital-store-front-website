<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Header Section -->
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-semibold text-gray-900">P2P Orders</h1>
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
<div class="flex gap-4 mb-6 items-center justify-between flex-wrap">
    <form method="GET" action="{{ route('p2p.index') }}" class="flex gap-4 w-full max-w-4xl">
        <!-- Search input -->
        <input type="text" name="search" placeholder="Search by Product Name" 
               value="{{ old('search', $search) }}" 
               class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm w-full md:max-w-xs">

        <!-- Status select -->
        <select name="status" class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 text-sm w-40">
            <option value="">Status</option>
            <option value="new" @selected('new' == $statusFilter)>New</option>
            <option value="pending" @selected('pending' == $statusFilter)>Pending</option>
            <option value="completed" @selected('completed' == $statusFilter)>Completed</option>
        </select>

        <!-- Date range input -->
        <input type="date" name="date_range" value="{{ old('date_range', $dateFilter) }}" 
               class="px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 text-sm w-40">

        <!-- Apply Filter button -->
        <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 transition duration-200 text-sm">
            Apply Filters
        </button>
    </form>

    <!-- Export and Print Buttons Section -->
    <div class="flex gap-4 mt-4 md:mt-0">
        <a href="{{ route('p2p.exportOrdersExcel', ['search' => $search, 'status' => $statusFilter, 'date_range' => $dateFilter]) }}" 
           class="bg-green-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-green-700 transition duration-200 text-sm">
            Export to Excel
        </a>

        <a href="{{ route('p2p.exportOrdersPDF', ['search' => $search, 'status' => $statusFilter, 'date_range' => $dateFilter]) }}" 
           class="bg-blue-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-blue-700 transition duration-200 text-sm">
            Export to PDF
        </a>

        <a href="{{ route('p2p.printOrders', ['search' => $search, 'status' => $statusFilter, 'date_range' => $dateFilter]) }}" 
           class="bg-gray-600 text-white px-6 py-3 rounded-md shadow-md hover:bg-gray-700 transition duration-200 text-sm">
            Print Orders
        </a>
    </div>
</div>



        <!-- Table Section -->
        @if($orders->count())
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-4 text-left text-sm font-medium">Order ID</th>
                            <th class="p-4 text-left text-sm font-medium">Product</th>
                            <th class="p-4 text-left text-sm font-medium">Price (USD)</th>
                            <th class="p-4 text-left text-sm font-medium">Status</th>
                            <th class="p-4 text-left text-sm font-medium">Placed On</th>
                            <th class="p-4 text-left text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($orders as $order)
                            <tr class="border-t hover:bg-gray-50 transition duration-200">
                                <td class="p-4 text-sm">#112211-{{ $order->id }}</td>
                                <td class="p-4 text-sm font-medium text-indigo-600">
                                    <a target="__blank" href="{{ route('product.view', ['category' => $order->product->category->slug ?? 'uncategorized', 'slug' => $order->product->slug ?? 'unknown']) }}">
                                        {{ $order->product->name ?? 'N/A' }}
                                    </a>
                                </td>
                                <td class="p-4 text-sm">${{ number_format($order->amount_usd, 2) }}</td>
                                <td class="p-4 text-sm">
                                    <span class="px-3 py-1 text-xs font-semibold rounded 
                                        @if($order->status == 'new') bg-orange-300
                                        @elseif($order->status == 'pending') bg-indigo-300 
                                        @elseif($order->status == 'completed') bg-green-300 
                                         @elseif($order->status == 'denied') bg-red-300 
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm">{{ $order->created_at->toDateString() }}</td>
                                <td class="p-4 text-sm flex gap-3">
    <a target="__blank" href="{{ route('p2p.order', ['id' => $order->id]) }}" 
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
    {{ $orders->links() }}
</div>
        @else
            <p class="text-center text-gray-500 py-8">No orders found.</p>
        @endif
    </div>
</x-app-layout>
