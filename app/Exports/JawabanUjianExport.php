<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JawabanUjianExport implements FromArray, WithHeadings
{
    protected $siswaList, $soals, $jawabans;

    public function __construct($siswaList, $soals, $jawabans)
    {
        $this->siswaList = $siswaList;
        $this->soals = $soals;
        $this->jawabans = $jawabans;
    }

    public function array(): array
    {
        $data = [];

        foreach ($this->siswaList as $siswa) {
            $row = [];
            $row[] = $siswa->user->nama;
            $jumlahBenar = 0;
            $nilaiTotal = 0;

            foreach ($this->soals as $soal) {
                $jawaban = $this->jawabans->where('user_id', $siswa->user_id)->firstWhere('soal_id', $soal->id);
                $jawabanTeks = $jawaban->jawaban ?? '-';

                if ($jawaban && $jawaban->jawaban === $soal->jawaban_benar) {
                    $jumlahBenar++;
                    $nilaiTotal += $soal->nilai_soal;
                }

                $row[] = $jawabanTeks;
            }

            $row[] = $jumlahBenar;
            $row[] = $nilaiTotal;

            $data[] = $row;
        }

        return $data;
    }

    public function headings(): array
    {
        $headings = ['Nama Siswa'];

        foreach ($this->soals as $index => $soal) {
            $headings[] = 'Soal ' . ($index + 1);
        }

        $headings[] = 'Total Benar';
        $headings[] = 'Nilai';

        return $headings;
    }
}
