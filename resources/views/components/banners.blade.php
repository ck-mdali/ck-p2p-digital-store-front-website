<!-- Sliding Banners Carousel -->
<section x-data="{ currentSlide: 0, slides: {{ count($banners) }}, interval: null }"
         x-init="interval = setInterval(() => { currentSlide = (currentSlide + 1) % slides }, 5000)"
         class="relative w-full overflow-hidden rounded-xl bg-indigo-100 shadow-md"
>
    <!-- Slides Wrapper -->
    <div class="relative h-64">
        @foreach($banners as $index => $banner)
            <div
                x-show="currentSlide === {{ $index }}"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="absolute inset-0 flex justify-center items-center"
            >
                <!-- Banner Image -->
                <a href="{{ $banner->link }}" target="_blank" class="w-full h-full flex justify-center items-center">
                    <img src="{{ $banner->image }}" alt="{{ $banner->name }}"
                         class="w-full h-full object-cover rounded-lg"
                    >
                </a>
            </div>
        @endforeach
    </div>

    <!-- Controls -->
    <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
        <template x-for="i in slides" :key="i">
            <button
                @click="currentSlide = i - 1"
                :class="{
                    'bg-indigo-600': currentSlide === (i - 1),
                    'bg-indigo-300': currentSlide !== (i - 1)
                }"
                class="w-3 h-3 rounded-full"
            ></button>
        </template>
    </div>
</section>
