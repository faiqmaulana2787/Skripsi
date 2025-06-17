@extends('layouts.siswa')

@section('title', 'Konsultasi Siswa')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-4xl font-bold text-center text-blue-800 mb-10"><i class="fas fa-comments mr-2"></i>Konsultasi Anda
        </h2>

        @if ($konsultasis->isEmpty())
            <div class="text-center text-gray-500">
                <i class="fas fa-folder-open text-6xl mb-4 text-gray-400"></i>
                <h3 class="text-xl font-semibold mb-2">Belum ada data konsultasi</h3>
                <p class="mb-6">Silakan mulai mengisi data untuk mendapatkan hasil konsultasi Anda.</p>
                <a href="{{ route('konsultasi.create') }}"
                    class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-full shadow-lg transition duration-300">
                    <i class="fas fa-plus-circle mr-2"></i>Isi Konsultasi
                </a>
            </div>
        @else
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-1 text-center">
                @foreach ($konsultasis as $konsultasi)
                    <div
                        class="bg-white rounded-xl shadow-lg p-6 border border-gray-200 hover:shadow-2xl transition duration-300">
                        <div class="mb-4 flex justify-center space-x-3">
                            <i class="fas fa-user-graduate text-blue-600 text-3xl"></i>
                            <h3 class="text-xl font-semibold text-blue-700"> {{ $konsultasi->user->nama }}</h3>
                        </div>

                        <div class="space-y-2 text-gray-700 text-sm">
                            <p><i class="fas fa-id-badge mr-2 text-gray-500"></i><strong>No Peserta:</strong>
                                {{ $konsultasi->user->no_peserta }}</p>
                            <p><i class="fas fa-school mr-2 text-gray-500"></i><strong>Asal Sekolah:</strong>
                                {{ $konsultasi->user->siswa->asal_sekolah }}</p>
                            <p><i class="fas fa-chart-bar mr-2 text-gray-500"></i><strong>Nilai Rata-rata:</strong>
                                {{ number_format(
                                    ($konsultasi->nilai_semester_1 +
                                        $konsultasi->nilai_semester_2 +
                                        $konsultasi->nilai_semester_3 +
                                        $konsultasi->nilai_semester_4 +
                                        $konsultasi->nilai_semester_5) /
                                        5,
                                    2,
                                ) }}
                            </p>
                        </div>

                        <div class="mt-6 text-center">
                            <a href="{{ route('konsultasi.show', $konsultasi->id) }}"
                                class="inline-flex items-center bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-full shadow-md transition duration-200 text-sm font-medium">
                                <i class="fas fa-eye mr-2"></i>Lihat Hasil Konsultasi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
