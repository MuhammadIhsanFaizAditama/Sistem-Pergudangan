<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::paginate(10);
        return view('User.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request -> validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        User::created($request->all());
        return redirect()->route('Supplier.index')->with('success','User ditambahkan');
    }

    public function edit(User $user)
    {
        return view('Supplier.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user->update($request->all());
        return redirect()->route('User.index')->with('success','User diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('User.index')->with('success','User dihapus');
    }
}
