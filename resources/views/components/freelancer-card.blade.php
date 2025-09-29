@props([
    'name',
    'specialty',
    'image',
    'rating',
    'url' => '#',
    'verified' => false,
])

<a href="{{ $url }}" class="block bg-white rounded-lg shadow-sm border hover:shadow-md hover:border-indigo-400 transition duration-200 overflow-hidden text-center p-5 group">
    {{-- Profile Image --}}
    <div class="relative w-24 h-24 mx-auto mb-3">
        <img src="{{ $image }}" alt="{{ $name }}" class="w-24 h-24 object-cover rounded-full border shadow-sm">
        
        
    </div>

    {{-- Name --}}
    <h4 class="text-gray-800 font-semibold text-lg group-hover:text-indigo-700 transition">{{ $name }}  @if($verified)
            <span class="bg-green-500 text-white text-xs px-1.5 py-0.5 rounded-full shadow">
                ✔
            </span>
        @endif</h4>

    {{-- Specialty --}}
    <p class="text-sm text-gray-500 mt-1">{{ $specialty }}</p>

    {{-- Rating --}}
    <div class="mt-2 text-sm text-yellow-500 font-medium">
        ⭐ {{ number_format($rating, 1) }}/5
    </div>
</a>
