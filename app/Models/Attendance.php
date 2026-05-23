<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pegawai',
        'nip',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'keterangan_kehadiran',
    ];
}