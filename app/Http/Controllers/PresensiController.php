<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;

class PresensiController extends Controller
{
    public function index()
    {
        // Admin lihat semua, Pegawai lihat miliknya saja
        if (auth()->user()->role === 'admin') {
            $presensi = Presensi::with('pegawai')->latest()->get();
        } else {
            $presensi = Presensi::where('pegawai_id', auth()->id())->latest()->get();
        }
        return view('presensi.index', compact('presensi'));
    }

    public function store(Request $request)
    {
        $now = now('Asia/Jakarta');

        if ($now->format('H:i') < '07:00') {
            return back()->with('error', 'Presensi belum dibuka, silakan tunggu sampai pukul 07:00');
        }

        $data = $request->validate([
            'pegawai_id' => 'required',
            'status' => 'required',
            'keterangan' => 'nullable',
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data['tanggal'] = $now->toDateString();
        $data['jam_masuk'] = $now->format('H:i:s');
        $data['jam_pulang'] = $now->copy()->addHours(8)->format('H:i:s');
        
        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('presensi', 'public');
        }

        Presensi::create($data);
        return back()->with('success', 'Presensi berhasil disimpan!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') return back()->with('error', 'Akses ditolak!');
        Presensi::find($id)->delete();
        return back()->with('success', 'Data dihapus!');
    }
}