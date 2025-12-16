<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::with('supplier', 'user')->latest()->paginate(10);
        return view('pembelian.index', compact('pembelian'));
    }

    public function create()
    {
        $supplier = Supplier::all();
        $barang = Barang::all();

        return view('pembelian.create', compact('supplier', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:supplier,id',
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'required|exists:_barang_table,id',
            'qty' => 'required|array',
            'qty.*' => 'required|integer|min:1',
            'harga' => 'required|array',
            'harga.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Hitung total harga
                $GrandTotal = 0;
                foreach ($request->qty as $key => $qty) {
                   $subtotal = $qty * $request->harga[$key];
                   $GrandTotal += $subtotal;
                }

                // Simpan pembelian
                $pembelian = Pembelian::create([
                    'no_faktur' => 'INV-' . strtoupper(Str::random(10)),
                    'supplier_id' => $request->supplier_id,
                    'user_id' => auth()->id(),
                    'tanggal' => $request->tanggal,
                    'total_harga' => $GrandTotal,
                    'status' => 'selesai', // Langsung selesai karena nambah stok
                ]);

                // Simpan detail pembelian
                foreach ($request->barang_id as $i => $barang_id) {
                    $subtotal = $request->qty[$i] * $request->harga[$i];

                    DetailPembelian::create([
                        'pembelian_id' => $pembelian->id,
                        'barang_id' => $barang_id,
                        'jumlah_beli' => $request->qty[$i],
                        'harga_satuan' => $request->harga[$i],
                        'subtotal' => $subtotal,
                    ]);

                    // Update stok barang
                    Barang::where('id', $barang_id)->increment('stok_sekarang', $request->qty[$i]);
                    // Optional: Update harga beli barang master jika perlu
                }
            });

            return redirect()->route('pembelian.index')
                ->with('success', 'Pembelian berhasil disimpan');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pembelian = Pembelian::with('detailPembelian.barang', 'supplier', 'user')->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }

    public function destroy($id)
    {
        // Optional: Revert stock if deleted? For now just delete.
        Pembelian::findOrFail($id)->delete();
        return back()->with('success', 'Pembelian berhasil dihapus');
    }
}
