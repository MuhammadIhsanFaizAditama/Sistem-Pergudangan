@extends('layouts.dashboard')

@section('title', 'Supplier')
@section('page-title', 'Supplier')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Supplier</h2>
        <a href="{{ route('supplier.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Tambah Supplier
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
                    <th class="p-4 font-medium text-gray-600">Nama Supplier</th>
                    <th class="p-4 font-medium text-gray-600">Nama Kontak</th>
                    <th class="p-4 font-medium text-gray-600">No HP</th>
                    <th class="p-4 font-medium text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($supplier as $index => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">{{ $index + 1 }}</td>
                    <td class="p-4 text-gray-800 font-medium">{{ $item->nama_supllier }}</td>
                    <td class="p-4 text-gray-600">{{ $item->nama_kontak }}</td>
                    <td class="p-4 text-gray-600">{{ $item->no_telpon }}</td>
                    <td class="p-4 text-center">
                        <a href="{{ route('supplier.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                        <form action="{{ route('supplier.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">
                        Belum ada data supplier.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
