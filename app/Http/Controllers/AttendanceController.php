<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

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
            'nama_pegawai' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'nip' => 'required|numeric|unique:attendances,nip',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_pulang' => 'nullable',
            'keterangan_kehadiran' => 'required'
        ], [
            'nama_pegawai.required' => 'Nama pegawai wajib diisi',
            'nama_pegawai.regex' => 'Nama hanya boleh huruf, tidak boleh angka',
            'nip.required' => 'NIP wajib diisi',
            'nip.numeric' => 'NIP harus berupa angka saja',
            'nip.unique' => 'NIP sudah terdaftar',
            'tanggal.required' => 'Tanggal wajib diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'jam_masuk.required' => 'Jam masuk wajib diisi',
            'keterangan_kehadiran.required' => 'Status kehadiran wajib dipilih',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('attendance.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $request->validate([
            'nama_pegawai' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'nip' => 'required|numeric|unique:attendances,nip,' . $id,
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_pulang' => 'nullable',
            'keterangan_kehadiran' => 'required'
        ], [
            'nama_pegawai.required' => 'Nama pegawai wajib diisi',
            'nama_pegawai.regex' => 'Nama hanya boleh huruf, tidak boleh angka',
            'nip.numeric' => 'NIP harus angka saja',
            'nip.unique' => 'NIP sudah digunakan',
            'tanggal.required' => 'Tanggal wajib diisi',
            'jam_masuk.required' => 'Jam masuk wajib diisi',
            'keterangan_kehadiran.required' => 'Status kehadiran wajib dipilih',
        ]);

        $attendance->update([
            'nama_pegawai' => $request->nama_pegawai,
            'nip' => $request->nip,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_pulang' => $request->jam_pulang,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Attendance::findOrFail($id)->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}