<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use App\Models\Jawaban;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilUjianController extends Controller
{
    /**
     * Tampilkan semua hasil ujian untuk ujian tertentu.
     * Hanya admin yang bisa melihat semua, siswa hanya melihat miliknya.
     */
    public function index($ujianId)
    {
        if (Auth::user()->role === 'admin') {
            $hasil = HasilUjian::with(['user', 'ujian', 'kategori'])
                ->where('ujian_id', $ujianId)
                ->get();
        } else {
            $hasil = HasilUjian::with(['ujian', 'kategori'])
                ->where('ujian_id', $ujianId)
                ->where('user_id', Auth::id())
                ->get();
        }

        return view('admin.hasil.index', compact('hasil', 'ujianId'));
    }

    /**
     * Proses submit jawaban: 
     * - Hitung benar/salah,
     * - Hitung nilai per soal,
     * - Simpan ringkasan ke tabel hasil_ujians.
     */
    public function submit(Request $request, $ujianId)
    {
        $request->validate([
            'jawaban.*' => 'required|string',
        ]);

        // Ambil daftar soal untuk ujian ini
        $soalIds = array_keys($request->jawaban);
        $soals = Soal::whereIn('id', $soalIds)->get()->keyBy('id');
        $jumlahSoal = count($soals);
        $nilaiPerSoal = $jumlahSoal > 0 ? 100 / $jumlahSoal : 0;

        foreach ($request->jawaban as $soalId => $jawabanUser) {
            if (!isset($soals[$soalId])) {
                return redirect()->back()
                    ->with('error', "Soal dengan ID $soalId tidak ditemukan.");
            }

            $soal = $soals[$soalId];
            $isCorrect = trim(strtolower($jawabanUser)) === trim(strtolower($soal->jawaban_benar));

            // Simpan/update jawaban di tabel jawaban (opsional, jika masih dibutuhkan)
            $jawaban = Jawaban::updateOrCreate(
                [
                    'user_id'     => Auth::id(),
                    'ujian_id'    => $ujianId,
                    'kategori_id' => $soal->kategori_id,
                    'soal_id'     => $soalId,
                ],
                [
                    'jawaban' => $jawabanUser,
                ]
            );

            // Simpan hasil ringkasan di tabel hasil_ujians
            HasilUjian::updateOrCreate(
                [
                    'user_id'     => Auth::id(),
                    'ujian_id'    => $ujianId,
                    'kategori_id' => $soal->kategori_id,
                    'soal_id'     => $soalId,
                    'jawaban_id'  => $jawaban->id,
                ],
                [
                    'total_benar' => $isCorrect ? 1 : 0,
                    'total_salah' => $isCorrect ? 0 : 1,
                    'nilai'       => $isCorrect ? $nilaiPerSoal : 0,
                ]
            );
        }

        return redirect()
            ->route('ujian.lainnya')
            ->with('success', 'Hasil ujian berhasil disimpan.');
    }

    /**
     * Tampilkan detail hasil per siswa.
     */
    public function showDetail($ujianId)
    {
        if (Auth::user()->role === 'admin') {
            $hasil = HasilUjian::with(['user', 'kategori', 'soal'])
                ->where('ujian_id', $ujianId)
                ->get();
        } else {
            $hasil = HasilUjian::with(['kategori', 'soal'])
                ->where('ujian_id', $ujianId)
                ->where('user_id', Auth::id())
                ->get();
        }

        return view('admin.hasil.detail', compact('hasil', 'ujianId'));
    }

    /**
     * List siswa yang mengikuti ujian (berdasarkan hasil yang tersimpan).
     */
    public function listSiswa($ujianId)
    {
        $siswaList = HasilUjian::with('user')
            ->where('ujian_id', $ujianId)
            ->select('user_id')
            ->distinct()
            ->get();

        return view('admin.hasil.list_siswa', compact('siswaList', 'ujianId'));
    }

    /**
     * Detail hasil ujian per siswa.
     */
    public function detailSiswa($ujianId, $userId)
    {
        $hasil = HasilUjian::with(['soal', 'kategori', 'user'])
            ->where('ujian_id', $ujianId)
            ->where('user_id', $userId)
            ->get();

        return view('admin.hasil.detail_siswa', compact('hasil', 'ujianId', 'userId'));
    }
}
