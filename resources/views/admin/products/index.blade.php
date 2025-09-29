<x-app-layout>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Products Management</h1>
            <a href="{{ route('products.create') }}" 
               class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
               + Add New Product
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 flex gap-4">
            <form method="GET" action="{{ route('products.index') }}" class="flex gap-2">
                <input type="text" name="search" placeholder="Search by name" 
                       value="{{ old('search', $search) }}" 
                       class="px-4 py-2 border border-gray-300 rounded">
                
                <select name="added_by" class="px-4 py-2 border border-gray-300 rounded">
                    <option value="">Filter by Added By</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" @selected($user->id == $addedByFilter)>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                <input type="date" name="date_added" value="{{ old('date_added', $dateFilter) }}" 
                       class="px-4 py-2 border border-gray-300 rounded">
                
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Apply Filters</button>
            </form>
        </div>

        @if($products->count())
            <table class="min-w-full border border-gray-300 rounded-md overflow-hidden shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">ID</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Name</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Category</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Price (USD)</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Added By</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Date Added</th>
                        <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr>
                            <td class="p-3 text-sm text-gray-700">{{ $product->id }}</td>
                            <td class="p-3 text-sm text-gray-900 font-medium">{{ $product->name }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $product->category->name ?? 'N/A' }}</td>
                            <td class="p-3 text-sm text-gray-700">${{ number_format($product->price_usd, 2) }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $product->addedByUser->name ?? 'N/A' }}</td>
                            <td class="p-3 text-sm text-gray-700">{{ $product->created_at->toDateString() }}</td>
                            <td class="p-3 text-sm text-gray-700 flex gap-3">
                                <a href="{{  route('product.view', ['category' => $product->category->slug, 'slug' => $product->slug]) }}" 
                                   class="text-green-600 hover:text-green-900 font-semibold">View</a>

                                <a href="{{ route('products.edit', $product) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>

                                <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="text-red-600 hover:text-red-900 font-semibold">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination links --}}
            {{ $products->links() }}
        @else
            <p class="text-gray-500 text-center py-12">No products found.</p>
        @endif
    </div>
</x-app-layout>
