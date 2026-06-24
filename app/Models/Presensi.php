<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';

    protected $fillable = [
        'nama_pegawai',
        'nip',
        'jabatan',
        'divisi',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
        'bukti',
        'keterangan'
    ];
}