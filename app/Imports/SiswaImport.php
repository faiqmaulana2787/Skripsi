<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;

class SiswaImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index == 0) continue; // skip header

            $user = User::create([
                'no_peserta' => $row[0],
                'nama' => $row[1],
                'password' => Hash::make('ecc12345678'),
                'role' => 'siswa',
            ]);

            Siswa::create([
                'user_id' => $user->id,
                'asal_sekolah' => $row[2],
                'kelas' => $row[3],
            ]);
        }
    }
}
