<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'nip',
        'nama',
        'jabatan'
    ];

    // RELASI: 1 pegawai punya banyak presensi
    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }
}