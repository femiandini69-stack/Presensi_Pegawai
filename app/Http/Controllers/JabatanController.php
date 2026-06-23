<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    
    public function index() {
        $jabatans = Jabatan::all();
        return view('jabatan.index', compact('jabatans'));
    }

  
    public function store(Request $request) {
        $request->validate(['nama_jabatan' => 'required']);
        Jabatan::create($request->all());
        return back()->with('success', 'Data berhasil ditambah!');
    }

    public function edit($id) {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.edit', compact('jabatan'));
    }

    
    public function update(Request $request, $id) {
        $request->validate(['nama_jabatan' => 'required']);
        
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update($request->all());
        
        return redirect()->route('jabatan.index')->with('success', 'Data berhasil diupdate!');
    }

    
    public function destroy($id) {
        Jabatan::findOrFail($id)->delete();
        return back()->with('success', 'Data berhasil dihapus!');
    }
}