<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::with('kategori')->paginate(10);
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = KategoriBarang::all();
        return view('barang.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:_barang_table,kode_barang',
            'satuan' => 'required|string',
            'harga_barang' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok_sekarang' => 'required|integer',
            'kategori_id' => 'required|exists:_kategori_barang,id'
        ]);

        Barang::create($request->all());
        return redirect()->route('barang.index')->with('success','Barang ditambahkan');
    }

    public function edit(Barang $barang)
    {
        $kategori = KategoriBarang::all();
        return view('barang.edit', compact('barang','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:_barang_table,kode_barang,'.$barang->id,
            'satuan' => 'required|string',
            'harga_barang' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stok_sekarang' => 'required|integer',
            'kategori_id' => 'required|exists:_kategori_barang,id'
        ]);
        
        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success','Barang diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success','Barang dihapus');
    }
}
