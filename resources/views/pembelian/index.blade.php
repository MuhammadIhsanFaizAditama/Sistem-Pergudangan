@extends('layouts.dashboard')

@section('title', 'Riwayat Pembelian')
@section('page-title', 'Riwayat Pembelian')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Pembelian</h2>
        <a href="{{ route('pembelian.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Pembelian Baru
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
                    <th class="p-4 font-medium text-gray-600">No Faktur</th>
                    <th class="p-4 font-medium text-gray-600">Tanggal</th>
                    <th class="p-4 font-medium text-gray-600">Supplier</th>
                    <th class="p-4 font-medium text-gray-600">Total Harga</th>
                    <th class="p-4 font-medium text-gray-600">Status</th>
                    <th class="p-4 font-medium text-gray-600">User</th>
                    <th class="p-4 font-medium text-gray-600 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembelian as $index => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">{{ $index + 1 }}</td>
                    <td class="p-4 text-gray-800 font-medium">{{ $item->no_faktur }}</td>
                    <td class="p-4 text-gray-600">{{ $item->tanggal->format('d M Y') }}</td>
                    <td class="p-4 text-gray-600">{{ $item->supplier->nama_supplier }}</td>
                    <td class="p-4 text-green-600 font-bold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded {{ $item->status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-600 text-sm">{{ $item->user->name ?? '-' }}</td>
                    <td class="p-4 text-center">
                        <a href="{{ route('pembelian.show', $item->id) }}" class="text-blue-600 hover:text-blue-800 mr-2">Detail</a>
                        <form action="{{ route('pembelian.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="p-6 text-center text-gray-500">
                        Belum ada data pembelian.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $pembelian->links() }}
        </div>
    </div>
</div>
@endsection
