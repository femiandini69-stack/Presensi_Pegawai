<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;


class DashboardController extends Controller
{


public function index(Request $request)
{

    $query = Presensi::query();



    if($request->start_date && $request->end_date){


        $query->whereBetween('tanggal',[

            $request->start_date,

            $request->end_date

        ]);


    }



    $presensi = $query->get();



    return view('admin.dashboard',[


        'totalUser'=>Pegawai::count(),



        'hadir'=>$presensi
            ->where('status','Hadir')
            ->count(),



        'izin'=>$presensi
            ->where('status','Izin')
            ->count(),



        'sakit'=>$presensi
            ->where('status','Sakit')
            ->count(),



        'cuti'=>$presensi
            ->where('status','Cuti')
            ->count(),



        'alpha'=>$presensi
            ->where('status','Alpha')
            ->count(),



        'dinas_luar'=>$presensi
            ->where('status','Dinas Luar')
            ->count(),



        'belumAbsen'=>Pegawai::count()
            -
            $presensi->count(),



        'attendances'=>$presensi


    ]);

}




public function data()
{


$presensi = Presensi::whereDate(

'tanggal',

now()->toDateString()

)->get();



return response()->json([


'hadir'=>$presensi
->where('status','Hadir')
->count(),


'izin'=>$presensi
->where('status','Izin')
->count(),


'sakit'=>$presensi
->where('status','Sakit')
->count(),


'cuti'=>$presensi
->where('status','Cuti')
->count(),


'alpha'=>$presensi
->where('status','Alpha')
->count(),


'dinas_luar'=>$presensi
->where('status','Dinas Luar')
->count(),


]);


}



}