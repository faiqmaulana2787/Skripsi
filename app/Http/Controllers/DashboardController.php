<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Konsultasi;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Konsultasi per bulan
        $konsultasiBulanan = Konsultasi::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // Persentase asal sekolah
        $asalSekolah = Siswa::selectRaw('asal_sekolah, COUNT(*) as total')
            ->groupBy('asal_sekolah')
            ->pluck('total', 'asal_sekolah');

        return view('admin.dashboard', compact('konsultasiBulanan', 'asalSekolah'));
    }
}
