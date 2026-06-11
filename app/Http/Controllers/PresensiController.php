<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Pegawai;

class PresensiController extends Controller
{
    // TAMPIL FORM (NO 3)
    public function create()
    {
        $pegawais = Pegawai::all();
        return view('presensi.create', compact('pegawais'));
    }

    // SIMPAN DATA (NO 5)
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'status' => 'required',
            'bukti' => 'required|file|mimes:jpg,jpeg,png,pdf'
        ]);

        $file = $request->file('bukti');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);

        Presensi::create([
            'pegawai_id' => $request->pegawai_id,
            'status' => $request->status,
            'bukti' => $filename,
        ]);

        return redirect()->back()->with('success', 'Presensi berhasil');
    }
}