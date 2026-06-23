<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // =========================
    // LIST PEGAWAI
    // =========================
    public function index()
    {
        $pegawais = User::where('role', 'pegawai')->get();
        return view('pegawai.index', compact('pegawais'));
    }

    // =========================
    // FORM TAMBAH
    // =========================
    public function create()
    {
        return view('pegawai.create');
    }

    // =========================
    // SIMPAN DATA BARU
    // =========================
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

    // =========================
    // FORM EDIT (INI FIX UTAMA)
    // =========================
    public function edit($id)
    {
        $pegawai = User::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    // =========================
    // UPDATE DATA (FIX TOTAL)
    // =========================
    
    public function update(Request $request, $id)
{

    $request->validate([
        'nama' => 'required',
        'nip' => 'required',
        'jenis_kelamin' => 'required',
        'jabatan' => 'required',
        'divisi' => 'required',
    ]);

    $pegawai = User::findOrFail($id);

    $pegawai->name = $request->nama;
    $pegawai->nip = $request->nip;
    $pegawai->jenis_kelamin = $request->jenis_kelamin;
    $pegawai->jabatan = $request->jabatan;
    $pegawai->divisi = $request->divisi;

    $pegawai->save();

    return redirect()->route('pegawai.index')
        ->with('success', 'Data pegawai berhasil diperbarui!');
}
    // =========================
    // HAPUS DATA
    // =========================
    public function destroy($id)
    {
        $pegawai = User::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data pegawai berhasil dihapus!');
    }
}