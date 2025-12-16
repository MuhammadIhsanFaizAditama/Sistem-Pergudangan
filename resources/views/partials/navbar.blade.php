<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <div class="flex items-center">
            <button id="sidebar-toggle" class="mr-4 text-gray-500 focus:outline-none md:hidden">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @yield('page-title', 'Dashboard')
            </h2>
        </div>

        <div class="flex items-center">
            @auth
                <span class="mr-4 text-gray-600">Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-900 underline">
                        Logout
                    </button>
                </form>
            @endauth
        </div>
    </div>
</header>
