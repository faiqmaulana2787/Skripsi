<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ujian;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    public function index(Request $request)
    {
        $query = Ujian::query();

        if ($request->filled('search')) {
            $query->where('nama_ujian', 'like', '%' . $request->search . '%');
        }
    
        $ujians = $query->orderBy('created_at', 'asc')->get(); 
        return view('Admin.ujian.index', compact('ujians'));
    }

    public function lainnya()
    {
        $user = auth()->user();
        $ujians = $user->ujians()->get();
        $jawaban_user = Jawaban::where('user_id', Auth::id())->pluck('ujian_id')->toArray();

        return view('siswa.ujian.lainnya', compact('ujians', 'jawaban_user'));
    }

    public function create()
    {
        $siswa = User::all();
        return view('Admin.ujian.create',compact('siswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ujian' => 'required',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai'
        ]);

        try {
            $ujian = Ujian::create($request->all());
            $ujian->users()->sync($request->user_ids);
            return redirect()->route('ujian.index')->with('success', 'Ujian berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat ujian: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $ujian = Ujian::with('kategoris.soals')->findOrFail($id);

        if (!$ujian->users->contains(auth()->id())) {
            abort(403, 'Anda tidak diizinkan mengerjakan ujian ini.');
        }
        return view('Admin.ujian.kerjakan', compact('ujian'));
    }

    public function edit($id)
    {
        $ujian = Ujian::findOrFail($id);
        $siswa = User::all();
        return view('Admin.ujian.edit', compact('ujian','siswa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ujian' => 'required',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai'
        ]);

        try {
            $ujian = Ujian::findOrFail($id);
            $ujian->update([
                'nama_ujian' => $request->nama_ujian,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
            ]);
            $ujian->users()->sync($request->user_ids ?? []);
            return redirect()->route('ujian.index')->with('success', 'Ujian berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui ujian: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $ujian = Ujian::findOrFail($id);
            $ujian->delete();
            return redirect()->route('ujian.index')->with('success', 'Ujian berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus ujian: ' . $e->getMessage());
        }
    }
}
