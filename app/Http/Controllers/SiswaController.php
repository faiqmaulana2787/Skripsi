<?php

namespace App\Http\Controllers;

use App\Models\PTN;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Jurusan;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::with('user');

        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $siswas = $query->orderBy('created_at', 'asc')->paginate(10);
        return view('Admin.siswa.index', compact('siswas'));
    }

    public function ProfilSiswa()
    {
        $siswa = Siswa::with('user')
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('Siswa.profile.index', compact('siswa'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new SiswaImport, $request->file('file'));
            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diimport.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimport data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        $p_t_n_s = PTN::all();
        return view('Admin.siswa.create', compact('jurusans', 'p_t_n_s'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_peserta' => 'required|numeric|min:6|unique:users,no_peserta',
            'password' => 'required|min:8',
            'asal_sekolah' => 'nullable|string',
            'kelas' => 'required|in:VII,VIII,IX,X,XI,XII',

            'kode_ptn_1' => 'nullable|exists:p_t_n_s,kode_ptn',
            'kode_jurusan_1' => 'nullable|exists:jurusans,kode_jurusan',
            'kode_ptn_2' => 'nullable|exists:p_t_n_s,kode_ptn',
            'kode_jurusan_2' => 'nullable|exists:jurusans,kode_jurusan',
            'kode_ptn_3' => 'nullable|exists:p_t_n_s,kode_ptn',
            'kode_jurusan_3' => 'nullable|exists:jurusans,kode_jurusan',
            'kode_ptn_4' => 'nullable|exists:p_t_n_s,kode_ptn',
            'kode_jurusan_4' => 'nullable|exists:jurusans,kode_jurusan',
        ]);

        try {
            $user = User::create([
                'nama' => $request->nama,
                'no_peserta' => $request->no_peserta,
                'password' => Hash::make($request->password),
                'role' => 'siswa',
            ]);

            Siswa::create([
                'user_id' => $user->id,
                'asal_sekolah' => $request->asal_sekolah,
                'kelas' => $request->kelas,
                'kode_ptn_1' => $request->kode_ptn_1,
                'kode_jurusan_1' => $request->kode_jurusan_1,
                'kode_ptn_2' => $request->kode_ptn_2,
                'kode_jurusan_2' => $request->kode_jurusan_2,
                'kode_ptn_3' => $request->kode_ptn_3,
                'kode_jurusan_3' => $request->kode_jurusan_3,
                'kode_ptn_4' => $request->kode_ptn_4,
                'kode_jurusan_4' => $request->kode_jurusan_4,
            ]);

            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan siswa: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        return view('Admin.siswa.show', compact('siswa'));
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $jurusans = Jurusan::all();
        $p_t_n_s = PTN::all();
        return view('Admin.siswa.edit', compact('siswa', 'jurusans', 'p_t_n_s'));
    }

    public function editProfilSiswa()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        $jurusans = Jurusan::all();
        $p_t_n_s = PTN::all();
        return view('Siswa.profile.edit', compact('siswa', 'jurusans', 'p_t_n_s'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        $request->validate([
            'nama' => 'required',
            'no_peserta' => 'required',
            'asal_sekolah' => 'nullable|string',
            'kelas' => 'required|in:VII,VIII,IX,X,XI,XII',
            'kode_ptn_1' => 'nullable|exists:p_t_n_s,kode_ptn',
            'kode_jurusan_1' => 'nullable|exists:jurusans,kode_jurusan',
            'kode_ptn_2' => 'nullable|exists:p_t_n_s,kode_ptn',
            'kode_jurusan_2' => 'nullable|exists:jurusans,kode_jurusan',
            'kode_ptn_3' => 'nullable|exists:p_t_n_s,kode_ptn',
            'kode_jurusan_3' => 'nullable|exists:jurusans,kode_jurusan',
            'kode_ptn_4' => 'nullable|exists:p_t_n_s,kode_ptn',
            'kode_jurusan_4' => 'nullable|exists:jurusans,kode_jurusan',
        ]);

        try {
            $user->update([
                'nama' => $request->nama,
                'no_peserta' => $request->no_peserta,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);

            $siswa->update([
                'asal_sekolah' => $request->asal_sekolah,
                'kelas' => $request->kelas,
                'kode_ptn_1' => $request->kode_ptn_1,
                'kode_jurusan_1' => $request->kode_jurusan_1,
                'kode_ptn_2' => $request->kode_ptn_2,
                'kode_jurusan_2' => $request->kode_jurusan_2,
                'kode_ptn_3' => $request->kode_ptn_3,
                'kode_jurusan_3' => $request->kode_jurusan_3,
                'kode_ptn_4' => $request->kode_ptn_4,
                'kode_jurusan_4' => $request->kode_jurusan_4,
            ]);

            if (Auth::user()->role === 'admin') {
                return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
            } else {
                return redirect()->route('siswa.profile')->with('success', 'Profil berhasil diperbarui.');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data siswa: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $user = $siswa->user;
            $siswa->delete();
            $user->delete();

            return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus siswa: ' . $e->getMessage());
        }
    }
}

