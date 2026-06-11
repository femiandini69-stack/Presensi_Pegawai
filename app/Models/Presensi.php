<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $fillable = [
        'pegawai_id',
        'status',
        'bukti'
    ];

    // RELASI ke pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}