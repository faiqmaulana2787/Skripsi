<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ujian_id',
        'kategori_id',
        'soal_id',
        'jawaban'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
