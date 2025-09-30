<x-app-layout>

@php
     $breadcrumbItems = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'About CK Softwares'],
        ];
@endphp

 @section('title', 'About CK Softwares - Purchase Scripts and apps')
    @section('meta_description', 'CK Softwares is an Indian software company specializing in custom software development, AI-powered solutions, and a digital script store for developers and startups.')
    @section('meta_keywords', 'ck softwares')

<x-slot name="breadcrumb">
    <x-breadcrumb :items="$breadcrumbItems" />
</x-slot>

<section class="bg-gradient-to-br from-white to-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Hero Section --}}
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
                Welcome to <span class="text-indigo-600">CK Softwares</span>
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Indian Creative Developers | Custom Software, AI-Powered Solutions, and a Digital Script Store You Can Trust.
                
            </p>
           <div class="mt-6 flex flex-col sm:flex-row sm:justify-center gap-4">
    <a href="{{ url('/products') }}" 
       class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition text-center">
        Our Portfolio
    </a>

    <a href="https://wa.me/917997807419"
       class="inline-flex items-center justify-center px-6 py-2 border border-[#25D366] text-[#25D366] rounded hover:bg-[#25D366]/10 transition text-center">
        <i class="fab fa-whatsapp mr-2"></i> +91 799 780 7419
    </a>
</div>

        </div>

        <div class="h-8"></div>
        <hr>
        <div class="h-8"></div>

        {{-- About Section --}}
<div class="grid md:grid-cols-2 gap-10 items-center mb-20">
    <div>
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">Who We Are</h2>
        <p class="text-gray-600 leading-relaxed">
            Founded in 2021 by <strong>MD Shariq Ahmed</strong> and <strong>MD Naveed</strong> — experienced developers with 8+ years in the industry — CK Softwares is a Hyderabad-based software company with a bold vision.
        </p>
        <p class="mt-4 text-gray-600">
            We specialize in CRM, ERP, E-commerce, and Crypto platforms, and bring a personal touch to development with real-time calls, meetings, and AI-enhanced delivery. Having built and scaled 2 startups, we now empower others with powerful solutions.
        </p>

        {{-- LinkedIn Button --}}
        <div class="mt-6">
            <a href="{{ url('/products') }}" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition"> <i class="fab fa-linkedin"></i> Linkedin</a>

        </div>
    </div>
    <div>
        <img src="https://source.unsplash.com/600x400/?technology,startup" alt="About CK Softwares" class="rounded-xl shadow-lg">
    </div>
</div>


        {{-- Services Section --}}
        <div id="services" class="mb-20">
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-12">Our Services</h2>
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

        {{-- Highlight: Digital Store --}}
        <div class="bg-indigo-50 border-l-4 border-indigo-600 p-8 rounded-lg mb-20">
            <h3 class="text-2xl font-semibold text-indigo-700 mb-2">🚀 Explore Our Digital Script Store</h3>
            <p class="text-gray-700 mb-4">
                Just like CodeCanyon — but Indian. Buy pre-built scripts with lifetime updates, free installation, and dedicated support. Trusted by hundreds of developers and startups.
            </p>
            <a href="{{ url('products') }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">Visit Store</a>
        </div>

      {{-- Founders Section --}}
<div class="mb-20">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-12">Meet the Founders</h2>
    <div class="grid md:grid-cols-2 gap-10">
        @foreach([
            [
                'name' => 'MD Shariq Ahmed',
                'role' => 'Co-Founder & CTO',
                'img' => 'https://source.unsplash.com/200x200/?man,developer',
                'linkedin' => 'https://www.linkedin.com/in/md-shariq-ahmed',
            ],
            [
                'name' => 'MD Naveed',
                'role' => 'Co-Founder & CEO',
                'img' => 'https://source.unsplash.com/200x200/?tech,founder',
                'linkedin' => 'https://www.linkedin.com/in/md-naveed',
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


        {{-- Contact Section --}}
        <div id="contact" class="bg-white shadow rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">📬 Get in Touch</h2>
            <p class="text-gray-600 mb-4">We're available for calls, chats, and emails. Let's build something amazing together.</p>
            <ul class="text-gray-700 space-y-2 text-sm">
                <li><strong>Email:</strong> <a href="mailto:help@cksoftwares.com" class="text-indigo-600 hover:underline">help@cksoftwares.com</a></li>
                <li><strong>Phone:</strong> <a href="tel:+917997807419" class="text-indigo-600 hover:underline">+91 799 780 7419</a></li>
                <li><strong>Location:</strong> Hyderabad, Madhapur, Telangana, India</li>
            </ul>
        </div>

    </div>
</section>

</x-app-layout>
