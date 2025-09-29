<x-app-layout>

    {{-- Banners --}}
    @if($banners->count() > 0)
        @include('components.banners')
    @endif

    <!-- Sessions success -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow-md text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <!-- Sessions error -->
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg shadow-md text-sm">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Best Selling Products --}}
    <section class="relative mt-16 bg-gradient-to-br from-green-50 to-green-100">
        <div class="max-w-7xl mx-auto px-6 rounded-xl bg-white/70 backdrop-blur-md shadow-lg p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-green-800">🔥 Best Selling Products</h2>
                <a href="{{url('/products?type=best-selling')}}" class="text-sm text-green-600 hover:underline">View All</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">  <!-- Change grid-cols-4 to grid-cols-3 -->
                @foreach($bestSellingProducts as $product)
                    <x-product-card
                        title="{{ $product->name }}"
                        description="{{ $product->description_lt ?? 'Top-selling item description' }}"
                        price_usd="${{ number_format($product->price_usd, 2) }}"
                        price_inr="₹{{ number_format($product->price_inr, 2) }}"
                        stars="{{ $product->stars ?? 4.5 }}"
                        image="{{ $product->screenshots[0] ?? 'https://source.unsplash.com/featured/?bestseller' }}"
                        url="{{ route('product.view', ['category' => $product->category->slug, 'slug' => $product->slug]) }}"
                    />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Latest Products --}}
    <section class="relative bg-gradient-to-br from-indigo-50 to-indigo-100">
        <div class="max-w-7xl mx-auto px-6 rounded-xl bg-white/70 backdrop-blur-md shadow-lg p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-indigo-800">🆕 Latest Products</h2>
                <a href="{{route('product.list')}}" class="text-sm text-indigo-600 hover:underline">View All</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6"> <!-- Change grid-cols-4 to grid-cols-3 -->
                @foreach($latestProducts as $product)
                    @php
                        // Decode the screenshots JSON string into an array
                        $screenshotsArray = json_decode($product->screenshots, true);
                        // Fallback image in case of empty or null screenshots
                        $image = !empty($screenshotsArray) ? $screenshotsArray[0] : 'https://via.placeholder.com/400x250.png?text=No+Image+Available';
                    @endphp

                    <x-product-card
                        title="{{ $product->name }}"
                        description="{{ $product->description_lt ?? 'Just launched!' }}"
                        price_usd="${{ number_format($product->price_usd, 2) }}"
                        price_inr="₹{{ number_format($product->price_inr, 2) }}"
                        stars="{{ $product->stars ?? 4.5 }}"
                        image="{{ $image }}"
                        url="{{ route('product.view', ['category' => $product->category->slug, 'slug' => $product->slug]) }}"
                    />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Top Freelancers --}}
<section class="relative bg-gradient-to-br from-yellow-50 to-yellow-100 mb-20">
    <div class="max-w-7xl mx-auto px-6 rounded-xl bg-white/70 backdrop-blur-md shadow-lg p-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-yellow-800">💻 Top Freelancers</h2>
            <a href="{{ route('freelancers.index') }}" class="text-sm text-yellow-600 hover:underline">View All</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($freelancers as $freelancer)
                <x-freelancer-card
                    name="{{ $freelancer->user->name }}"
                    specialty="{{ $freelancer->tagline ?? 'Freelancer' }}"
                    image="{{ $freelancer->profile_picture ?? 'https://via.placeholder.com/300x300.png?text=No+Image' }}"
                    rating="{{ $freelancer->rating ?? '4.5' }}"
                    url="{{ route('freelancers.show', $freelancer->id) }}"
                    verified="{{ $freelancer->verified_badge }}"
                />
            @empty
                <div class="col-span-full text-center text-gray-500">
                    No freelancers found.
                </div>
            @endforelse
        </div>
    </div>
</section>

    {{-- About Us --}}
    <section class="relative bg-gradient-to-br from-purple-50 to-white">
        <div class="max-w-7xl mx-auto px-6 rounded-xl bg-white/70 backdrop-blur-md shadow-lg p-8 grid md:grid-cols-2 gap-12 items-center">
            {{-- Text --}}
            <div>
                <h2 class="text-3xl font-extrabold text-purple-800 mb-4">About Our Company</h2>
                <p class="text-gray-700 leading-relaxed">
                    At <span class="font-semibold text-purple-600">{{ config('app.name', 'OurStore') }}</span>,
                    we connect people with premium digital products and world-class freelancers.
                </p>
                <p class="text-gray-600 mt-4">
                    We’re a marketplace built for creators, innovators, and entrepreneurs — helping people bring ideas to life with speed and style.
                </p>

                <ul class="mt-6 space-y-2 text-sm text-gray-700">
                    <li class="flex items-center gap-2">
                        <x-heroicon-o-check class="w-5 h-5 text-purple-500"/> Trusted by thousands
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-o-check class="w-5 h-5 text-purple-500"/> 24/7 Customer Support
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-o-check class="w-5 h-5 text-purple-500"/> Verified Freelancers
                    </li>
                </ul>

                <div class="mt-8">
                    <a href="#" class="inline-block px-6 py-2 bg-purple-600 text-white text-sm font-medium rounded hover:bg-purple-700 transition">
                        Learn More About Us
                    </a>
                </div>
            </div>

            {{-- Video --}}
            <div class="rounded-xl shadow-lg overflow-hidden aspect-w-16 aspect-h-9">
                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                        title="Intro Video"
                        class="w-full h-full"
                        allowfullscreen>
                </iframe>
            </div>
        </div>
    </section>

</x-app-layout>
