<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = ['ujian_id', 'nama_kategori', 'durasi'];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
    public function soals() {
        return $this->hasMany(Soal::class, 'kategori_id');
    }
}
