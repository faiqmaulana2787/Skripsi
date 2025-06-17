<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PTNController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonsultasiController;
use App\Exports\JawabanUjianExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Halaman Landing Page (Umum) - tanpa auth
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('Landing_page.index');
})->name('index');

Route::view('/tentang', 'Landing_Page.tentang')->name('tentang');
Route::view('/kontak', 'Landing_Page.kontak')->name('kontak');

/*
|--------------------------------------------------------------------------
| Autentikasi - tanpa auth
|--------------------------------------------------------------------------
*/
Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Group Semua Route Yang Butuh Auth
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Siswa
    Route::resource('siswa', SiswaController::class);
    Route::get('/profile', [SiswaController::class, 'ProfilSiswa'])->name('siswa.profile');
    Route::get('/profile/edit', [SiswaController::class, 'editProfilSiswa'])->name('profile.edit');

    // Manajemen PTN
    Route::resource('PTN', PTNController::class);

    // Jurusan terkait PTN
    Route::prefix('ptn/{kode_ptn}/jurusan')->group(function () {
        Route::get('/', [JurusanController::class, 'index'])->name('jurusan.index');
        Route::get('/create', [JurusanController::class, 'create'])->name('jurusan.create');
        Route::post('/store', [JurusanController::class, 'store'])->name('jurusan.store');
        Route::get('/{kode_jurusan}/edit', [JurusanController::class, 'edit'])->name('jurusan.edit');
        Route::put('/{kode_jurusan}/update', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('/{kode_jurusan}/destroy', [JurusanController::class, 'destroy'])->name('jurusan.destroy');
    });

    // Manajemen Ujian
    Route::resource('ujian', UjianController::class);
    Route::get('/lainnya', [UjianController::class, 'lainnya'])->name('ujian.lainnya');

    // Kategori Ujian
    Route::prefix('ujian/{ujian_id}/kategori')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/{kategori_id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/{kategori_id}/update', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/{kategori_id}/destroy', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    // Soal Ujian
    Route::prefix('ujian/{ujian_id}/kategori/{kategori_id}/soal')->group(function () {
        Route::get('/', [SoalController::class, 'index'])->name('soal.index');
        Route::get('/create', [SoalController::class, 'create'])->name('soal.create');
        Route::post('/store', [SoalController::class, 'store'])->name('soal.store');
        Route::get('/{soal_id}/edit', [SoalController::class, 'edit'])->name('soal.edit');
        Route::put('/{soal_id}', [SoalController::class, 'update'])->name('soal.update');
        Route::delete('/{soal_id}', [SoalController::class, 'destroy'])->name('soal.destroy');
    });

    // Jawaban Ujian
    Route::get('/ujian/{ujianId}/index', [JawabanController::class, 'index'])->name('jawaban.index');
    Route::get('/jawaban/{ujianId}/detail', [JawabanController::class, 'showDetail'])->name('jawaban.detail');
    Route::get('/ujian/{ujianId}/siswa/{userId}/jawaban', [JawabanController::class, 'detailSiswaJawaban'])->name('jawaban.siswa.detail');
    Route::post('/ujian/{ujian}/jawaban', [JawabanController::class, 'submit'])->name('jawaban.submit');
    Route::get('/ujian/{ujianId}/hasil', [JawabanController::class, 'hasil'])->name('ujian.hasil');

    // Hasil Ujian

    // Konsultasi
    Route::resource('konsultasi', KonsultasiController::class);
    Route::get('/konsultasi/{id}/download', [KonsultasiController::class, 'downloadPDF'])->name('konsultasi.download');
    Route::get('/lainnya2', [KonsultasiController::class, 'lainnya2'])->name('konsultasi.lainnya');

    // Dashboard Siswa
    Route::view('/dashboard2', 'Siswa.dashboard2')->name('dashboard2');
});

/*
|--------------------------------------------------------------------------
| Route Import
|--------------------------------------------------------------------------
*/
Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
Route::post('/PTN/import', [PTNController::class, 'import'])->name('PTN.import');
Route::post('/ptn/{kode_ptn}/import', [JurusanController::class, 'import'])->name('jurusan.import');
Route::post('ujian/{ujian_id}/kategori/{kategori_id}/soal', [SoalController::class, 'import'])->name('soal.import');

Route::get('/admin/export-jawaban', function () {
    $siswaList = \App\Models\Siswa::with('user')->get();
    $soals = \App\Models\Soal::all();
    $jawabans = \App\Models\Jawaban::all();

    return Excel::download(new JawabanUjianExport($siswaList, $soals, $jawabans), 'rekap-jawaban.xlsx');
})->name('export.jawaban');
