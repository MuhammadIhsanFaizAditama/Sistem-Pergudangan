<aside id="sidebar" class="bg-gray-800 text-white w-64 min-h-screen flex-shrink-0 fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-200 ease-in-out z-20">
    <div class="p-4 text-lg font-bold">
        Bengkel Gudang
    </div>

    <nav class="mt-4">
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }}">
            Dashboard
        </a>

        @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin'))
            <a href="{{ route('barang.index') }}"
            class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('barang.*') ? 'bg-gray-700' : '' }}">
                Barang
            </a>

            <a href="{{ route('kategori.index') }}"
            class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('kategori.*') ? 'bg-gray-700' : '' }}">
                Kategori
            </a>

            <a href="{{ route('supplier.index') }}"
            class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('supplier.*') ? 'bg-gray-700' : '' }}">
                Supplier
            </a>

            <a href="{{ route('pembelian.index') }}"
            class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('pembelian.*') ? 'bg-gray-700' : '' }}">
                Pembelian
            </a>
        @endif

        @if(auth()->check() && auth()->user()->role === 'superadmin')
            <a href="{{ route('users.index') }}"
               class="block px-4 py-2 hover:bg-gray-700 {{ request()->routeIs('users.*') ? 'bg-gray-700' : '' }}">
                User
            </a>
        @endif
    </nav>
</aside>
