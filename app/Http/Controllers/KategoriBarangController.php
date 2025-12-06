<?php

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = KategoriBarang::paginate(10);
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nama_kategori'=> 'required',
            'deskripsi' => 'nullable'
        ]);

        KategoriBarang::create($request->all());

        return redirect()->route('kategori.index')->with('success','Kategori ditambahkan');
    }

    public function edit(KategoriBarang $kategori)
    {
        return view('kategori.edit',compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriBarang $kategori)
    {
        $request -> validate([
            'nama_kategori'=> 'required',
            'deskripsi' => 'nullable'
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success','Kategori diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriBarang $kategori)
    {
         $kategori->delete();

         return redirect()->route('kategori.index')->with('success','Kategori dihapus');
    }
}
