<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // 1. Ambil data
        $today = now()->toDateString();
        $totalPegawai = User::count();
        $hadir = Attendance::whereDate('tanggal', $today)->where('keterangan_kehadiran', 'hadir')->count();
        $izin = Attendance::whereDate('tanggal', $today)->where('keterangan_kehadiran', 'izin')->count();
        $sakit = Attendance::whereDate('tanggal', $today)->where('keterangan_kehadiran', 'sakit')->count();
        $belumAbsen = max(0, $totalPegawai - ($hadir + $izin + $sakit));
        $users = User::with('divisi')->get();

        // 2. Kirim ke view 'dashboard'
        return view('dashboard', compact(
            'users', 'totalPegawai', 'hadir', 'izin', 'sakit', 'belumAbsen'
        ));
    }
}