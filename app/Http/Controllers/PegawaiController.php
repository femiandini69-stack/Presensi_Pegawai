<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = User::where('role', 'pegawai')->get();
    return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
        ]);

        User::create([
            'name' => $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,
            'email' => 'temp_' . time() . '@example.com',
            'password' => bcrypt('password123'),
            'role' => 'pegawai',
        ]);

        return redirect()->route('pegawai.index')
            ->with('success', 'Pegawai berhasil ditambah!');
    }

    public function destroy($id)
    {
        $pegawai = User::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus!');
    }
}