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

    private function hitungJamPulang($jamMasuk, $status)
    {
        if (in_array($status, ['Sakit', 'Izin'])) {
            return null;
        }

        $jamPulang = \Carbon\Carbon::parse($jamMasuk)->addHours(8);
        $batasMax  = \Carbon\Carbon::parse($jamMasuk)->setTime(22, 0, 0);

        return $jamPulang->gt($batasMax)
            ? $batasMax->format('H:i')
            : $jamPulang->format('H:i');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai'         => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'nip'                  => 'required|numeric|unique:attendances,nip',
            'tanggal'              => 'required|date',
            'jam_masuk'            => 'required|date_format:H:i',
            'jam_pulang'           => 'nullable',
            'keterangan_kehadiran' => 'required'
        ], [
            'nama_pegawai.required'         => 'Nama pegawai wajib diisi',
            'nama_pegawai.regex'            => 'Nama hanya boleh huruf, tidak boleh angka',
            'nip.required'                  => 'NIP wajib diisi',
            'nip.numeric'                   => 'NIP harus berupa angka saja',
            'nip.unique'                    => 'NIP sudah terdaftar',
            'tanggal.required'              => 'Tanggal wajib diisi',
            'tanggal.date'                  => 'Format tanggal tidak valid',
            'jam_masuk.required'            => 'Jam masuk wajib diisi',
            'keterangan_kehadiran.required' => 'Status kehadiran wajib dipilih',
        ]);

        if ($request->jam_masuk < '07:00') {
            return back()->withErrors(['jam_masuk' => 'Jam masuk tidak boleh sebelum 07:00'])->withInput();
        }

        $data = $request->all();

        if (empty($data['jam_pulang'])) {
            $data['jam_pulang'] = $this->hitungJamPulang(
                $request->jam_masuk,
                $request->keterangan_kehadiran
            );
        }

        Attendance::create($data);

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // KUNCI PROTEKSI: Hanya Admin yang boleh masuk ke halaman edit
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        $attendance = Attendance::findOrFail($id);
        return view('attendance.edit', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        // KUNCI PROTEKSI: Hanya Admin yang boleh mengeksekusi update data
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }
        
        $request->merge([
            'jam_masuk' => \Carbon\Carbon::parse($request->jam_masuk)->format('H:i'),
        ]);
        
        $attendance = Attendance::findOrFail($id);

        $request->validate([
            'nama_pegawai'         => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'nip'                  => 'required|numeric|unique:attendances,nip,' . $id, // Diperbaiki agar NIP tidak bentrok saat edit data sendiri
            'tanggal'              => 'required|date',
            'jam_masuk'            => 'required|date_format:H:i',
            'jam_pulang'           => 'nullable',
            'keterangan_kehadiran' => 'required'
        ], [
            'nama_pegawai.required'         => 'Nama pegawai wajib diisi',
            'nama_pegawai.regex'            => 'Nama hanya boleh huruf, tidak boleh angka',
            'nip.required'                  => 'NIP wajib diisi',
            'nip.numeric'                   => 'NIP harus berupa angka saja',
            'nip.unique'                    => 'NIP sudah terdaftar',
            'tanggal.required'              => 'Tanggal wajib diisi',
            'tanggal.date'                  => 'Format tanggal tidak valid',
            'jam_masuk.required'            => 'Jam masuk wajib diisi',
            'keterangan_kehadiran.required' => 'Status kehadiran wajib dipilih',
        ]);

        if ($request->jam_masuk < '07:00') {
            return back()->withErrors(['jam_masuk' => 'Jam masuk tidak boleh sebelum 07:00'])->withInput();
        }

        $jamPulang = $request->jam_pulang ?: $this->hitungJamPulang(
            $request->jam_masuk,
            $request->keterangan_kehadiran
        );

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
        // KUNCI PROTEKSI: Hanya Admin yang boleh menghapus data
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak');
        }

        Attendance::findOrFail($id)->delete();
        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}