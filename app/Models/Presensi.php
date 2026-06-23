<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    
protected $fillable = [
    'pegawai_id',
    'tanggal',
    'jam_masuk',
    'jam_pulang',
    'status',
    'bukti',
    'keterangan'
];

    // RELASI ke pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}