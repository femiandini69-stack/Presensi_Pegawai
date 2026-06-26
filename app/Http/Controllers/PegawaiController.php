<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{

    // =========================
    // LIST PEGAWAI
    // =========================
    public function index()
    {
        $pegawais = Pegawai::all();

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
    // SIMPAN DATA
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


        Pegawai::create([

            'nama' => $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,

        ]);


        return redirect()
            ->route('pegawai.index')
            ->with('success','Pegawai berhasil ditambah!');
    }



    // =========================
    // FORM EDIT
    // =========================
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        return view('pegawai.edit', compact('pegawai'));
    }



    // =========================
    // UPDATE DATA
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

$pegawai = Pegawai::where('nip',$id)->firstOrFail();


        $pegawai->update([

            'nama' => $request->nama,
            'nip' => $request->nip,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jabatan' => $request->jabatan,
            'divisi' => $request->divisi,

        ]);


        return redirect()
            ->route('pegawai.index')
            ->with('success','Data pegawai berhasil diperbarui!');
    }



    // =========================
    // HAPUS DATA
    // =========================
    public function destroy($nip)
{

    $pegawai = Pegawai::where('nip',$nip)->firstOrFail();

    $pegawai->delete();


    return redirect()
        ->route('pegawai.index')
        ->with('success','Data pegawai berhasil dihapus!');
}
}