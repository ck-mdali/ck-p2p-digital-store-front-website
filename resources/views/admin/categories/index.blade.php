<x-app-layout>
<div class="w-full max-w-full px-6 py-8 mx-auto">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between md:items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-900">Categories Management</h1>

            <div class="flex gap-4">
                <form method="GET" class="flex">
                    <input type="text" name="search" placeholder="Search..."
                        value="{{ request('search') }}"
                        class="border border-gray-300 rounded-l px-4 py-2 focus:outline-none focus:ring-1 focus:ring-green-500"
                    />
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-r hover:bg-green-700 transition">
                        Search
                    </button>
                </form>

                <a href="{{ route('categories.create') }}" 
                   class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                   + Add New Category
                </a>
            </div>
        </div>

        {{-- Flash message --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        @if($categories->count())
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 rounded-md overflow-hidden shadow-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">ID</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Image</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Name</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Slug</th>
                            <th class="p-3 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($categories as $category)
                            <tr>
                                <td class="p-3 text-sm text-gray-700">{{ $category->id }}</td>
                                <td class="p-3">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}"
     alt="{{ $category->name }}"
     style="height: 50px; width: auto;"
     class="rounded-md shadow-sm object-cover" />

                                    @else
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    @endif
                                </td>
                                <td class="p-3 text-sm text-gray-900 font-medium">{{ $category->name }}</td>
                                <td class="p-3 text-sm text-gray-700">{{ $category->slug ?? '-' }}</td>
                                <td class="p-3 text-sm text-gray-700 flex gap-3">
                                    <a href="{{ route('categories.edit', $category) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 font-semibold">Edit</a>

                                    <form method="POST" action="{{ route('categories.destroy', $category) }}" 
                                          onsubmit="return confirm('Are you sure?');">
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
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $categories->links() }}
            </div>
        @else
            <p class="text-gray-500 text-center py-12">No categories found.</p>
        @endif

    </div>
</x-app-layout>
