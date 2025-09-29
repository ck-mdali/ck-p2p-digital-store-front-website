<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Header Section -->
        <h1 class="text-3xl font-semibold text-gray-900 mb-6">My Downloads</h1>

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

        <!-- Search Form Section -->
        <div class="mb-6">
            <form method="GET" action="{{ route('downloads.index') }}" class="flex gap-4 w-full max-w-4xl mx-auto">
                <!-- Search input -->
                <input type="text" name="search" placeholder="Search by Product Name" 
                    value="{{ old('search', $search) }}" 
                    class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm w-full max-w-xs">
                
                <!-- Search button -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition duration-200 text-sm">
                    Search
                </button>

                <!-- Reset button -->
                <a href="{{ route('downloads.index') }}" 
                   class="inline-block bg-gray-400 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-500 transition duration-200 text-sm">
                    Reset
                </a>
            </form>
        </div>

        <!-- Orders Table Section -->
        @if($orders->count())
            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-4 text-left text-sm font-medium">Product</th>
                            <th class="p-4 text-left text-sm font-medium">Date</th>
                            <th class="p-4 text-left text-sm font-medium">Download</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($orders as $order)
                            <tr class="border-t hover:bg-gray-50 transition duration-200">
                                <td class="p-4 text-sm font-medium text-indigo-600">
                                    <a target="__blank" href="{{ route('product.view', ['category' => $order->product->category->slug ?? 'uncategorized', 'slug' => $order->product->slug ?? 'unknown']) }}">
                                        {{ $order->product->name ?? 'N/A' }}
                                    </a>
                                </td>
                                <td class="p-4 text-sm">{{ $order->created_at->diffForHumans() }}</td>
                                <td class="p-4 text-sm">
                                    @if($order->product && $order->product->download_path)
                                        <a href="{{ route('downloads.download', ['order_id' => $order->id]) }}"
                                           class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-semibold text-center hover:bg-blue-700 transition duration-200">
                                            Download
                                        </a>
                                    @else
                                        <span class="text-gray-500">No Download Available</span>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500 py-8">No downloadable products found.</p>
        @endif
    </div>
</x-app-layout>
