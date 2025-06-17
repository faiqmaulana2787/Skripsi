<?php

namespace App\Imports;

use App\Models\PTN;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PTNImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index == 0) continue; // skip header

            PTN::updateOrCreate(
                ['kode_ptn' => $row[0]],
                ['nama_ptn' => $row[1]]
            );
        }
    }
}

