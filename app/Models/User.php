<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Divisi; 
use App\Models\Attendance;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
       
        'name', 
        'nip', 
        'jenis_kelamin', 
        'jabatan', 
        'divisi', 
        'email', 
        'password', 
        'role'
    ];
   

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function attendances()
    {
        // Pastikan class ini sama dengan nama file di folder Models Anda
        return $this->hasMany(Attendance::class); 
    }
}