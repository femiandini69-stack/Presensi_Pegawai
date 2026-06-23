<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('user')->orderBy('id', 'desc');

        // SEARCH (NIP / NAME)
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nip', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER STATUS
        if ($request->filter) {
            $query->where('keterangan_kehadiran', $request->filter);
        }

        $attendances = $query->get();

        return view('attendance.index', compact('attendances'));
    }

    public function create()
    {
        $users = User::all();
        return view('attendance.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'keterangan_kehadiran' => 'required|in:hadir,sakit,izin,cuti,alpha,dinas luar',
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
        ];

        // UPLOAD BUKTI
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('bukti'), $filename);
            $data['bukti'] = $filename;
        }

        // AUTO JAM PULANG (8 JAM)
        $data['jam_pulang'] = Carbon::parse($request->jam_masuk)
            ->addHours(8)
            ->format('H:i');

        Attendance::create($data);

        return redirect()->route('attendance.index')
            ->with('success', 'Presensi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $attendance = Attendance::with('user')->findOrFail($id);
        $users = User::all();

        return view('attendance.edit', compact('attendance', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'keterangan_kehadiran' => 'required|in:hadir,sakit,izin,cuti,alpha,dinas luar'
        ]);

        $attendance = Attendance::findOrFail($id);

        $attendance->update([
            'user_id' => $request->user_id,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'keterangan_kehadiran' => $request->keterangan_kehadiran,
            'jam_pulang' => Carbon::parse($request->jam_masuk)
                ->addHours(8)
                ->format('H:i'),
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Data berhasil dihapus');
    }
}