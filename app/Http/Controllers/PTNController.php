<?php

namespace App\Http\Controllers;

use App\Models\PTN;
use App\Imports\PTNImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class PTNController extends Controller
{
    public function index(Request$request)
    {
        $query = PTN::query();

        if ($request->filled('search')) {
            $query->where('nama_ptn', 'like', '%' . $request->search . '%');
        }
    
        $p_t_n_s = $query->orderBy('created_at', 'asc')->paginate(10);
        return view('admin.ptn.index', compact('p_t_n_s'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new PTNImport, $request->file('file'));

        return redirect()->route('PTN.index')->with('success', 'Data PTN berhasil diimport.');
    }

    public function create()
    {
        return view('admin.ptn.create');
    }

    public function store(Request $request)
    {
        PTN::create($request->all());
        return redirect()->route('PTN.index');
    }

    public function edit($id)
    {
        $ptn = PTN::findOrFail($id);
        return view('admin.ptn.edit', compact('ptn'));
    }

    public function update(Request $request, $id)
    {
        $ptn = PTN::findOrFail($id);
        $ptn->update($request->all());
        return redirect()->route('PTN.index');
    }

    public function destroy($id)
    {
        PTN::destroy($id);
        return redirect()->route('PTN.index');
    }
}
