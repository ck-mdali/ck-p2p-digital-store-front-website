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
                    At <a href="{{ url('/about') }}" class="font-semibold text-purple-600">CK Softwares</a>,
                    we sell and develop custom solutions for clients.
                </p>
                <p class="text-gray-600 mt-4">
                    We develop websites, mobile apps, AI Models, Softwares tools<br> ~ Laravel, Flutter, React, Python, Go, Node.js, and more. 
                </p>

                <ul class="mt-6 space-y-2 text-sm text-gray-700">
                    <li class="flex items-center gap-2">
                        <x-heroicon-o-check class="w-5 h-5 text-purple-500"/> We accept UPI, Crypto
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-o-check class="w-5 h-5 text-purple-500"/> 24/7 Customer Support
                    </li>
                    <li class="flex items-center gap-2">
                        <x-heroicon-o-check class="w-5 h-5 text-purple-500"/> Installations & Free Updates
                    </li>
                </ul>

                <div class="mt-8">
                    <a href="{{ url('/about') }}" class="inline-block px-6 py-2 bg-purple-600 text-white text-sm font-medium rounded hover:bg-purple-700 transition">
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

  {{-- Services Section --}}
<section class="relative mt-16 bg-gradient-to-br from-green-50 to-green-100">
    <div class="max-w-7xl mx-auto px-6 py-12 rounded-xl bg-white/70 backdrop-blur-md shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">🛠️ Our Services</h2>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach([
                ['title' => 'Website Development', 'desc' => 'WordPress, Laravel, Core PHP, React, MERN, Python', 'icon' => 'globe-alt'],
                ['title' => 'Mobile Apps', 'desc' => 'React Native, Flutter, Native Android/iOS', 'icon' => 'device-phone-mobile'],
                ['title' => 'AI & ML Models', 'desc' => 'Custom AI solutions using HuggingFace & OpenAI', 'icon' => 'sparkles'],
                ['title' => 'Software Tools', 'desc' => 'Built in Python, Go, JavaScript for automation', 'icon' => 'wrench-screwdriver'],
                ['title' => 'Digital Script Store', 'desc' => 'Buy & sell scripts with full support & updates', 'icon' => 'shopping-cart'],
                ['title' => 'Custom CRM & ERP', 'desc' => 'Tailored solutions for business automation', 'icon' => 'building-library'],
            ] as $service)
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <x-dynamic-component :component="'heroicon-o-' . $service['icon']" class="w-8 h-8 text-indigo-600 mb-4" />
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $service['title'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $service['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Founders Section --}}
<section class="relative mt-16 bg-gradient-to-br from-green-50 to-green-100">
    <div class="max-w-7xl mx-auto px-6 py-12 rounded-xl bg-white/70 backdrop-blur-md shadow-lg">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">👨‍💻 Meet the Founders</h2>
        <div class="grid md:grid-cols-2 gap-10">
            @foreach([
                [
                    'name' => 'MD Shariq Ahmed',
                    'role' => 'Co-Founder & CTO',
                    'img' => 'https://source.unsplash.com/200x200/?man,developer',
                    'linkedin' => 'https://www.linkedin.com/in/md-shariq-ahmed'
                ],
                [
                    'name' => 'MD Naveed',
                    'role' => 'Co-Founder & CEO',
                    'img' => 'https://source.unsplash.com/200x200/?tech,founder',
                    'linkedin' => 'https://www.linkedin.com/in/md-naveed'
                ],
            ] as $founder)
                <div class="bg-white rounded-xl p-6 shadow-md text-center">
                    <img src="{{ $founder['img'] }}" class="w-24 h-24 mx-auto rounded-full mb-4 object-cover shadow-sm" alt="{{ $founder['name'] }}">
                    <h4 class="text-lg font-semibold text-gray-800">{{ $founder['name'] }}</h4>
                    <p class="text-sm text-gray-500">{{ $founder['role'] }}</p>
                    <p class="mt-3 text-gray-600 text-sm">
                        8+ years of software experience & startup leadership. Building future-ready tech for businesses in India & abroad.
                    </p>

                    {{-- LinkedIn Button --}}
                    <div class="mt-4">
                        <a href="{{ $founder['linkedin'] }}" target="_blank"
                           class="inline-block px-4 py-1.5 text-sm text-white bg-blue-600 hover:bg-blue-700 rounded transition">
                            <i class="fab fa-linkedin"></i> LinkedIn
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


{{-- Contact Section --}}
<section class="relative mt-16 rounded-xl bg-white/70 backdrop-blur-md shadow-lg">
    <div class="max-w-4xl mx-auto px-6 py-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">📬 Get in Touch</h2>
        <p class="text-gray-600 mb-4">We're available for calls, chats, and emails. Let's build something amazing together.</p>
        <ul class="text-gray-700 space-y-2 text-sm">
            <li><strong>Email:</strong> <a href="mailto:help@cksoftwares.com" class="text-indigo-600 hover:underline">help@cksoftwares.com</a></li>
            <li><strong>Phone:</strong> <a href="tel:+917997807419" class="text-indigo-600 hover:underline">+91 799 780 7419</a></li>
            <li><strong>Location:</strong> Hyderabad, Madhapur, Telangana, India</li>
        </ul>
    </div>
</section>


</x-app-layout>
