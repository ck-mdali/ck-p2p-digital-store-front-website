<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Orders Management</h1>
            
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filters --}}
        <div class="mb-6 flex gap-4">
            <form method="GET" action="{{ route('admin.console') }}" class="flex flex-wrap gap-2">
                <input type="text" name="search" placeholder="Search by user name" 
                       value="{{ request('search') }}" 
                       class="px-4 py-2 border border-gray-300 rounded">

                <select name="status" class="px-4 py-2 border border-gray-300 rounded">
                    <option value="">All Statuses</option>
                    @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>

                <input type="date" name="date" value="{{ request('date') }}" 
                       class="px-4 py-2 border border-gray-300 rounded">

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Apply Filters</button>
            </form>
        </div>

        {{-- Orders Table --}}
        @if($orders->count())
            <table class="min-w-full border border-gray-300 rounded-md overflow-hidden shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b">Order ID</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b">Product</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b">User</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b">Amount (USD / INR)</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b">Payment Type</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b">Status</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b">Date</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr>
                            <td class="p-3 text-sm text-gray-700">
                                {{ $order->id }}
                                @if($order->admin_read == 0)
                                    <span class="ml-2 inline-block w-3 h-3 bg-red-500 rounded-full" title="New Order"></span>
                                @endif

                            </td>
                            <td class="p-3 text-sm text-gray-900">
                                {{ $order->product->name ?? 'N/A' }}
                            </td>
                            <td class="p-3 text-sm text-gray-700">
                                {{ $order->user->name ?? 'Guest' }}
                            </td>
                            <td class="p-3 text-sm text-gray-700">
                                {{ $order->formatted_amount_usd }} / {{ $order->formatted_amount_inr }}
                            </td>
                            <td class="p-3 text-sm text-gray-700">
                                {{ $order->paymentType->name ?? 'N/A' }}
                            </td>
                            <td class="p-3 text-sm text-gray-700 capitalize">
                                 <span class="px-3 py-1 text-xs font-semibold rounded 
                                        @if($order->status == 'new') bg-orange-300
                                        @elseif($order->status == 'pending') bg-indigo-300 
                                        @elseif($order->status == 'completed') bg-green-300 
                                         @elseif($order->status == 'denied') bg-red-300 
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                            </td>
                            <td class="p-3 text-sm text-gray-700">{{ $order->created_at->toDateString() }}</td>
                            <td class="p-3 text-sm text-gray-700 flex gap-3">
                                <a href="{{ route('p2p.order', $order->id) }}" 
                                   class="text-green-600 hover:text-green-900 font-semibold">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @else
            <p class="text-gray-500 text-center py-12">No orders found.</p>
        @endif
    </div>
    <audio id="newMessageSound" src="/assets/audio/ams.mp3" preload="auto"></audio>

</x-app-layout>
<script>
    let hasPlayed = false; // To avoid sound on initial load if you want

    function checkForNewOrders() {
        fetch("{{ route('admin.console.check.pool') }}", {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.new_orders && !hasPlayed) {
                const sound = document.getElementById('newMessageSound');
                sound.play();
                // hasPlayed = true; // So it doesn't keep playing
            }
        })
        .catch(error => {
            console.error('Error checking for new orders:', error);
        });
    }

    // Check every 10 seconds
    setInterval(checkForNewOrders, 6000);
</script>
