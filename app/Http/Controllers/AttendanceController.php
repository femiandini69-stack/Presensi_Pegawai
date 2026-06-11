<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::orderBy('id', 'desc');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nip', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_pegawai', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filter) {
            $query->where('keterangan_kehadiran', $request->filter);
        }

        $attendances = $query->get();
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        return view('attendance.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai'         => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'nip'                  => 'required|numeric|unique:attendances,nip',
            'tanggal'              => 'required|date',
            'jam_masuk'            => 'required|date_format:H:i',
            'keterangan_kehadiran' => 'required'
        ]);

        if ($request->jam_masuk < '07:00') {
            return back()->withErrors(['jam_masuk' => 'Jam masuk tidak boleh sebelum 07:00'])->withInput();
        }

        $data = $request->all();

        
        $data['jam_pulang'] = Carbon::parse($request->jam_masuk)
            ->addHours(8)
            ->format('H:i');

        Attendance::create($data);

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        $attendance = Attendance::findOrFail($id);
        return view('attendance.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        $attendance = Attendance::findOrFail($id);

        $request->merge([
            'jam_masuk' => Carbon::parse($request->jam_masuk)->format('H:i'),
        ]);

        $request->validate([
            'nama_pegawai'         => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'nip'                  => 'required|numeric|unique:attendances,nip,' . $id,
            'tanggal'              => 'required|date',
            'jam_masuk'            => 'required|date_format:H:i',
            'keterangan_kehadiran' => 'required'
        ]);

        if ($request->jam_masuk < '07:00') {
            return back()->withErrors(['jam_masuk' => 'Jam masuk tidak boleh sebelum 07:00'])->withInput();
        }

 
        $jamPulang = Carbon::parse($request->jam_masuk)
            ->addHours(8)
            ->format('H:i');

        $attendance->update([
            'nama_pegawai'         => $request->nama_pegawai,
            'nip'                  => $request->nip,
            'tanggal'              => $request->tanggal,
            'jam_masuk'            => $request->jam_masuk,
            'jam_pulang'           => $jamPulang,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        Attendance::findOrFail($id)->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}