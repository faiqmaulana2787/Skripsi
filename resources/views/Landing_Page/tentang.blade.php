@extends('layouts.app')

@section('content')
    <section class="container mx-auto px-6 py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <!-- Deskripsi -->
            <div class="space-y-6">
                <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-4 py-1 rounded-full shadow">
                    Tentang ECC
                </span>
                <h2 class="text-4xl font-bold text-gray-900 leading-tight">
                    Solusi Digital untuk Evaluasi Kursus yang <span class="text-green-600">Efisien & Transparan</span>
                </h2>
                <p class="text-gray-700 text-lg leading-relaxed">
                    <strong>Education Center Class (ECC)</strong> adalah platform digital berbasis web yang dirancang untuk
                    mempermudah institusi pendidikan non-formal dalam menyelenggarakan ujian secara online. ECC hadir
                    sebagai mitra terpercaya dalam meningkatkan mutu evaluasi pembelajaran yang cepat, aman, dan
                    terintegrasi.
                </p>
                <ul class="space-y-4 text-gray-700">
                    <li class="flex items-start gap-3">
                        <i class="fas fa-laptop-code text-green-500 text-xl mt-1"></i>
                        <span>Mengelola ujian daring dengan antarmuka yang user-friendly</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-user-shield text-green-500 text-xl mt-1"></i>
                        <span>Keamanan dan privasi data peserta yang terjamin</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-sync-alt text-green-500 text-xl mt-1"></i>
                        <span>Real-time tracking & analisis hasil ujian langsung dari dashboard</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <i class="fas fa-chalkboard-teacher text-green-500 text-xl mt-1"></i>
                        <span>Dukungan penuh untuk pengajar, admin, dan siswa dalam satu sistem</span>
                    </li>
                </ul>
            </div>

            <!-- Gambar -->
            <div class="flex justify-center">
                <img src="{{ asset('img/logo_ecc.png') }}" alt="Logo ECC"
                    class="rounded-3xl shadow-xl w-full max-w-md hover:scale-105 transition duration-300">
            </div>
        </div>
    </section>
@endsection
