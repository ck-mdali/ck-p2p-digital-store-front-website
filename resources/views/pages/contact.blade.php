<x-app-layout>
@php
    $breadcrumbItems = [
        ['label' => 'Home', 'url' => url('/')],
        ['label' => 'Contact CK Softwares'],
    ];
@endphp

@section('title', 'Contact CK Softwares - Let\'s Build Together')
@section('meta_description', 'Get in touch with CK Softwares for software development, AI solutions, or digital script purchases. Reach us via email or phone.')
@section('meta_keywords', 'contact ck softwares, support, help')

<x-slot name="breadcrumb">
    <x-breadcrumb :items="$breadcrumbItems" />
</x-slot>

<section class="bg-gradient-to-br from-white to-gray-100 py-12">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- Contact Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">Contact <span class="text-indigo-600">CK Softwares</span></h1>
            <p class="mt-4 text-gray-600 text-lg max-w-2xl mx-auto">
                Whether you're ready to start a project or just have questions — we’re here to help.
            </p>
        </div>

        {{-- Contact Info --}}
        <div class="bg-white shadow-md rounded-lg p-8 mb-16">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">📬 Reach Out</h2>
            <ul class="text-gray-700 space-y-3 text-sm">
                <li>
                    <strong>Email:</strong> 
                    <a href="mailto:help@cksoftwares.com" class="text-indigo-600 hover:underline">help@cksoftwares.com</a>
                </li>
                <li>
                    <strong>Phone:</strong> 
                    <a href="tel:+917997807419" class="text-indigo-600 hover:underline">+91 799 780 7419</a>
                </li>
            </ul>
        </div>

        <!-- space div -->
        <div class="h-8"></div>


        {{-- FAQs --}}
        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">❓ Frequently Asked Questions</h2>
            <div class="space-y-6">
                @foreach([
                    ['q' => 'Do you offer custom software development?', 'a' => 'Yes, we specialize in custom solutions like CRMs, ERPs, E-commerce, and more — built around your business needs.'],
                    ['q' => 'Can I buy ready-made scripts?', 'a' => 'Absolutely! Visit our Digital Script Store to purchase pre-built, well-supported scripts with updates.'],
                    ['q' => 'Do you provide support after delivery?', 'a' => 'Yes. We offer full post-launch support and lifetime updates for our digital products.'],
                    ['q' => 'Can we schedule a meeting or call?', 'a' => 'Yes, we encourage real-time calls and Zoom meetings to better understand your requirements.'],
                ] as $faq)
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $faq['q'] }}</h3>
                        <p class="text-gray-600 mt-2 text-sm">{{ $faq['a'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

</x-app-layout>
