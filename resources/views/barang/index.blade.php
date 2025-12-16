@extends('layouts.dashboard')

@section('title', 'Barang')
@section('page-title', 'Barang')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Barang</h2>
        <a href="{{ route('barang.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Tambah Barang
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-4 font-medium text-gray-600">No</th>
                    <th class="p-4 font-medium text-gray-600">Kode</th>
                    <th class="p-4 font-medium text-gray-600">Nama Barang</th>
                    <th class="p-4 font-medium text-gray-600">Kategori</th>
                    <th class="p-4 font-medium text-gray-600">Satuan</th>
                    <th class="p-4 font-medium text-gray-600">Harga Beli</th>
                    <th class="p-4 font-medium text-gray-600">Harga Jual</th>
                    <th class="p-4 font-medium text-gray-600">Stok</th>
                    <th class="p-4 font-medium text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $index => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">{{ $index + 1 }}</td>
                    <td class="p-4 text-gray-600">{{ $item->kode_barang }}</td>
                    <td class="p-4 text-gray-800 font-medium">{{ $item->nama_barang }}</td>
                    <td class="p-4 text-gray-600">{{ $item->kategori ? $item->kategori->nama_kategori : '-' }}</td>
                    <td class="p-4 text-gray-600">{{ $item->satuan }}</td>
                    <td class="p-4 text-gray-600">Rp {{ number_format($item->harga_barang, 0, ',', '.') }}</td>
                    <td class="p-4 text-gray-600">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                    <td class="p-4 text-gray-600 font-bold {{ $item->stok_sekarang < 10 ? 'text-red-600' : 'text-green-600' }}">
                        {{ $item->stok_sekarang }}
                    </td>
                    <td class="p-4 text-center">
                        <a href="{{ route('barang.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="p-6 text-center text-gray-500">
                        Belum ada data barang.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $barang->links() }}
        </div>
    </div>
</div>
@endsection
