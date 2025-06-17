@extends('layouts.siswa')

@section('content')
    <div class="container mx-auto px-6 mt-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">👤 Profil Siswa</h2>

        @if ($siswa->kelas === 'XII' && is_null($siswa->jurusan) && is_null($siswa->ptn_1) && is_null($siswa->ptn_2))
            <div
                class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 px-6 py-4 rounded-lg mb-6 shadow-md flex items-center gap-2">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                <span>
                    Harap lengkapi pilihan Jurusan dan PTN di halaman Edit Profil.
                </span>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-8 max-w-4xl mx-auto space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-profile-item label="No Peserta" :value="$siswa->user->no_peserta" />
                <x-profile-item label="Nama" :value="$siswa->user->nama" />
                <x-profile-item label="Asal Sekolah" :value="$siswa->asal_sekolah" />
                <x-profile-item label="Kelas" :value="$siswa->kelas" />
            </div>

            @if ($siswa->kelas === 'XII')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t pt-6">
                    <x-profile-item label="Pilihan 1" :value="($siswa->ptn_1->nama_ptn ?? 'Tidak Ada') .
                        ' - ' .
                        ($siswa->jurusan1->nama_jurusan ?? 'Tidak Ada')" icon="university" />
                    <x-profile-item label="Pilihan 2" :value="($siswa->ptn_2->nama_ptn ?? 'Tidak Ada') .
                        ' - ' .
                        ($siswa->jurusan2->nama_jurusan ?? 'Tidak Ada')" icon="university" />
                    <x-profile-item label="Pilihan 3" :value="($siswa->ptn_3->nama_ptn ?? 'Tidak Ada') .
                        ' - ' .
                        ($siswa->jurusan3->nama_jurusan ?? 'Tidak Ada')" icon="university" />
                    <x-profile-item label="Pilihan 4" :value="($siswa->ptn_4->nama_ptn ?? 'Tidak Ada') .
                        ' - ' .
                        ($siswa->jurusan4->nama_jurusan ?? 'Tidak Ada')" icon="university" />
                </div>
            @endif

            <div class="text-center">
                <a href="{{ route('profile.edit', $siswa->id) }}"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-3xl text-lg hover:bg-blue-700 transition transform hover:scale-105 shadow">
                    <i class="fas fa-edit"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
@endsection
