<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'siswa_id',
        'kode_ptn_1', 'kode_jurusan_1',
        'kode_ptn_2', 'kode_jurusan_2',
        'kode_ptn_3', 'kode_jurusan_3',
        'kode_ptn_4', 'kode_jurusan_4',
        'nilai_semester_1',
        'nilai_semester_2',
        'nilai_semester_3',
        'nilai_semester_4',
        'nilai_semester_5',
        'nilai_jurusan',
        'hasil_konsultasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class,'no_peserta');
    }
    public function ptn_1()
    {
        return $this->belongsTo(PTN::class, 'kode_ptn_1', 'kode_ptn');
    }

    public function jurusan_1()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan_1', 'kode_jurusan', 'nilai_jurusan');
    }

    public function ptn_2()
    {
        return $this->belongsTo(PTN::class, 'kode_ptn_2', 'kode_ptn');
    }

    public function jurusan_2()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan_2', 'kode_jurusan', 'nilai_jurusan');
    }

    public function ptn_3()
    {
        return $this->belongsTo(PTN::class, 'kode_ptn_3', 'kode_ptn');
    }

    public function jurusan3()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan_3', 'kode_jurusan', 'nilai_jurusan');
    }

    public function ptn_4()
    {
        return $this->belongsTo(PTN::class, 'kode_ptn_4', 'kode_ptn');
    }

    public function jurusan4()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan_4', 'kode_jurusan', 'nilai_jurusan');
    }
}

