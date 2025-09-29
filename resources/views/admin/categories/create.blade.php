<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">

        <h1 class="text-2xl font-bold text-gray-900 mb-6">➕ Add New Category</h1>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded shadow-sm">
                @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}"
                       class="w-full mt-1 p-2 border border-gray-300 rounded shadow-sm">
                @error('slug') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3"
                          class="w-full mt-1 p-2 border border-gray-300 rounded shadow-sm">{{ old('description') }}</textarea>
                @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Image (optional)</label>
                <input type="file" name="image" class="mt-1 block">
                @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('categories.index') }}"
                   class="text-sm text-gray-600 hover:underline">← Back to Categories</a>
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Create Category
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
