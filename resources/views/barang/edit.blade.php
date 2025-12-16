@extends('layouts.dashboard')

@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-4xl mx-auto">
    <div class="mb-6 border-b pb-4">
        <h2 class="text-xl font-semibold text-gray-800">Edit Barang</h2>
    </div>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="mb-4">
                <label for="kode_barang" class="block text-sm font-medium text-gray-700 mb-1">Kode Barang</label>
                <input type="text" name="kode_barang" id="kode_barang" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kode_barang') border-red-500 @enderror"
                    value="{{ old('kode_barang', $barang->kode_barang) }}" required>
                @error('kode_barang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                <input type="text" name="nama_barang" id="nama_barang" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_barang') border-red-500 @enderror"
                    value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                @error('nama_barang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori_id" id="kategori_id" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kategori_id') border-red-500 @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id', $barang->kategori_id) == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="satuan" class="block text-sm font-medium text-gray-700 mb-1">Satuan</label>
                <input type="text" name="satuan" id="satuan" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('satuan') border-red-500 @enderror"
                    value="{{ old('satuan', $barang->satuan) }}" required>
                @error('satuan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga_barang" class="block text-sm font-medium text-gray-700 mb-1">Harga Beli</label>
                <input type="number" name="harga_barang" id="harga_barang" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('harga_barang') border-red-500 @enderror"
                    value="{{ old('harga_barang', $barang->harga_barang) }}" required>
                @error('harga_barang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga_jual" class="block text-sm font-medium text-gray-700 mb-1">Harga Jual</label>
                <input type="number" name="harga_jual" id="harga_jual" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('harga_jual') border-red-500 @enderror"
                    value="{{ old('harga_jual', $barang->harga_jual) }}" required>
                @error('harga_jual')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="stok_sekarang" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                <input type="number" name="stok_sekarang" id="stok_sekarang" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stok_sekarang') border-red-500 @enderror"
                    value="{{ old('stok_sekarang', $barang->stok_sekarang) }}" required>
                @error('stok_sekarang')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex justify-end space-x-2 mt-6">
            <a href="{{ route('barang.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
