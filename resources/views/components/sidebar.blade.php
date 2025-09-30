<!-- <aside
  :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
  class="fixed z-40 inset-y-0 left-0 w-64 bg-white border-r shadow-sm transform transition-transform duration-300 ease-in-out md:translate-x-0 flex flex-col h-screen"
> -->


<aside
  :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
  class="fixed z-50 inset-y-0 left-0 w-64 bg-white border-r shadow-sm transform transition-transform duration-300 ease-in-out md:z-40 md:translate-x-0 flex flex-col h-screen"
>
  <div class="h-16 flex items-center justify-between px-6 border-b flex-shrink-0">
    <!-- logo with brand name -->
     <a href="{{ url('/') }}" class="flex items-center space-x-2">
        <img src="{{ url('/assets/images/ic.png'); }}" alt="Logo" class="h-8 w-8 object-contain"/>
        <span class="text-2xl font-bold text-black-800  ">Softwares</span>
     </a>
    

    <!-- Close button on mobile -->
    <button @click="sidebarOpen = false" class="md:hidden text-gray-500 hover:text-indigo-600 focus:outline-none">
      ✕
    </button>
  </div>

  <nav class="flex-1 px-6 py-6 space-y-2 text-sm overflow-y-auto">
    <a href="{{ url('/') }}" class="flex items-center space-x-2 block px-4 py-2 rounded-md hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-100 text-indigo-600': window.location.pathname === '/' }">
      <i class="fas fa-home"></i>
      <span>Home</span>
    </a>
    <a href="{{ url('/products') }}" class="flex items-center space-x-2 block px-4 py-2 rounded-md hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition"
       :class="{ 'bg-indigo-100 text-indigo-600': window.location.pathname.startsWith('/products') }">
      <i class="fas fa-box"></i>
      <span>Products</span>
    </a>
    <a href="{{ url('/freelancers') }}" class="flex items-center space-x-2 block px-4 py-2 rounded-md hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-100 text-indigo-600': window.location.pathname === '/freelancers' }">
      <i class="fas fa-user-tie"></i>
      <span>Freelancers</span>
    </a>
    <!-- <a href="{{ url('/blogs') }}" class="flex items-center space-x-2 block px-4 py-2 rounded-md hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-100 text-indigo-600': window.location.pathname === '/blogs' }">
      <i class="fas fa-pencil-alt"></i>
      <span>Blogs</span>
    </a> -->
    <a href="{{ url('/about') }}" class="flex items-center space-x-2 block px-4 py-2 rounded-md hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-100 text-indigo-600': window.location.pathname === '/about' }">
      <i class="fas fa-info-circle"></i>
      <span>About Us</span>
    </a>
    <a href="{{ url('/contact') }}" class="flex items-center space-x-2 block px-4 py-2 rounded-md hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-100 text-indigo-600': window.location.pathname === '/contact' }">
      <i class="fas fa-headset"></i>
      <span>Contact & Support</span>
    </a>
    <!-- <a href="{{ url('/policies') }}" class="flex items-center space-x-2 block px-4 py-2 rounded-md hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-100 text-indigo-600': window.location.pathname === '/policies' }">
      <i class="fas fa-shield-alt"></i>
      <span>Policies</span>
    </a>
     <a href="{{ url('/disclaimer') }}" class="flex items-center space-x-2 block px-4 py-2 rounded-md hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-100 text-indigo-600': window.location.pathname === '/disclaimer' }">
      <i class="fas fa-shield-alt"></i>
      <span>Disclaimer</span>
    </a> -->

    @php
      $user = Auth::user();
    @endphp
    @if (isset($user))
   <div class="mb-4 font-semibold text-indigo-600">My Profile</div>

<div class="mb-6 rounded-md bg-indigo-50 p-3 space-y-1">
    @if($user->role == 'admin')
    <a href="{{ route('admin.console') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-indigo-100 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-300 text-indigo-900': window.location.pathname === '/admin/console'}">
        <i class="fas fa-user text-indigo-500 w-5 text-center"></i>
        <span>Admin Console</span>
    </a>
    @endif

    <a href="{{ route('profile.edit') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-indigo-100 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-300 text-indigo-900': window.location.pathname === '/profile'}">
        <i class="fas fa-user text-indigo-500 w-5 text-center"></i>
        <span>My Profile</span>
    </a>

    <a href="{{ route('p2p.index') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-indigo-100 text-gray-700 hover:text-indigo-600 transition"
       :class="{ 'bg-indigo-300 text-indigo-900': window.location.pathname.startsWith('/p2p') }">
        <i class="fas fa-box-open text-indigo-500 w-5 text-center"></i>
        <span>My Orders</span>
    </a>

    <a href="{{ route('transactions.index') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-indigo-100 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-300 text-indigo-900': window.location.pathname === '/transactions'}">
        <i class="fas fa-credit-card text-indigo-500 w-5 text-center"></i>
        <span>My Transactions</span>
    </a>

    <a href="{{ route('downloads.index') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-indigo-100 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-300 text-indigo-900': window.location.pathname === '/my-downloads'}">
        <i class="fas fa-download text-indigo-500 w-5 text-center"></i>
        <span>My Downloads</span>
    </a>

    <!-- <a href="{{ url('profile/settings') }}"
       class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-indigo-100 text-gray-700 hover:text-indigo-600 transition"
       :class="{'bg-indigo-500 text-indigo-100': window.location.pathname === '/settings'}">
        <i class="fas fa-cogs text-indigo-500 w-5 text-center"></i>
        <span>Settings</span>
    </a> -->

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="w-full text-left flex items-center gap-3 px-4 py-2 rounded-md bg-red-50 text-red-700 hover:bg-red-100 hover:text-red-800 transition">
            <i class="fas fa-sign-out-alt text-red-600 w-5 text-center"></i>
            <span>Logout</span>
        </button>
    </form>
</div>

    @else
    <a href="{{ route('login') }}" 
       class="w-full inline-block text-center px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition">
       <i class="fas fa-sign-in-alt"></i>
       <span>Login</span>
    </a>

    <a href="{{ route('register') }}" 
       class="w-full inline-block text-center px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition">
       <i class="fas fa-user-plus"></i>
       <span>Register</span>
    </a>
    @endif

  </nav>
</aside>
