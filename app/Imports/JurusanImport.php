<?php

namespace App\Imports;

use App\Models\Jurusan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class JurusanImport implements ToCollection
{
    protected $kodePtn;

    public function __construct($kodePtn)
    {
        $this->kodePtn = $kodePtn;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index == 0) continue; // skip header

            Jurusan::updateOrCreate(
                ['kode_jurusan' => $row[0]],
                [
                    'kode_ptn' => $this->kodePtn,
                    'jenjang' => $row[1],
                    'nama_jurusan' => $row[2],
                    'nilai_jurusan' => $row[3],
                ]
            );
        }
    }
}

