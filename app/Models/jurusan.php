<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusans'; // Nama tabel di database
    protected $primaryKey = 'kode_jurusan'; // Primary key
    public $incrementing = false; // Karena bukan auto-increment
    protected $keyType = 'int'; // Jika kode_jurusan adalah string

    protected $fillable = ['kode_ptn','kode_jurusan', 'jenjang', 'nama_jurusan', 'nilai_jurusan']; // Kolom yang bisa diisi

    
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kode_jurusan', 'kode_jurusan');
    }
    public function ptn()
    {
        return $this->belongsTo(PTN::class, 'kode_ptn', 'kode_ptn');
    }
}
