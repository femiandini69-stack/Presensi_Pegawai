<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    
    protected $table = 'approvals';
    protected $fillable = [
        'pegawai_id',
        'jenis',
        'jumlah_hari',
        'alasan',
        'status',
    ];

    
    public function pegawai()
    {
        return $this->belongsTo(User::class, 'pegawai_id');
    }
}
