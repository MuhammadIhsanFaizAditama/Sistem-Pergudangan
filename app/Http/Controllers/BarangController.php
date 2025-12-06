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
        $barang = Barang::with('kategori')->paginate();
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
        $request -> validate([
            'nama_barang'=> 'required',
            'kode_barang'=> 'required|unique:barang',
            'satuan'=> 'required',
            'harga_beli'=>'required',
            'harga_jual,'=>'required',
            'stok'=>'required'

        ]);

        Barang::created($request->all());
        return redirect()->route('Barang.index')->with('success','Barang ditambahkan');
    }

    public function edit(Barang $barang)
    {
        $kategori = Barang::all();
        return view('barang.edit', compact('barang','kategori'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang'=> 'required',
            'kode_barang'=> 'required|unique:barang',
            'satuan'=> 'required',
            'harga_beli'=>'required',
            'harga_jual,'=>'required',
            'stok'=>'required'
        ]);
        $barang->update($request->all());
        return redirect()->route('Barang.index')->with('success','Barang diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('Barang.index')->with('success','Barang dihapus');
    }
}
