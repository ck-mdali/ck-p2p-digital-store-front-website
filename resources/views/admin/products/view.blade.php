<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8 bg-white rounded shadow">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Product Details</h1>
            <a href="{{ route('products.index') }}" 
               class="inline-block px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
               ← Back to Products
            </a>
        </div>

        <div class="space-y-4">
            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
            <p><strong>Price (USD):</strong> ${{ number_format($product->price_usd, 2) }}</p>
            <p><strong>Description:</strong> {{ $product->description_lt ?? 'N/A' }}</p>
            <p><strong>Added By:</strong> {{ $product->addedBy->name ?? 'N/A' }}</p>
            <p><strong>Date Added:</strong> {{ $product->created_at->toDateString() }}</p>
            <p><strong>Tech Support:</strong> {{ $product->tech_support ?? 'N/A' }}</p>
            <p><strong>Custom Mods:</strong> {{ $product->custom_mods ?? 'N/A' }}</p>
            <p><strong>License:</strong> {{ $product->license ?? 'N/A' }}</p>
            <p><strong>Keywords:</strong> {{ $product->keywords ?? 'N/A' }}</p>
        </div>
    </div>
</x-app-layout>
