<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JawabanController extends Controller
{
    public function index($ujianId)
    {
        $jawabans = Jawaban::with(['user', 'soal.kategori'])
        ->where('ujian_id', $ujianId)
        ->get();

        $soals = \App\Models\Soal::with('kategori')
            ->where('ujian_id', $ujianId)
            ->get();

        $siswaList = $jawabans->groupBy('user_id')->map(function ($items) {
            return $items->first();
        });

        return view('admin.jawaban.index', compact('jawabans', 'soals', 'siswaList'));
    }

    public function submit(Request $request, $ujianId)
    {
        $request->validate([
            'jawaban.*' => 'required|string',
        ]);

        foreach ($request->jawaban as $soalId => $jawaban) {
            $soal = Soal::find($soalId);

            if (!$soal) {
                return redirect()->back()->with('error', "Soal dengan ID $soalId tidak ditemukan.");
            }

            Jawaban::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'ujian_id' => $ujianId,
                    'kategori_id' => $soal->kategori_id,
                    'soal_id' => $soalId,
                ],
                [
                    'jawaban' => $jawaban,
                ]
            );
        }

        return redirect()->route('ujian.lainnya')->with('success', 'Jawaban berhasil disimpan.');
    }
}