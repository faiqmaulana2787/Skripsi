<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;
    protected $fillable = [
        'ujian_id','kategori_id', 'pertanyaan', 'nilai_soal', 'opsi_a', 'opsi_b',
        'opsi_c', 'opsi_d', 'opsi_e', 'jawaban_benar', 'gambar'
    ];

    public function Ujian()
    {
        return $this->belongsTo(Ujian::class, 'ujian_id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

}
