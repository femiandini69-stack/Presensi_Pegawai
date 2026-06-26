<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Pegawai;
use Carbon\Carbon;


class PresensiController extends Controller
{

public function index(Request $request)
{

    $query = Presensi::query();


    // PEGAWAI HANYA LIHAT DATA SENDIRI
    if (auth()->user()->role == 'pegawai') {

        $query->where(
            'nip',
            auth()->user()->nip
        );

    }



    // SEARCH
    if($request->search){

        $query->where(function($q) use($request){

            $q->where('nama','like','%'.$request->search.'%')
              ->orWhere('nip','like','%'.$request->search.'%');

        });

    }



    // FILTER STATUS
    if($request->status){

        $query->where(
            'status',
            $request->status
        );

    }



    $presensi = $query
        ->latest()
        ->get();



    return view(
        'presensi.index',
        compact('presensi')
    );

}

public function create()
{

    $pegawai = Pegawai::all();


    return view(
        'presensi.create',
        compact('pegawai')
    );

}





public function store(Request $request)
{

    $now = Carbon::now('Asia/Jakarta');


    $data = $request->validate([

        'pegawai_id'=>'required',

        'tanggal'=>'required',

        'status'=>'required',

        'bukti'=>'nullable|image|mimes:jpg,jpeg,png|max:5120'

    ]);



    $pegawai = Pegawai::findOrFail(
        $request->pegawai_id
    );



    $data['nama'] =
    $pegawai->nama;


    $data['nip'] =
    $pegawai->nip;


    $data['jabatan'] =
    $pegawai->jabatan;


    $data['divisi'] =
    $pegawai->divisi;



    $data['jam_masuk'] =
    $now->format('H:i:s');



    $data['jam_pulang'] =
    $now->copy()
    ->addHours(8)
    ->format('H:i:s');




    if($request->hasFile('bukti')){


        $data['bukti'] =
        $request->file('bukti')
        ->store('presensi','public');

    }




    Presensi::create($data);



    return redirect()
    ->route('presensi.index')
    ->with(
        'success',
        'Presensi berhasil disimpan'
    );

}




public function edit($id)
{

    $presensi =
    Presensi::findOrFail($id);


    $pegawai =
    Pegawai::all();



    return view(
        'presensi.edit',
        compact(
            'presensi',
            'pegawai'
        )
    );

}





public function update(Request $request,$id)
{


    $presensi =
    Presensi::findOrFail($id);



    $data = $request->validate([

        'pegawai_id'=>'required',

        'tanggal'=>'required',

        'status'=>'required',

        'keterangan'=>'nullable',

        'bukti'=>'nullable|image|mimes:jpg,jpeg,png|max:5120'

    ]);



    $pegawai =
    Pegawai::findOrFail(
        $request->pegawai_id
    );



    $data['nama']=$pegawai->nama;

    $data['nip']=$pegawai->nip;

    $data['jabatan']=$pegawai->jabatan;

    $data['divisi']=$pegawai->divisi;



    if($request->hasFile('bukti')){

        $data['bukti'] =
        $request->file('bukti')
        ->store('presensi','public');

    }



    $presensi->update($data);



    return redirect()
    ->route('presensi.index')
    ->with(
        'success',
        'Data berhasil diupdate'
    );

}





public function destroy($id)
{

    $presensi =
    Presensi::findOrFail($id);


    $presensi->delete();



    return back()
    ->with(
        'success',
        'Data berhasil dihapus'
    );

}



}