<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $presensi = Presensi::latest()->get();
        } else {
            $presensi = Presensi::where('pegawai_id', $user->id)
                ->latest()
                ->get();
        }

        return view('presensi.index', compact('presensi'));
    }

    public function create()
    {
        return view('presensi.create');
    }

    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Jakarta');

        if ($now->format('H:i') < '07:00') {
            return back()->with('error', 'Presensi belum dibuka (07:00)');
        }

        $data = $request->validate([
            'nama' => 'required',
            'nip' => 'nullable',
            'jabatan' => 'nullable',
            'divisi' => 'nullable',
            'status' => 'required',
            'keterangan' => 'nullable',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        // AUTO DATA
        $data['pegawai_id'] = auth()->id();
        $data['tanggal'] = $now->toDateString();
        $data['jam_masuk'] = $now->format('H:i:s');
        $data['jam_pulang'] = $now->copy()->addHours(8)->format('H:i:s');

        // UPLOAD FILE
        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('presensi', 'public');
        }

        Presensi::create($data);

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil disimpan!');
    }

    public function edit($id)
    {
        $presensi = Presensi::findOrFail($id);

        return view('presensi.edit', compact('presensi'));
    }

    public function update(Request $request, $id)
    {
        $presensi = Presensi::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'nip' => 'nullable',
            'jabatan' => 'nullable',
            'divisi' => 'nullable',
            'status' => 'required',
            'keterangan' => 'nullable',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('presensi', 'public');
        }

        $presensi->update($data);

        return redirect()->route('presensi.index')
            ->with('success', 'Data berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            return back()->with('error', 'Akses ditolak!');
        }

        $presensi = Presensi::findOrFail($id);
        $presensi->delete();

        return back()->with('success', 'Data dihapus!');
    }
}