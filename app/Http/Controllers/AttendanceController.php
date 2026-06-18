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
            'nama_pegawai'         => 'required|string|max:255',
            'nip'                  => 'required|numeric', 
            'tanggal'              => 'required|date',
            'jam_masuk'            => 'required', 
            'keterangan_kehadiran' => 'required',
            'bukti'                => 'required|image|mimes:jpg,jpeg,png|max:2048' 
        ], [
            'bukti.required'       => 'Foto harus diisi!',
            'bukti.image'          => 'File yang diunggah harus berupa gambar!',
            'bukti.mimes'          => 'Format foto harus berupa jpg, jpeg, atau png!',
            'bukti.max'            => 'Ukuran foto maksimal adalah 2MB!',
        ]);

        if ($request->jam_masuk < '07:00') {
            return back()->withErrors(['jam_masuk' => 'Jam masuk tidak boleh sebelum 07:00'])->withInput();
        }

        $data = [
            'nama_pegawai'         => $request->nama_pegawai,
            'nip'                  => $request->nip,
            'tanggal'              => $request->tanggal,
            'jam_masuk'            => $request->jam_masuk,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
        ];

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('bukti'), $filename);
            $data['bukti'] = $filename;
        }

        $data['jam_pulang'] = Carbon::parse($request->jam_masuk)->addHours(8)->format('H:i');

        Attendance::create($data);
        return redirect()->route('attendance.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show($id)
    {
        return redirect()->route('attendance.index');
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
            'nama_pegawai'         => 'required|string|max:255', 
            'nip'                  => 'required|numeric',
            'tanggal'              => 'required|date',
            'jam_masuk'            => 'required', 
            'jam_pulang'           => 'nullable',
            'keterangan_kehadiran' => 'required',
            'bukti'                => 'nullable|image|mimes:jpg,jpeg,png|max:2048' 
        ], [
            'bukti.image'          => 'File yang diunggah harus berupa gambar!',
            'bukti.mimes'          => 'Format foto harus berupa jpg, jpeg, atau png!',
            'bukti.max'            => 'Ukuran foto maksimal adalah 2MB!',
        ]);

        $jam_masuk_format = Carbon::parse($request->jam_masuk)->format('H:i');

        if ($jam_masuk_format < '07:00') {
            return back()->withErrors(['jam_masuk' => 'Jam masuk tidak boleh sebelum 07:00'])->withInput();
        }

        $data = [
            'nama_pegawai'         => $request->nama_pegawai,
            'nip'                  => $request->nip,
            'tanggal'              => $request->tanggal,
            'jam_masuk'            => $jam_masuk_format,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
        ];

        if ($request->hasFile('bukti')) {
            if ($attendance->bukti && File::exists(public_path('bukti/' . $attendance->bukti))) {
                File::delete(public_path('bukti/' . $attendance->bukti));
            }

            $file = $request->file('bukti');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('bukti'), $filename);
            $data['bukti'] = $filename;
        }

        if ($request->filled('jam_pulang')) {
            $data['jam_pulang'] = Carbon::parse($request->jam_pulang)->format('H:i');
        } else {
            $data['jam_pulang'] = Carbon::parse($request->jam_masuk)->addHours(8)->format('H:i');
        }

        $attendance->update($data);
        return redirect()->route('attendance.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);

        if ($attendance->bukti && File::exists(public_path('bukti/' . $attendance->bukti))) {
            File::delete(public_path('bukti/' . $attendance->bukti));
        }

        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Data berhasil dihapus!');
    }
}