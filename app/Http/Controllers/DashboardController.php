<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('pegawai');


        // FILTER TANGGAL
        if ($request->start_date && $request->end_date) {

            $query->whereBetween('tanggal', [
                $request->start_date,
                $request->end_date
            ]);

        }


        $attendances = $query->get();



        return view('admin.dashboard', [

            // TOTAL PEGAWAI
            'totalUser' => Pegawai::count(),


            // REKAP KEHADIRAN
            'hadir' => $attendances
                ->where('keterangan_kehadiran', 'Hadir')
                ->count(),


            'izin' => $attendances
                ->where('keterangan_kehadiran', 'Izin')
                ->count(),


            'sakit' => $attendances
                ->where('keterangan_kehadiran', 'Sakit')
                ->count(),


            'cuti' => $attendances
                ->where('keterangan_kehadiran', 'Cuti')
                ->count(),


            'alpha' => $attendances
                ->where('keterangan_kehadiran', 'Alpha')
                ->count(),


            'dinas_luar' => $attendances
                ->where('keterangan_kehadiran', 'Dinas Luar')
                ->count(),



            // PEGAWAI YANG BELUM ABSEN
            'belumAbsen' => Pegawai::count() - $attendances->count(),



            // DATA TABEL
            'attendances' => $attendances

        ]);
    }




    // DATA REAL TIME
    public function data()
    {
        $att = Attendance::whereDate(
            'tanggal',
            now()->toDateString()
        )->get();



        return response()->json([


            'hadir' => $att
                ->where('keterangan_kehadiran', 'Hadir')
                ->count(),


            'izin' => $att
                ->where('keterangan_kehadiran', 'Izin')
                ->count(),


            'sakit' => $att
                ->where('keterangan_kehadiran', 'Sakit')
                ->count(),


            'cuti' => $att
                ->where('keterangan_kehadiran', 'Cuti')
                ->count(),


            'alpha' => $att
                ->where('keterangan_kehadiran', 'Alpha')
                ->count(),


            'dinas_luar' => $att
                ->where('keterangan_kehadiran', 'Dinas Luar')
                ->count(),

        ]);
    }
}