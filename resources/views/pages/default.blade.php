<x-app-layout>

    @php
        $breadcrumbItems = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => $page->name],
        ];
    @endphp

    @section('title', $page->name ?? $page->meta_title)
    @section('meta_description', $page->meta_desc)
    @section('meta_keywords', $page->meta_keywords)

    <x-slot name="breadcrumb">
        <x-breadcrumb :items="$breadcrumbItems" />
    </x-slot>

    <section class="bg-white text-gray-800 py-12 lg:py-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Title --}}
            <header class="mb-10 text-center">
                <h1 class="text-3xl lg:text-5xl font-bold tracking-tight leading-tight">
                    {{ $page->name }}
                </h1>
            </header>

            {{-- Featured Image --}}
            @if($page->featured_image)
                <figure class="mb-10 rounded-xl overflow-hidden shadow-sm">
                    <img 
                        src="{{ asset($page->featured_image) }}" 
                        alt="{{ $page->name }}" 
                        class="w-full h-auto object-cover"
                        loading="lazy"
                    >
                </figure>
            @endif

            @if($page->allow_seo && auth()->check() && auth()->user()->role == 'admin')
                <div class="mt-12 text-sm text-gray-500 border-t pt-6">
                    <p><strong>Meta Title:</strong> {{ $page->meta_title ?? '—' }}</p>
                    <p><strong>Meta Description:</strong> {{ $page->meta_desc ?? '—' }}</p>
                    <p><strong>Meta Keywords:</strong> {{ $page->meta_keywords ?? '—' }}</p>
                    <p><strong>Slug:</strong> {{ $page->slug }}</p>
                    <p><strong>SEO Allowed:</strong> {{ $page->allow_seo ? 'Yes' : 'No' }}
                    <p><strong>Views:</strong> {{$page->views}} </p>
                </div>
                <hr>
            @endif

            <article class="prose prose-lg lg:prose-xl max-w-none prose-gray prose-img:rounded-xl prose-img:shadow-sm prose-a:text-indigo-600 hover:prose-a:underline">    
                {!! $page->content !!}
            </article>

        </div>
    </section>

</x-app-layout>
