<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function store(Request $request)
    {
        Approval::create([
            'pegawai_id' => $request->pegawai_id,
            'jenis' => $request->jenis,
            'jumlah_hari' => $request->jumlah_hari,
            'alasan' => $request->alasan,
            'status' => 'pending'
        ]);

        return back();
    }

    public function approve($id)
    {
        Approval::find($id)->update(['status'=>'approved']);
        return back();
    }

    public function reject($id)
    {
        Approval::find($id)->update(['status'=>'rejected']);
        return back();
    }
}