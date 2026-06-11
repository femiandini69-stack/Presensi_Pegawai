<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Divisi;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'divisi_id',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }
}