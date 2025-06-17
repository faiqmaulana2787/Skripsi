<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\PTN;
use App\Imports\JurusanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Exception;

class JurusanController extends Controller
{
    public function index($kode_ptn)
    {
        $ptn = PTN::findOrFail($kode_ptn);
        $jurusans = Jurusan::where('kode_ptn', $kode_ptn)->paginate(10);
        return view('admin.jurusan.index', compact('ptn', 'jurusans'));
    }

    public function import(Request $request, $kode_ptn)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            Excel::import(new JurusanImport($kode_ptn), $request->file('file'));
            return redirect()->route('jurusan.index', $kode_ptn)->with('success', 'Data jurusan berhasil diimport.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    public function create($kode_ptn)
    {
        $ptn = PTN::findOrFail($kode_ptn);
        return view('admin.jurusan.create', compact('ptn'));
    }

    public function store(Request $request, $kode_ptn)
    {
        $request->validate([
            'kode_jurusan' => 'required|integer|unique:jurusans,kode_jurusan',
            'jenjang' => 'required|string',
            'nama_jurusan' => 'required|string',
            'nilai_jurusan' => 'required|int',
        ]);

        try {
            Jurusan::create([
                'kode_jurusan' => $request->kode_jurusan,
                'kode_ptn' => $kode_ptn,
                'jenjang' => $request->jenjang,
                'nama_jurusan' => $request->nama_jurusan,
                'nilai_jurusan' => $request->nilai_jurusan,
            ]);

            return redirect()->route('jurusan.index', $kode_ptn)->with('success', 'Jurusan berhasil ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan jurusan: ' . $e->getMessage());
        }
    }

    public function edit($kode_ptn, $kode_jurusan)
    {
        $ptn = PTN::findOrFail($kode_ptn);
        $jurusan = Jurusan::where('kode_ptn', $kode_ptn)->findOrFail($kode_jurusan);
        return view('admin.jurusan.edit', compact('ptn', 'jurusan'));
    }

    public function update(Request $request, $kode_ptn, $kode_jurusan)
    {
        $jurusan = Jurusan::where('kode_ptn', $kode_ptn)->findOrFail($kode_jurusan);

        $request->validate([
            'jenjang' => 'required|string',
            'nama_jurusan' => 'required|string|max:255',
            'nilai_jurusan' => 'required|integer',
        ]);

        try {
            $jurusan->update($request->only(['jenjang', 'nama_jurusan', 'nilai_jurusan']));
            return redirect()->route('jurusan.index', $kode_ptn)->with('success', 'Jurusan berhasil diperbarui');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui jurusan: ' . $e->getMessage());
        }
    }

    public function destroy($kode_ptn, $kode_jurusan)
    {
        try {
            $jurusan = Jurusan::where('kode_ptn', $kode_ptn)->findOrFail($kode_jurusan);
            $jurusan->delete();
            return redirect()->route('jurusan.index', $kode_ptn)->with('success', 'Jurusan berhasil dihapus');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus jurusan: ' . $e->getMessage());
        }
    }
}
