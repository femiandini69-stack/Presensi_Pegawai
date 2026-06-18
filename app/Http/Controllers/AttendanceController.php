<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

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
            'keterangan_kehadiran' => 'required',
            'bukti'                => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->jam_masuk < '07:00') {
            return back()->withErrors([
                'jam_masuk' => 'Jam masuk tidak boleh sebelum 07:00'
            ])->withInput();
        }

        $data = [
            'nama_pegawai' => $request->nama_pegawai,
            'nip' => $request->nip,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
        ];

        // upload bukti
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti'), $filename);
            $data['bukti'] = $filename;
        }

        // jam pulang otomatis
        $data['jam_pulang'] = Carbon::parse($request->jam_masuk)
            ->addHours(8)
            ->format('H:i');

        Attendance::create($data);

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
            'nama_pegawai'         => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'nip'                  => 'required|numeric|unique:attendances,nip,' . $id,
            'tanggal'              => 'required|date',
            'jam_masuk'            => 'required|date_format:H:i',
            'keterangan_kehadiran' => 'required',
            'bukti'                => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->jam_masuk < '07:00') {
            return back()->withErrors([
                'jam_masuk' => 'Jam masuk tidak boleh sebelum 07:00'
            ])->withInput();
        }

        $data = [
            'nama_pegawai' => $request->nama_pegawai,
            'nip' => $request->nip,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
        ];

        // kalau upload bukti baru
        if ($request->hasFile('bukti')) {

            // hapus file lama
            if ($attendance->bukti && File::exists(public_path('bukti/' . $attendance->bukti))) {
                File::delete(public_path('bukti/' . $attendance->bukti));
            }

            $file = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti'), $filename);

            $data['bukti'] = $filename;
        }

        $data['jam_pulang'] = Carbon::parse($request->jam_masuk)
            ->addHours(8)
            ->format('H:i');

        $attendance->update($data);

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);

        if ($attendance->bukti && File::exists(public_path('bukti/' . $attendance->bukti))) {
            File::delete(public_path('bukti/' . $attendance->bukti));
        }

        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}