<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupllierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::paginate(10);
        return view('supplier.index', compact('supplier'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supllier'=> 'required',
            'nama_kontak'=> 'nullable',
            'no_telpon'=> 'required'
        ]);

        Supplier::create($request->all());
        return redirect()->route('supplier.index')->with('success','Supplier ditambahkan');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
       $request->validate([
            'nama_supllier'=> 'required',
            'nama_kontak'=> 'nullable',
            'no_telpon'=> 'required'
        ]);

        $supplier->update($request->all());
        return redirect()->route('supplier.index')->with('success','Supplier diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success','Supplier dihapus');
    }
}
