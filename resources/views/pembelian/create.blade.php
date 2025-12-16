@extends('layouts.dashboard')

@section('title', 'Pembelian Baru')
@section('page-title', 'Pembelian Baru')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-5xl mx-auto">
    <div class="mb-6 border-b pb-4">
        <h2 class="text-xl font-semibold text-gray-800">Transaksi Pembelian</h2>
    </div>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('pembelian.store') }}" method="POST">
        @csrf
        
        {{-- Header Transaksi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                <select name="supplier_id" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($supplier as $sup)
                        <option value="{{ $sup->id }}">{{ $sup->nama_supplier }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ date('Y-m-d') }}" required>
            </div>
        </div>

        {{-- Detail Barang --}}
        <h3 class="text-lg font-medium text-gray-700 mb-2">Detail Barang</h3>
        <table class="w-full border-collapse mb-6" id="barang-table">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3 text-left w-2/5">Barang</th>
                    <th class="p-3 text-left w-1/5">Harga Satuan</th>
                    <th class="p-3 text-left w-1/5">Qty</th>
                    <th class="p-3 text-left w-1/5">Subtotal</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="barang-list">
                <tr class="border-b barang-row">
                    <td class="p-2">
                        <select name="barang_id[]" class="w-full border rounded px-2 py-1 select-barang" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->id }}" data-harga="{{ $item->harga_barang }}">
                                    {{ $item->nama_barang }} (Stok: {{ $item->stok_sekarang }})
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="p-2">
                        <input type="number" name="harga[]" class="w-full border rounded px-2 py-1 input-harga" min="0" required>
                    </td>
                    <td class="p-2">
                        <input type="number" name="qty[]" class="w-full border rounded px-2 py-1 input-qty" min="1" value="1" required>
                    </td>
                    <td class="p-2">
                        <input type="text" class="w-full border rounded px-2 py-1 bg-gray-100 input-subtotal" readonly>
                    </td>
                    <td class="p-2 text-center">
                        <button type="button" class="text-red-600 hover:text-red-800 btn-remove hidden">X</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mb-4">
            <button type="button" id="add-row" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">+ Tambah Baris</button>
        </div>

        <div class="flex justify-end items-center space-x-4 border-t pt-4">
            <div class="text-xl font-bold text-gray-800">Total: <span id="grand-total">Rp 0</span></div>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Simpan Transaksi
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('barang-list');
        const addRowBtn = document.getElementById('add-row');

        // Function to update row subtotal
        function updateRow(row) {
            const qty = parseFloat(row.querySelector('.input-qty').value) || 0;
            const harga = parseFloat(row.querySelector('.input-harga').value) || 0;
            const subtotal = qty * harga;
            
            row.querySelector('.input-subtotal').value = subtotal.toLocaleString('id-ID');
            updateGrandTotal();
        }

        // Function to update grand total
        function updateGrandTotal() {
            let total = 0;
            document.querySelectorAll('.barang-row').forEach(row => {
                const qty = parseFloat(row.querySelector('.input-qty').value) || 0;
                const harga = parseFloat(row.querySelector('.input-harga').value) || 0;
                total += qty * harga;
            });
            document.getElementById('grand-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Event listener for inputs
        tableBody.addEventListener('input', function(e) {
            if (e.target.classList.contains('input-qty') || e.target.classList.contains('input-harga')) {
                updateRow(e.target.closest('tr'));
            }
        });

        // Event listener for barang select change (auto fill price)
        tableBody.addEventListener('change', function(e) {
            if (e.target.classList.contains('select-barang')) {
                const option = e.target.options[e.target.selectedIndex];
                const harga = option.getAttribute('data-harga');
                const row = e.target.closest('tr');
                if (harga) {
                    row.querySelector('.input-harga').value = harga;
                    updateRow(row);
                }
            }
        });

        // Add Row
        addRowBtn.addEventListener('click', function() {
            const firstRow = tableBody.querySelector('.barang-row');
            const newRow = firstRow.cloneNode(true);
            
            // Reset values
            newRow.querySelector('select').value = '';
            newRow.querySelector('.input-harga').value = '';
            newRow.querySelector('.input-qty').value = '1';
            newRow.querySelector('.input-subtotal').value = '';
            
            // Show remove button
            newRow.querySelector('.btn-remove').classList.remove('hidden');
            
            tableBody.appendChild(newRow);
        });

        // Remove Row
        tableBody.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove')) {
                const row = e.target.closest('tr');
                // Don't remove if it's the only row
                if (document.querySelectorAll('.barang-row').length > 1) {
                    row.remove();
                    updateGrandTotal();
                }
            }
        });
    });
</script>
@endsection
