<!-- Topbar (Fixed but pushed right when sidebar is open) -->
<!-- <header class="fixed top-0 left-0 right-0 h-16 bg-white border-b flex items-center justify-between px-6 shadow-sm z-40 w-[calc(100%-16rem)] md:ml-64"> -->
<header class="fixed top-0 left-0 h-16 bg-white border-b flex items-center justify-between px-6 shadow-sm z-40 w-full md:w-[calc(100%-16rem)] md:ml-64">

    <!-- Sidebar Toggle Button (Mobile) -->
    <button @click="sidebarOpen = true" class="md:hidden text-gray-500 hover:text-indigo-600 focus:outline-none">
        ☰
    </button>

    <!-- Search bar -->
    <div class="flex-1 md:ml-4">
        <form action="{{ route('product.list') }}" method="GET" class="w-full max-w-md">
            <input 
                type="text" 
                name="search" 
                placeholder="Search for products..." 
                value="{{ request()->input('search') }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm transition" />
        </form>
    </div>

    <!-- Profile Dropdown -->
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
            <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Guest') }}"
                 class="w-10 h-10 rounded-full border object-cover" alt="User" />
            <span class="hidden md:block text-sm font-medium text-gray-700">
                {{ Auth::check() ? Auth::user()->name : 'Guest' }}
            </span>
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown -->
        <div
            x-show="open"
            @click.away="open = false"
            x-transition
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-50 border"
        >
            @auth
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Profile</a>
                <a href="{{route('p2p.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">My Orders</a>
                <a href="{{route('transactions.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Transactions</a>
                <a href="{{ url('profile/settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                 <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" 
        class="w-full text-left block px-4 py-2 rounded-md bg-red-50 text-red-700 hover:bg-red-100 hover:text-red-800 transition">
        Logout
      </button>
    </form>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign Up</a>
            @endauth
        </div>
    </div>
</header>
