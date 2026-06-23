<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use PDF;

class LaporanController extends Controller
{
    public function pdf()
    {
        $data = Attendance::with('user')->get();

        $pdf = PDF::loadView('laporan.pdf', compact('data'))
                ->setPaper('A4', 'landscape');

        return $pdf->download('laporan-presensi.pdf');
    }
}