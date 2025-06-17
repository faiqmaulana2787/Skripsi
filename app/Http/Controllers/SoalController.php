<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Kategori;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SoalImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SoalController extends Controller
{
    private function getKategori($ujian_id, $kategori_id)
    {
        return Kategori::where('id', $kategori_id)->where('ujian_id', $ujian_id)->firstOrFail();
    }

    public function index($ujian_id, $kategori_id)
    {
        try {
            $kategori = $this->getKategori($ujian_id, $kategori_id);
            $soals = Soal::where('kategori_id', $kategori_id)->get();
            return view('Admin.soal.index', compact('soals', 'kategori', 'ujian_id'));
        } catch (\Exception $e) {
            Log::error('Index Error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Gagal menampilkan soal.');
        }
    }

    public function import(Request $request, $ujian_id, $kategori_id)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls',
        ]);

        try {
            Excel::import(new SoalImport($ujian_id, $kategori_id), $request->file('file'));
            return redirect()->back()->with('success', 'Soal berhasil diimpor.');
        } catch (\Exception $e) {
            Log::error('Import Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal mengimpor soal.');
        }
    }

    public function create($ujian_id, $kategori_id)
    {
        try {
            $kategori = $this->getKategori($ujian_id, $kategori_id);
            return view('Admin.soal.create', compact('kategori', 'ujian_id'));
        } catch (\Exception $e) {
            Log::error('Create View Error: '.$e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuka form pembuatan soal.');
        }
    }

    public function store(Request $request, $ujian_id, $kategori_id)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'nilai_soal' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'opsi_e' => 'required',
            'jawaban_benar' => 'required|in:A,B,C,D,E',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $gambarPath = $request->hasFile('gambar') 
                ? $request->file('gambar')->store('soal_images', 'public') 
                : null;

            Soal::create([
                'ujian_id' => $ujian_id,
                'kategori_id' => $kategori_id,
                'pertanyaan' => $request->pertanyaan,
                'nilai_soal' => $request->nilai_soal,
                'opsi_a' => $request->opsi_a,
                'opsi_b' => $request->opsi_b,
                'opsi_c' => $request->opsi_c,
                'opsi_d' => $request->opsi_d,
                'opsi_e' => $request->opsi_e,
                'jawaban_benar' => $request->jawaban_benar,
                'gambar' => $gambarPath
            ]);

            return redirect()->route('soal.index', compact('ujian_id', 'kategori_id'))
                ->with('success', 'Soal berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan soal.');
        }
    }

    public function edit($ujian_id, $kategori_id, $soal_id)
    {
        try {
            $kategori = $this->getKategori($ujian_id, $kategori_id);
            $soal = Soal::where('kategori_id', $kategori_id)->findOrFail($soal_id);
            return view('Admin.soal.edit', compact('soal', 'kategori', 'ujian_id'));
        } catch (\Exception $e) {
            Log::error('Edit View Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuka form edit soal.');
        }
    }

    public function update(Request $request, $ujian_id, $kategori_id, $soal_id)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'opsi_e' => 'required',
            'nilai_soal' => 'required',
            'jawaban_benar' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $soal = Soal::where('kategori_id', $kategori_id)->findOrFail($soal_id);

            if ($request->hasFile('gambar')) {
                if ($soal->gambar) {
                    Storage::disk('public')->delete($soal->gambar);
                }
                $soal->gambar = $request->file('gambar')->store('soal_images', 'public');
            }

            $soal->update($request->only(['pertanyaan', 'opsi_a', 'opsi_b', 'opsi_c', 'opsi_d', 'opsi_e', 'nilai_soal', 'jawaban_benar']));

            return redirect()->route('soal.index', compact('ujian_id', 'kategori_id'))
                ->with('success', 'Soal berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Update Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui soal.');
        }
    }

    public function destroy($ujian_id, $kategori_id, $soal_id)
    {
        try {
            $soal = Soal::where('kategori_id', $kategori_id)->findOrFail($soal_id);

            if ($soal->gambar) {
                Storage::disk('public')->delete($soal->gambar);
            }

            $soal->delete();

            return redirect()->route('soal.index', compact('ujian_id', 'kategori_id'))
                ->with('success', 'Soal berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus soal.');
        }
    }
}
