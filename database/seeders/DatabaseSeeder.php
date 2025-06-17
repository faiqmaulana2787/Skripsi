<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user admin manual
        User::create([
            'nama' => 'Admin',
            'no_peserta' => 'admin_ecc',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // Tambahan: User siswa manual
        User::create([
            'nama' => 'Test User',
            'no_peserta' => '12345678',
            'password' => Hash::make('12345678'),
            'role' => 'siswa',
        ]);
    }
}
