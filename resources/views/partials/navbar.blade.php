<aside class="w-64 bg-gray-800 text-white flex-shrink-0">
    <div class="p-4 text-lg font-bold">
        Bengkel Gudang
    </div>

    <nav class="mt-4">
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 hover:bg-gray-700">
            Dashboard
        </a>

        <a href="{{ url('/barang') }}"
           class="block px-4 py-2 hover:bg-gray-700">
            Barang
        </a>

        <a href="{{ url('/kategori') }}"
           class="block px-4 py-2 hover:bg-gray-700">
            Kategori
        </a>

        <a href="{{ url('/supplier') }}"
           class="block px-4 py-2 hover:bg-gray-700">
            Supplier
        </a>

        <a href="{{ url('/pembelian') }}"
           class="block px-4 py-2 hover:bg-gray-700">
            Pembelian
        </a>

        @if(auth()->user()->role === 'superadmin')
            <a href="{{ url('/users') }}"
               class="block px-4 py-2 hover:bg-gray-700">
                User
            </a>
        @endif
    </nav>
</aside>
