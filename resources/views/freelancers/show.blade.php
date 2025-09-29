<x-app-layout>
    @php
        $breadcrumbItems = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Freelancers', 'url' => route('freelancers.index')],
            ['label' => $freelancer->user->name],
        ];
    @endphp

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="$breadcrumbItems" />
    </x-slot>

    <section class="bg-white shadow-sm rounded-xl max-w-6xl mx-auto my-8">
        {{-- Profile Header --}}
<div class="bg-gradient-to-br from-indigo-50 to-white p-6 rounded-t-xl border-b">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 items-center">
        
        {{-- Column 1: Profile Picture --}}
        <div class="flex justify-center sm:justify-start">
            <img 
                src="{{ $freelancer->profile_picture ?? 'https://via.placeholder.com/300?text=No+Image' }}"
                alt="{{ $freelancer->user->name }}'s Profile Photo"
                class="h-36 object-cover border-4 border-white shadow-md"
                loading="lazy"
            >
        </div>

        {{-- Column 2: Main Info --}}
        <div class="space-y-1 text-left sm:text-left">
            <div class="flex items-center justify-center sm:justify-start gap-2">
                <h1 class="text-2xl font-bold text-gray-800">{{ $freelancer->user->name }}</h1>
                @if($freelancer->verified_badge == 1)
                    <span class="text-green-600 text-sm font-medium bg-green-100 px-2 py-0.5 rounded-full">✔ Verified</span>
                @else
                    <span class="text-gray-400 text-sm font-medium bg-gray-100 px-2 py-0.5 rounded-full">Unverified</span>
                @endif
            </div>
            <p class="text-gray-600 text-sm">{{ $freelancer->tagline }}</p>

            @if($freelancer->rating)
                <div class="flex justify-center sm:justify-start items-center text-yellow-500 text-sm">
                    <x-heroicon-s-star class="w-5 h-5" />
                    <span class="ml-1">{{ $freelancer->rating }}/5</span>
                </div>
            @endif

            @if($freelancer->skills)
                <p class="text-sm text-indigo-600">{{ $freelancer->skills }}</p>
            @endif
        </div>

        {{-- Column 3: Pricing --}}
        <div class="sm:text-right text-right space-y-1">
            @if($freelancer->pricing_usd)
                <p class="text-lg font-bold text-gray-800">${{ $freelancer->pricing_usd }}/day</p>
            @endif
            @if($freelancer->pricing_inr)
                <p class="text-sm text-gray-500">₹{{ $freelancer->pricing_inr }}/day</p>
            @endif
            @if($freelancer->pricing_tagline)
                <p class="text-xs text-gray-400 italic">{{ $freelancer->pricing_tagline }}</p>
            @endif
        </div>
    </div>
</div>


        {{-- Main Content --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            {{-- Left Column (About & Portfolio) --}}
            <div class="md:col-span-2 space-y-6">
                {{-- About --}}
                @if($freelancer->youtube_link)
    <div>
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Introduction Video</h2>
        <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow">
            <iframe
                src="https://www.youtube.com/embed/{{ \Illuminate\Support\Str::afterLast($freelancer->youtube_link, '?v=') }}"
                class="w-full h-full border-none"
                allowfullscreen
            ></iframe>
        </div>
    </div>
@endif

                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">About</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $freelancer->about ?? 'No information available.' }}</p>
                </div>

                {{-- Portfolio --}}
                @if(!empty($freelancer->portfolio_links))
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Portfolio</h2>
                        <ul class="space-y-2">
                            @foreach($freelancer->portfolio_links as $link)
                                <li>
                                    <a href="{{ $link }}" target="_blank" class="text-blue-600 hover:underline break-all">
                                        {{ $link }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            {{-- Right Column (Contact & Social Links) --}}
            <div class="space-y-6">
                {{-- Contact --}}
                <div class="bg-gray-50 border rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Contact Info</h2>
                    <p class="text-sm text-gray-600">
                        <strong>Email:</strong> <a href="mailto:{{ $freelancer->user->email }}" class="text-blue-600 hover:underline">{{ $freelancer->user->email }}</a>
                    </p>
                    @if($freelancer->user->phone)
                        <p class="text-sm text-gray-600">
                            <strong>Phone:</strong> <a href="tel:{{ $freelancer->user->phone }}" class="text-blue-600 hover:underline">{{ $freelancer->user->phone }}</a>
                        </p>
                    @endif
                    @if($freelancer->address)
                        <p class="text-sm text-gray-600 mt-2">
                            <strong>Address:</strong><br>{{ $freelancer->address }}
                        </p>
                    @endif
                </div>

                {{-- Social Links --}}
                <div class="bg-gray-50 border rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Links</h2>
                    <ul class="space-y-1 text-blue-600 text-sm">
                        @if($freelancer->github_link)<li><a href="{{ $freelancer->github_link }}" target="_blank" class="hover:underline">GitHub</a></li>@endif
                        @if($freelancer->linkedin_link)<li><a href="{{ $freelancer->linkedin_link }}" target="_blank" class="hover:underline">LinkedIn</a></li>@endif
                        @if($freelancer->website_link)<li><a href="{{ $freelancer->website_link }}" target="_blank" class="hover:underline">Website</a></li>@endif
                        @if($freelancer->youtube_link)<li><a href="{{ $freelancer->youtube_link }}" target="_blank" class="hover:underline">YouTube</a></li>@endif
                        @if($freelancer->instagram_link)<li><a href="{{ $freelancer->instagram_link }}" target="_blank" class="hover:underline">Instagram</a></li>@endif
                    </ul>
                </div>

                {{-- Aadhar & PAN --}}
                @if($freelancer->adhar_card || $freelancer->pancard)
                    <div class="bg-gray-50 border rounded-lg p-4 text-sm text-gray-600">
                        @if($freelancer->adhar_card)
                            <p><strong>Aadhar Card:</strong> {{ $freelancer->adhar_card }}</p>
                        @endif
                        @if($freelancer->pancard)
                            <p><strong>PAN Card:</strong> {{ $freelancer->pancard }}</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
