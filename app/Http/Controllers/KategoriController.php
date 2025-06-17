<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Exception;

class KategoriController extends Controller
{
    public function index($ujian_id)
    {
        $ujian = Ujian::findOrFail($ujian_id);
        $kategoris = Kategori::where('ujian_id', $ujian_id)->get();

        return view('Admin.kategori.index', compact('ujian', 'kategoris', 'ujian_id'));
    }

    public function create($ujian_id)
    {
        $ujian = Ujian::findOrFail($ujian_id);
        return view('Admin.kategori.create', compact('ujian'));
    }

    public function store(Request $request, $ujian_id)
    {
        $ujian = Ujian::findOrFail($ujian_id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'durasi' => 'required|integer|min:1',
        ]);

        try {
            Kategori::create([
                'ujian_id' => $ujian->id,
                'nama_kategori' => $request->nama_kategori,
                'durasi' => $request->durasi,
            ]);

            return redirect()->route('kategori.index', $ujian_id)
                ->with('success', 'Kategori berhasil dibuat.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan kategori: ' . $e->getMessage());
        }
    }

    public function edit($ujian_id, $kategori_id)
    {
        $ujian = Ujian::findOrFail($ujian_id);
        $kategori = Kategori::where('ujian_id', $ujian_id)->findOrFail($kategori_id);

        return view('Admin.kategori.edit', compact('ujian', 'kategori'));
    }

    public function update(Request $request, $ujian_id, $kategori_id)
    {
        $ujian = Ujian::findOrFail($ujian_id);
        $kategori = Kategori::where('ujian_id', $ujian_id)->findOrFail($kategori_id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'durasi' => 'required|integer|min:1',
        ]);

        try {
            $kategori->update($request->only(['nama_kategori', 'durasi']));

            return redirect()->route('kategori.index', $ujian_id)
                ->with('success', 'Kategori berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui kategori: ' . $e->getMessage());
        }
    }

    public function destroy($ujian_id, $kategori_id)
    {
        try {
            $ujian = Ujian::findOrFail($ujian_id);
            $kategori = Kategori::where('ujian_id', $ujian_id)->findOrFail($kategori_id);
            $kategori->delete();

            return redirect()->route('kategori.index', $ujian_id)
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
