<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Konsultasi::with('user');

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $konsultasis = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.konsultasi.index', compact('konsultasis'));
    }

    public function lainnya2()
    {
        $konsultasis = Konsultasi::where('user_id', Auth::id())->get();
        return view('admin.konsultasi.lainnya', compact('konsultasis'));
    }

    public function create()
    {
        if (Auth::user()->role != 'siswa') {
            abort(403);
        }

        return view('admin.konsultasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nilai_semester_1' => 'required|numeric|between:0,100',
            'nilai_semester_2' => 'required|numeric|between:0,100',
            'nilai_semester_3' => 'required|numeric|between:0,100',
            'nilai_semester_4' => 'required|numeric|between:0,100',
            'nilai_semester_5' => 'required|numeric|between:0,100',
        ]);

        try {
            $siswa = Siswa::where('user_id', Auth::id())->first();

            if (!$siswa) {
                return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
            }

            Konsultasi::create([
                'user_id' => Auth::id(),
                'siswa_id' => $siswa->id,
                'kode_ptn_1' => $siswa->kode_ptn_1,
                'kode_ptn_2' => $siswa->kode_ptn_2,
                'kode_jurusan_1' => $siswa->kode_jurusan_1,
                'kode_jurusan_2' => $siswa->kode_jurusan_2,
                'nilai_semester_1' => $request->nilai_semester_1,
                'nilai_semester_2' => $request->nilai_semester_2,
                'nilai_semester_3' => $request->nilai_semester_3,
                'nilai_semester_4' => $request->nilai_semester_4,
                'nilai_semester_5' => $request->nilai_semester_5,
            ]);

            return redirect()->route('konsultasi.lainnya')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function show(Konsultasi $konsultasi)
    {
        if (Auth::user()->role == 'siswa' && $konsultasi->user_id != Auth::id()) {
            abort(403);
        }

        return view('admin.konsultasi.show', compact('konsultasi'));
    }

    public function destroy(Konsultasi $konsultasi)
    {
        if (Auth::user()->role != 'admin') {
            abort(403);
        }

        try {
            $konsultasi->delete();
            return redirect()->route('konsultasi.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function downloadPDF($id)
    {
        $konsultasi = Konsultasi::with([
            'user',
            'siswa',
            'ptn_1',
            'ptn_2',
            'jurusan_1',
            'jurusan_2',
        ])->findOrFail($id);

        $pdf = Pdf::loadView('admin.konsultasi.pdf', compact('konsultasi'))->setPaper('a4', 'portrait');

        return $pdf->download('Hasil_Konsultasi_' . $konsultasi->user->nama . '.pdf');
    }
}
