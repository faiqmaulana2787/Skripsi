@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-2xl p-10">
            <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-3">Detail Siswa</h1>
            <p class="text-center text-gray-500 mb-10">Informasi akun siswa dan pilihan PTN</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <!-- Kolom Informasi Siswa -->
                <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Informasi Siswa</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm text-gray-500">No Peserta</p>
                            <p class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-id-card-alt mr-2 text-blue-500"></i>{{ $siswa->user->no_peserta }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-user mr-2 text-green-500"></i>{{ $siswa->user->nama }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Asal Sekolah</p>
                            <p class="text-lg font-medium text-gray-700 flex items-center">
                                <i class="fas fa-school mr-2 text-yellow-500"></i>{{ $siswa->asal_sekolah ?? '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kelas</p>
                            <span
                                class="inline-flex items-center bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full mt-1">
                                <i class="fas fa-graduation-cap mr-1"></i>{{ $siswa->kelas }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Kolom Pilihan PTN -->
                @if ($siswa->kelas == 'XII')
                    <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border">
                        <h2 class="text-xl font-bold text-gray-700 mb-4">Pilihan Perguruan Tinggi Negri & Jurusan</h2>
                        <div class="space-y-5">
                            @foreach ([1, 2, 3, 4] as $i)
                                @php
                                    $ptn = $siswa->{'ptn_' . $i};
                                    $jurusan = $siswa->{'jurusan' . $i};
                                @endphp
                                <div>
                                    <p class="text-sm font-semibold text-gray-500">Pilihan {{ $i }}</p>
                                    <p class="text-base font-medium text-gray-700">
                                        {{ optional($ptn)->kode_ptn ?? 'Tidak Ada' }} -
                                        {{ optional($ptn)->nama_ptn ?? 'Tidak Ada' }}
                                        <br>
                                        {{ optional($jurusan)->kode_jurusan ?? 'Tidak Ada' }} -
                                        {{ optional($jurusan)->jenjang ?? 'Tidak Ada' }} -
                                        {{ optional($jurusan)->nama_jurusan ?? 'Tidak Ada' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="mt-10 text-start">
                <a href="{{ route('siswa.index') }}"
                    class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-lg py-2.5 px-6 rounded-xl shadow transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
