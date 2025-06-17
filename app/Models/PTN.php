<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PTN extends Model
{
    use HasFactory;

    protected $table = 'p_t_n_s'; // Nama tabel di database
    protected $primaryKey = 'kode_ptn'; // Primary key
    public $incrementing = false; // Karena bukan auto-increment
    protected $keyType = 'int'; // Jika kode_ptn adalah string

    protected $fillable = ['kode_ptn', 'nama_ptn']; // Kolom yang bisa diisi

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kode_ptn', 'kode_ptn');
    }
    public function jurusans()
    {
        return $this->hasMany(Jurusan::class, 'kode_ptn', 'kode_ptn');
    }
}
