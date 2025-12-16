@extends('layouts.dashboard')

@section('title', 'Tambah Supplier')
@section('page-title', 'Tambah Supplier')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-md mx-auto">
    <div class="mb-6 border-b pb-4">
        <h2 class="text-xl font-semibold text-gray-800">Form Tambah Supplier</h2>
    </div>

    <form action="{{ route('supplier.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nama_supllier" class="block text-sm font-medium text-gray-700 mb-1">Nama Supplier</label>
            <input type="text" name="nama_supllier" id="nama_supllier" 
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_supllier') border-red-500 @enderror"
                value="{{ old('nama_supllier') }}" required>
            @error('nama_supllier')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="nama_kontak" class="block text-sm font-medium text-gray-700 mb-1">Nama Kontak</label>
            <input type="text" name="nama_kontak" id="nama_kontak" 
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_kontak') border-red-500 @enderror"
                value="{{ old('nama_kontak') }}" required>
            @error('nama_kontak')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="no_telpon" class="block text-sm font-medium text-gray-700 mb-1">No HP / Telpon</label>
            <input type="number" name="no_telpon" id="no_telpon" 
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_telpon') border-red-500 @enderror"
                value="{{ old('no_telpon') }}" required>
            @error('no_telpon')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('supplier.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
