<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'asal_sekolah',
        'kelas',
        'kode_ptn_1', 'kode_jurusan_1',
        'kode_ptn_2', 'kode_jurusan_2',
        'kode_ptn_3', 'kode_jurusan_3',
        'kode_ptn_4', 'kode_jurusan_4',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ptn_1()
    {
        return $this->belongsTo(PTN::class, 'kode_ptn_1', 'kode_ptn');
    }

    public function jurusan1()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan_1', 'kode_jurusan');
    }

    public function ptn_2()
    {
        return $this->belongsTo(PTN::class, 'kode_ptn_2', 'kode_ptn');
    }

    public function jurusan2()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan_2', 'kode_jurusan');
    }

    public function ptn_3()
    {
        return $this->belongsTo(PTN::class, 'kode_ptn_3', 'kode_ptn');
    }

    public function jurusan3()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan_3', 'kode_jurusan');
    }

    public function ptn_4()
    {
        return $this->belongsTo(PTN::class, 'kode_ptn_4', 'kode_ptn');
    }

    public function jurusan4()
    {
        return $this->belongsTo(Jurusan::class, 'kode_jurusan_4', 'kode_jurusan');
    }
}
