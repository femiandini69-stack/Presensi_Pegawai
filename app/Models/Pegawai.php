<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'jenis_kelamin',
        'jabatan',
        'divisi'
    ];
}