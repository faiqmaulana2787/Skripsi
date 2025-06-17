<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['nama', 'no_peserta', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }
    public function ujians()
    {
        return $this->belongsToMany(Ujian::class);
    }
}
