<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8 bg-white rounded shadow">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Add New Product</h1>
            <a href="{{ route('products.index') }}" 
               class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
               ← Back to Products
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block font-semibold mb-1">Product Name <span class="text-red-600">*</span></label>
                <input type="text" name="name" id="name" 
                    value="{{ old('name') }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <div>
                <label for="slug" class="block font-semibold mb-1">Slug <small>(optional)</small></label>
                <input type="text" name="slug" id="slug" 
                    value="{{ old('slug') }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2" placeholder="URL friendly">
            </div>

            <div>
                <label for="description_lt" class="block font-semibold mb-1">Description</label>
                <textarea name="description_lt" id="description_lt" rows="4" 
                    class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description_lt') }}</textarea>
            </div>

            <div>
                <label for="screenshots" class="block font-semibold mb-1">Screenshots (JSON Array)</label>
                <textarea name="screenshots" id="screenshots" rows="3" placeholder='e.g. ["url1", "url2"]' 
                    class="w-full border border-gray-300 rounded px-3 py-2">{{ old('screenshots') }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Enter a JSON array of image URLs.</p>
            </div>

            <div>
                <label for="youtube_url" class="block font-semibold mb-1">YouTube URL</label>
                <input type="url" name="youtube_url" id="youtube_url" 
                    value="{{ old('youtube_url') }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2" placeholder="https://youtube.com/...">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price_usd" class="block font-semibold mb-1">Price (USD) <span class="text-red-600">*</span></label>
                    <input type="number" step="0.01" min="0" name="price_usd" id="price_usd" 
                        value="{{ old('price_usd') }}" 
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div>
                    <label for="price_inr" class="block font-semibold mb-1">Price (INR) <span class="text-red-600">*</span></label>
                    <input type="number" step="0.01" min="0" name="price_inr" id="price_inr" 
                        value="{{ old('price_inr') }}" 
                        class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
            </div>

            <div>
                <label for="category_id" class="block font-semibold mb-1">Category <span class="text-red-600">*</span></label>
                <select name="category_id" id="category_id" required class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="demo_url" class="block font-semibold mb-1">Demo URL</label>
                <input type="url" name="demo_url" id="demo_url" 
                    value="{{ old('demo_url') }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2" placeholder="https://example.com/demo">
            </div>

            <div>
                <label for="tech_support" class="block font-semibold mb-1">Tech Support</label>
                <input type="text" name="tech_support" id="tech_support" 
                    value="{{ old('tech_support') }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Email, Phone, etc.">
            </div>

            <div>
                <label for="custom_mods" class="block font-semibold mb-1">Custom Mods</label>
                <input type="text" name="custom_mods" id="custom_mods" 
                    value="{{ old('custom_mods') }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Available, None, etc.">
            </div>

            <div>
                <label for="license" class="block font-semibold mb-1">License</label>
                <input type="text" name="license" id="license" 
                    value="{{ old('license') }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2" placeholder="GPL, Proprietary, etc.">
            </div>

            <div>
                <label for="keywords" class="block font-semibold mb-1">Keywords</label>
                <input type="text" name="keywords" id="keywords" 
                    value="{{ old('keywords') }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Comma separated">
            </div>

            <div class="pt-4">
                <button type="submit" 
                    class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                    Save Product
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
