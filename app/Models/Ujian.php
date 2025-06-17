<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $fillable = ['nama_ujian', 'waktu_mulai', 'waktu_selesai'];
    public function kategoris()
        {
            return $this->hasMany(Kategori::class, 'ujian_id');
        }   
    public function soals()
        {
            return $this->hasMany(Soal::class, 'kategori_id');
        }
    public function users()
        {
            return $this->belongsToMany(User::class, 'ujian_user','ujian_id','user_id');
        }        
}
