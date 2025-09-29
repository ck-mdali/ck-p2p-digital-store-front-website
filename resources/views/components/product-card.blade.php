@props(['title', 'description', 'price_usd', 'price_inr', 'image', 'url' => '#', 'stars' => 0])

@php
    // Define a placeholder image URL in case the image is null or empty
    $placeholderImage = 'https://placehold.co/600x400/EEE/31343C';

    // Decode the screenshots JSON string into an array
    $screenshotsArray = json_decode($image, true);
    $image = !empty($screenshotsArray) ? $screenshotsArray[0] : $placeholderImage;
    
    // Calculate the number of full, half, and empty stars based on the stars rating
    $fullStars = floor($stars);
    $halfStars = ($stars - $fullStars >= 0.5) ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStars;
@endphp

<a href="{{ $url }}" class="block bg-white rounded-lg shadow-sm border hover:shadow-md transition overflow-hidden">
    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-40 object-cover">
    <div class="p-4">
        <h4 class="font-medium text-gray-800 mb-1">{{ $title }}</h4>
        
        <!-- Display screenshots if available -->
        @if($screenshotsArray && count($screenshotsArray) > 0)
            <div class="mt-4">
                <h5 class="font-semibold text-gray-800">Screenshots:</h5>
                <div class="flex gap-2 mt-2">
                    @foreach($screenshotsArray as $screenshot)
                        <img src="{{ $screenshot }}" alt="Screenshot" class="w-16 h-16 object-cover rounded-md">
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Display Rating as Stars using Font Awesome -->
        <div class="mt-2 flex items-center space-x-1">
            <!-- Full Stars -->
            @for($i = 0; $i < $fullStars; $i++)
                <i class="fas fa-star text-yellow-400"></i>
            @endfor

            <!-- Half Star -->
            @if($halfStars)
                <i class="fas fa-star-half-alt text-yellow-400"></i>
            @endif

            <!-- Empty Stars -->
            @for($i = 0; $i < $emptyStars; $i++)
                <i class="far fa-star text-gray-300"></i>
            @endfor
        </div>

        <div class="mt-4">
            <!-- Display USD price -->
            @if($price_usd)
                <div class="text-orange-600 font-semibold">{{ $price_usd }} USD</div>
            @endif

            <!-- Display INR price -->
            @if($price_inr)
                <div class="text-green-600 font-semibold">{{ $price_inr }} INR</div>
            @endif
        </div>

        <!-- <div class="flex justify-between items-center mt-4">
            <span class="text-sm text-white bg-indigo-600 px-3 py-1 rounded hover:bg-indigo-700 transition">View</span>
        </div> -->
    </div>
</a>
