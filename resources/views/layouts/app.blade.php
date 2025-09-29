<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false }" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title id="Gtitle">@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="icon" href="{{ url('/assets/images/ic.png'); }}" type="image/x-icon">

    <!-- global seo -->
    <meta name="description" content="@yield('meta_description', 'Default site description')">
    <meta name="keywords" content="@yield('meta_keywords', '')">

    <!-- social media seo -->
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:title" content="@yield('og_title', View::yieldContent('title', config('app.name')))" />
    <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description', 'Default description'))" />
    <meta property="og:image" content="@yield('og_image', asset('default-og-image.jpg'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}" />

    <!-- twitter seo -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('twitter_title', View::yieldContent('title', config('app.name')))" />
    <meta name="twitter:description" content="@yield('twitter_description', View::yieldContent('meta_description', 'Default description'))" />
    <meta name="twitter:image" content="@yield('twitter_image', asset('default-twitter-image.jpg'))" />
    <!-- social media seo ends -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Tailwind / Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js (if not already included) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

<div class="flex min-h-screen overflow-hidden">

    <!-- Sidebar (Fixed + Toggleable) -->
    @include('components.sidebar')

    <!-- Overlay on small screens when sidebar is open -->
    <div
        x-show="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 bg-black bg-opacity-40 z-30 md:hidden"
        x-transition.opacity
    ></div>

    <!-- Main content -->
    <div
        :class="sidebarOpen ? 'ml-64' : 'ml-0'"
        class="flex-1 flex flex-col transition-all duration-300 md:ml-64"
        :style="sidebarOpen ? 'width: calc(100% - 16rem)' : 'width: 100%'"
    >

    <!-- Topbar -->
    @include('components.topbar')

        <!-- Main content area -->
        <!-- Main content area -->
       <main class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50 pt-[104px]">
          @isset($breadcrumb)
        <div>
            {{ $breadcrumb }}
        </div>
    @endisset
    {{ $slot }}
</main>

    </div>
</div>

</body>
</html>
