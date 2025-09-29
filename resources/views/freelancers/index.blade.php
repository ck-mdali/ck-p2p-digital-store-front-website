<x-app-layout>
    @php
        $breadcrumbItems = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Freelancers', 'url' => route('freelancers.index')],
        ];
    @endphp

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="$breadcrumbItems" />
    </x-slot>

    @if(Session::has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ Session::get('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>
                @elseif(Session::has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ Session::get('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" onclick="this.parentElement.parentElement.style.display='none';"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>
                @endif

    <section class="w-full bg-gradient-to-br rounded-xl from-white to-gray-100 min-h-screen">
        <div class="w-full px-6 py-6 grid md:grid-cols-1 gap-12 items-start">
            <div class="md:col-span-3 space-y-8 w-full">

                

                <h4 class="text-2xl font-bold text-gray-800 mb-4">
                    @if(request('search'))
                        Search Results for <span class="text-indigo-600">{{ request('search') }}</span>
                    @else
                        All Freelancers
                    @endif
                    <span class="text-sm text-gray-500">({{ $freelancers->total() }})</span>
                </h4>

                {{-- Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 w-full">
    @forelse($freelancers as $freelancer)
        <div class="bg-white shadow rounded-xl overflow-hidden border hover:shadow-lg transition duration-300">
            {{-- Profile Image --}}
            @if(!$freelancer->profile_picture)
            <div class="w-full h-44 overflow-hidden bg-gray-100">
                <img 
                    src="{{ $freelancer->profile_picture ?? 'https://via.placeholder.com/300x300?text=No+Image' }}" 
                    alt="{{ $freelancer->user->name }} photo" 
                    class="object-cover w-full h-full"
                    loading="lazy"
                >
            </div>
            
            @endif

            {{-- Info --}}
            <div class="p-4 space-y-2">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $freelancer->user->name }}
                    </h3>
                    @if($freelancer->verified_badge)
                        <span class="text-green-500 text-xs font-bold bg-green-100 px-2 py-0.5 rounded-full">✔ Verified</span>
                    @endif
                </div>
                
                <p class="text-sm text-gray-500">{{ $freelancer->tagline }}</p>
                <p class="text-xs text-gray-400">{{ Str::limit($freelancer->about, 80) }}</p>

                @if($freelancer->skills)
                    <div class="text-xs mt-2 text-indigo-600">{{ $freelancer->skills }}</div>
                @endif

                <div class="mt-3 flex justify-between items-center text-sm">
                    @if($freelancer->price_usd)
                        <span class="text-gray-700 font-medium">${{ $freelancer->price_usd }}/day</span>
                    @endif
                    @if($freelancer->rating)
                        <div class="flex items-center text-yellow-500 space-x-1">
                            <x-heroicon-s-star class="w-4 h-4" />
                            <span>{{ $freelancer->rating }}/5</span>
                        </div>
                    @endif
                </div>

                <a href="{{ route('freelancers.show', $freelancer->id) }}"
                   class="block w-full text-center mt-4 px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                    View Profile
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500">No freelancers found.</p>
    @endforelse
</div>


                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $freelancers->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
