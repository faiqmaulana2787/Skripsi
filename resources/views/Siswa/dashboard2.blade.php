@extends('layouts.siswa')

@section('content')
    <div class="w-full px-6 mt-10">
        <header class="mb-10">
            <h1 class="text-3xl font-bold text-gray-800">Halo, {{ Auth::user()->nama }} 👋</h1>
            <p class="text-gray-600 text-sm mt-1">Selamat datang di Dashboard Education Center Class.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- Card Ujian -->
            <div class="bg-white border-l-4 border-blue-600 shadow-md rounded-2xl p-6 hover:shadow-lg transition">
                <div class="flex items-center space-x-4">
                    <div class="p-4 rounded-full bg-blue-600 text-white text-2xl">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Jumlah Ujian</h3>
                        <p class="text-sm text-gray-500">
                            {{ number_format(auth()->user()->ujians()->count()) }} Ujian Tersedia
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Konsultasi -->
            <div class="bg-white border-l-4 border-green-600 shadow-md rounded-2xl p-6 hover:shadow-lg transition">
                <div class="flex items-center space-x-4">
                    <div class="p-4 rounded-full bg-green-600 text-white text-2xl">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Konsultasi Anda</h3>
                        <p class="text-sm text-gray-500">
                            {{ number_format(\App\Models\Konsultasi::where('user_id', auth()->id())->count()) }}
                            Konsultasi Terdata
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Informasi Profil -->
            <div class="bg-white border-l-4 border-purple-600 shadow-md rounded-2xl p-6 hover:shadow-lg transition">
                <div class="flex items-center space-x-4">
                    <div class="p-4 rounded-full bg-purple-600 text-white text-2xl">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Profil Anda</h3>
                        <p class="text-sm text-gray-500">
                            No Peserta: <strong>{{ Auth::user()->no_peserta }}</strong>
                        </p>
                        <p class="text-sm text-gray-500">
                            Nama: <strong>{{ Auth::user()->nama }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
