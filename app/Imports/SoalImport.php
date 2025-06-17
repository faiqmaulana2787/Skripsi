<?php

namespace App\Imports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel, WithHeadingRow
{
    protected $ujian_id;
    protected $kategori_id;

    public function __construct($ujian_id, $kategori_id)
    {
        $this->ujian_id = $ujian_id;
        $this->kategori_id = $kategori_id;
    }

    public function model(array $row)
    {
        return new Soal([
            'ujian_id'      => $this->ujian_id,
            'kategori_id'   => $this->kategori_id,
            'pertanyaan'    => $row['pertanyaan'],
            'nilai_soal' => $row['nilai_soal'],
            'opsi_a'        => $row['opsi_a'],
            'opsi_b'        => $row['opsi_b'],
            'opsi_c'        => $row['opsi_c'],
            'opsi_d'        => $row['opsi_d'],
            'opsi_e'        => $row['opsi_e'],
            'jawaban_benar' => $row['jawaban_benar'],
            'gambar'        => $row['gambar'] ?? null,
        ]);
    }
}
