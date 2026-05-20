<?php
namespace App\Http\Controllers;
use App\Models\Attendance;
use Illuminate\Http\Request;
class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::orderBy('id', 'desc')->get();
        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        return view('attendance.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'required|string|unique:attendances,nip',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'keterangan_kehadiran' => 'required|in:Hadir,Sakit,Izin,Dinas Luar'
        ], [
            'nama_pegawai.required' => 'Nama pegawai wajib diisi.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.string' => 'NIP harus berupa string.',
            'nip.unique' => 'NIP ini sudah terdaftar di sistem.',
            'tanggal.required' => 'Tanggal presensi wajib diisi.',
            'jam_masuk.required' => 'Jam masuk wajib ditentukan.',
            'keterangan_kehadiran.required' => 'Pilih keterangan kehadiran yang valid.'
        ]);
        Attendance::create($request->all());
        return redirect()->route('attendance.index')->with('success', 'Data presensi berhasil ditambahkan!');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('attendance.edit', compact('attendance'));
    }

    public function update(Request $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'nullable|string|unique:attendances,nip,' . $id,
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'keterangan_kehadiran' => 'required|in:Hadir,Sakit,Izin,Dinas Luar'
        ]);
        $attendance->update($request->all());
        return redirect()->route('attendance.index')
            ->with('success', 'DATABASE_UPDATED: Log berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Data catatan kehadiran berhasil dihapus!');
    }
}