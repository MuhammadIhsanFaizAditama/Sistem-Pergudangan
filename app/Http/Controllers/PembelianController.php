<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Supplier;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelian = Pembelian::with('supplier')->latest()->paginate(10);
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
        DB::transaction(function () use ($request) {

            // Simpan pembelian
            $pembelian = Pembelian::create([
                'supplier_id' => $request->supplier_id,
                'tanggal' => $request->tanggal,
                'total' => $request->total,
            ]);

            // Simpan detail pembelian
            foreach ($request->barang_id as $i => $barang_id) {
                DetailPembelian::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $barang_id,
                    'qty' => $request->qty[$i],
                    'harga' => $request->harga[$i],
                    'subtotal' => $request->subtotal[$i],
                ]);

                // Update stok barang
                Barang::where('id', $barang_id)->increment('stok', $request->qty[$i]);
            }
        });

        return redirect()->route('pembelian.index')
            ->with('success', 'Pembelian berhasil disimpan');
    }

    public function show($id)
    {
        $pembelian = Pembelian::with('detail.barang', 'supplier')->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }

    public function destroy($id)
    {
        Pembelian::findOrFail($id)->delete();
        return back()->with('success', 'Pembelian berhasil dihapus');
    }
}
