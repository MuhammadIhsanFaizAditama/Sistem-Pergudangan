@extends('layouts.dashboard')

@section('title', 'Detail Pembelian')
@section('page-title', 'Detail Pembelian')

@section('content')
<div class="bg-white rounded-lg shadow p-8 max-w-4xl mx-auto">
    
    {{-- Invoice Header --}}
    <div class="flex justify-between items-start border-b pb-6 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">INVOICE</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $pembelian->no_faktur }}</p>
        </div>
        <div class="text-right">
            <div class="mb-2">
                <span class="block text-xs text-gray-500 uppercase">Tanggal</span>
                <span class="text-lg font-medium text-gray-800">{{ $pembelian->tanggal->format('d M Y') }}</span>
            </div>
            <div>
                <span class="block text-xs text-gray-500 uppercase">Status</span>
                <span class="inline-block px-2 py-1 text-xs font-semibold rounded {{ $pembelian->status === 'selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ ucfirst($pembelian->status) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Supplier & User Info --}}
    <div class="flex justify-between mb-8">
        <div class="w-1/2">
            <h3 class="text-sm font-bold text-gray-500 uppercase mb-2">Supplier</h3>
            <p class="text-lg font-semibold text-gray-800">{{ $pembelian->supplier->nama_supplier }}</p>
            <p class="text-gray-600">{{ $pembelian->supplier->nama_kontak }}</p>
            <p class="text-gray-600">{{ $pembelian->supplier->no_hp }}</p>
        </div>
        <div class="w-1/2 text-right">
            <h3 class="text-sm font-bold text-gray-500 uppercase mb-2">Dibuat Oleh</h3>
            <p class="font-medium text-gray-800">{{ $pembelian->user->name ?? 'System' }}</p>
            <p class="text-gray-600 text-sm">{{ $pembelian->user->email ?? '' }}</p>
        </div>
    </div>

    {{-- Items Table --}}
    <div class="mb-8">
        <h3 class="text-sm font-bold text-gray-500 uppercase mb-4">Detail Item</h3>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-y">
                    <th class="py-3 px-4 font-medium text-gray-600">Barang</th>
                    <th class="py-3 px-4 font-medium text-gray-600 text-right">Harga Satuan</th>
                    <th class="py-3 px-4 font-medium text-gray-600 text-center">Qty</th>
                    <th class="py-3 px-4 font-medium text-gray-600 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelian->detailPembelian as $detail)
                <tr class="border-b">
                    <td class="py-3 px-4">
                        <span class="block font-medium text-gray-800">{{ $detail->barang->nama_barang }}</span>
                        <span class="text-xs text-gray-500">{{ $detail->barang->kode_barang }}</span>
                    </td>
                    <td class="py-3 px-4 text-right">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td class="py-3 px-4 text-center">{{ $detail->jumlah_beli }}</td>
                    <td class="py-3 px-4 text-right font-medium">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Grand Total --}}
    <div class="flex justify-end border-t pt-6">
        <div class="w-1/2 md:w-1/3">
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Total Item</span>
                <span class="font-medium">{{ $pembelian->detailPembelian->sum('jumlah_beli') }}</span>
            </div>
            <div class="flex justify-between items-center text-xl font-bold text-gray-800 mt-4 border-t pt-4">
                <span>Grand Total</span>
                <span>Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="mt-8 text-center no-print">
        <a href="{{ route('pembelian.index') }}" class="text-gray-600 hover:text-gray-900 underline">Kembali ke Daftar</a>
    </div>
</div>
@endsection
