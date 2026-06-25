<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';


    protected $fillable = [
        'pegawai_id',
        'nama',
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


    public function pegawai()
    {
        return $this->belongsTo(
            Pegawai::class,
            'pegawai_id'
        );
    }
}