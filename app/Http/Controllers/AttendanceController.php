<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // READ: Menampilkan semua data
    public function index()
    {
        $attendances = Attendance::orderBy('id', 'desc')->get();
        return view('attendance.index', compact('attendances'));
    }

    // CREATE: Menampilkan form tambah data
    public function create()
    {
        return view('attendance.create');
    }

    // STORE: Menyimpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:attendances,nip',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'keterangan_kehadiran' => 'required|in:Hadir,Sakit,Izin,Dinas Luar'
        ], [
            'nama_pegawai.required' => 'Nama pegawai wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'jam_masuk.required' => 'Jam masuk wajib diisi.',
            'keterangan_kehadiran.required' => 'Pilih keterangan kehadiran.'
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendance.index')
                         ->with('success', 'Data presensi berhasil ditambahkan!');
    }

    // SHOW
    public function show(string $id)
    {
        //
    }

    // EDIT
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);

        return view('attendance.edit', compact('attendance'));
    }

    // UPDATE
    public function update(Request $request, string $id)
    {
        // Cari data
        $attendance = Attendance::findOrFail($id);

        // Validasi
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:attendances,nip,' . $id,
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_pulang' => 'required',
            'keterangan_kehadiran' => 'required|in:Hadir,Sakit,Izin,Dinas Luar'
        ], [
            'nama_pegawai.required' => 'Nama pegawai tidak boleh kosong.',
            'nip.required' => 'NIP tidak boleh kosong.',
            'nip.numeric' => 'NIP harus angka.',
            'nip.unique' => 'NIP sudah digunakan.',
            'tanggal.required' => 'Tanggal wajib diisi.',
            'jam_masuk.required' => 'Jam masuk wajib diisi.',
            'jam_pulang.required' => 'Jam pulang wajib diisi.',
            'keterangan_kehadiran.required' => 'Keterangan wajib dipilih.'
        ]);

        // Update data
        $attendance->update($request->all());

        // Redirect
        return redirect()->route('attendance.index')
                         ->with('success', 'Data berhasil diperbarui!');
    }

    // DELETE
    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->delete();

        return redirect()->route('attendance.index')
                         ->with('success', 'Data berhasil dihapus!');
    }
}