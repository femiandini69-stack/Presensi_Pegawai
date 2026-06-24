<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('pegawai')->orderBy('id', 'desc');

        // SEARCH (NIP / NAMA)
        if ($request->search) {
            $query->whereHas('pegawai', function ($q) use ($request) {
                $q->where('nip', 'like', '%' . $request->search . '%')
                  ->orWhere('nama', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER STATUS
        if ($request->filter) {
            $query->where('keterangan_kehadiran', $request->filter);
        }

        $attendances = $query->get();

        return view('presensi.index', compact('attendances'));
    }

    public function create()
    {
        $pegawais = Pegawai::all();
        return view('attendance.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'keterangan_kehadiran' => 'required|in:Hadir,Sakit,Izin,Cuti,Alpha,Dinas Luar',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'pegawai_id' => $request->pegawai_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
        ];

        // upload bukti
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('bukti'), $filename);
            $data['bukti'] = $filename;
        }

        // auto jam pulang 8 jam
        $data['jam_pulang'] = Carbon::parse($request->jam_masuk)
            ->addHours(8)
            ->format('H:i');

        Attendance::create($data);

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $attendance = Attendance::with('pegawai')->findOrFail($id);
        $pegawais = Pegawai::all();

        return view('attendance.edit', compact('attendance', 'pegawais'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'keterangan_kehadiran' => 'required|in:Hadir,Sakit,Izin,Cuti,Alpha,Dinas Luar'
        ]);

        $attendance = Attendance::findOrFail($id);

        $attendance->update([
            'pegawai_id' => $request->pegawai_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
            'jam_pulang' => Carbon::parse($request->jam_masuk)
                ->addHours(8)
                ->format('H:i'),
        ]);

        return redirect()->route('presensi.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();

        return redirect()->route('presensi.index')
            ->with('success', 'Data berhasil dihapus');
    }
}