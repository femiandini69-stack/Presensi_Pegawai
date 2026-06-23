<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('user');

        // FILTER TANGGAL
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
        }

        $attendances = $query->get();

        return view('admin.dashboard', [
            'totalUser' => User::count(),

            'hadir' => $attendances->where('keterangan_kehadiran','hadir')->count(),
            'izin'  => $attendances->where('keterangan_kehadiran','izin')->count(),
            'sakit' => $attendances->where('keterangan_kehadiran','sakit')->count(),
            'cuti'  => $attendances->where('keterangan_kehadiran','cuti')->count(),
            'alpha' => $attendances->where('keterangan_kehadiran','alpha')->count(),

            'attendances' => $attendances
        ]);
    }

    // REAL TIME DATA
    public function data()
    {
        $att = Attendance::whereDate('tanggal', now()->toDateString())->get();

        return response()->json([
            'hadir' => $att->where('keterangan_kehadiran', 'hadir')->count(),
            'izin'  => $att->where('keterangan_kehadiran', 'izin')->count(),
            'sakit' => $att->where('keterangan_kehadiran', 'sakit')->count(),
            'cuti'  => $att->where('keterangan_kehadiran', 'cuti')->count(),
            'alpha' => $att->where('keterangan_kehadiran', 'alpha')->count(),
        ]);
    }
}