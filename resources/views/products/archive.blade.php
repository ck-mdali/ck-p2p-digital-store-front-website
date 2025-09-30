<x-app-layout>
    {{-- Breadcrumb Section --}}
    @php
        $breadcrumbItems = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Products', 'url' => url('products')],
        ];

        // Add category to breadcrumb only if category slug is available
        if (!empty($category->slug)) {
            $breadcrumbItems[] = ['label' => $category->name ?? '', 'url' => url('/products/' . $category->slug)];
        }
        
        // Add product-specific breadcrumb if needed
        if (!empty($product)) {
            $breadcrumbItems[] = ['label' => $product->name ?? '', 'url' => url('/products/' . $product->category->slug . '/' . $product->slug)];
        }
    @endphp

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="$breadcrumbItems" />
    </x-slot>

    <!-- Make section full width -->
    <section class="w-full bg-gradient-to-br rounded-xl from-white to-gray-100 min-h-screen">
        <!-- Add padding around the grid, but keep it full width -->
        <div class="w-full px-6 py-6 grid md:grid-cols-1 gap-12 items-start">
            {{-- Left: Product List Grid (3/5 width) --}}
            <div class="md:col-span-3 space-y-8 w-full">
                <h4 class="text-1xl font-bold text-gray-800 mb-4">Filter by category</h4>
                
                {{-- Category Chips (Tags) --}}
                <div class="flex flex-wrap gap-4 mb-6">
                    <a href="{{ route('product.list') }}"
                       class="inline-flex items-center justify-center px-4 py-2 
                       {{ request()->is('products') ? 
                          'bg-indigo-600 text-white border-2 border-indigo-600' : 
                          'bg-white text-dark-600 border-2 border-indigo-400 hover:bg-indigo-100' }} 
                       text-sm font-semibold rounded-full transition">
                        All
                    </a>

                    @foreach($categories as $cat)
                        <a href="{{ route('product.list.category', ['category' => $cat->slug]) }}"
                           class="inline-flex items-center justify-center px-4 py-2 
                           {{ request()->is('products/' . $cat->slug) ? 
                              'bg-indigo-600 text-white border-2 border-indigo-600' : 
                              'bg-white text-dark-600 border-2 border-indigo-400 hover:bg-indigo-100' }} 
                           text-sm font-semibold rounded-full transition">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>

                <!-- Divider -->
                <hr class="border-gray-300 my-4">
<h4 class="text-1xl font-bold text-gray-800 mb-4">
    @if(!empty($category))
        Showing Products for <span class="text-purple-600">{{ $category->name }}</span>  ( {{$products->count()}} )
    @elseif($is_search == true)
        Search results for  <span class="text-purple-600">{{ $search }} </span> ( {{$products->count()}} )
    @else
        Showing products <span class="text-purple-600">All</span>
    @endif
</h4>


                {{-- Product Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 w-full">
                    @foreach($products as $product)
                        <x-product-card
                            title="{{ $product->name }}"
                            description="{{ $product->description_lt ?? 'No description available' }}"
                            price_usd="${{ number_format($product->price_usd, 2) }} USDT"
                            price_inr="₹{{ number_format($product->price_inr, 2) }}"
                            stars="{{ $product->stars ?? 4.5 }}"
                            image="{{ $product->screenshots[0] ?? 'https://via.placeholder.com/400x250.png?text=No+Image+Available' }}"
                            url="{{ route('product.view', ['category' => $product->category->slug, 'slug' => $product->slug]) }}"
                        />
                    @endforeach
                </div>

                {{-- Pagination Links --}}
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
