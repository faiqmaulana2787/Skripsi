<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Konsultasi SNBP 2025</title>
    <link rel="website icon" type="png" href="{{ asset('img/logo_ecc.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body class="bg-gray-100 text-sm font-sans leading-relaxed text-gray-800">

    <div class="container mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="text-center mb-10">
            <img src="{{ asset('img/logo_ecc.png') }}" alt="Logo ECC" class="mx-auto h-20 mb-4">
            <h1 class="text-3xl font-semibold text-gray-800 uppercase">Hasil Konsultasi SNBP 2025</h1>
            <h2 class="text-lg font-medium text-gray-600">BIMBEL ECC NGAWI</h2>
        </div>

        {{-- Data Siswa --}}
        <div class="max-w-2xl mx-auto mb-6 border border-gray-300 rounded-xl shadow-lg p-6 bg-white">
            <div class="flex justify-between text-gray-700 text-lg">
                <div>
                    <i class="fas fa-user-graduate text-blue-500 mr-2"></i>
                    <span class="font-semibold">Nama Siswa:</span>
                    {{ $konsultasi->user->nama }}
                </div>
                <div>
                    <i class="fas fa-school text-green-500 mr-2"></i>
                    <span class="font-semibold">Asal Sekolah:</span>
                    {{ $konsultasi->user->siswa->asal_sekolah }}
                </div>
            </div>
        </div>

        {{-- Tabel Nilai --}}
        <div class="max-w-2xl mx-auto mb-6 border border-gray-300 rounded-xl shadow-lg bg-white overflow-x-auto">
            <table class="w-full table-auto text-center">
                <thead class="bg-gray-200">
                    <tr class="text-sm text-gray-600">
                        @for ($i = 1; $i <= 5; $i++)
                            <th class="border px-4 py-3">{{ 'Semester ' . $i }}</th>
                        @endfor
                        <th class="border px-4 py-3 bg-gray-100 font-semibold text-blue-600">Rata-rata Raport</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white hover:bg-gray-50 transition duration-300">
                        @for ($i = 1; $i <= 5; $i++)
                            <td class="border px-4 py-3 text-gray-700">{{ $konsultasi->{'nilai_semester_' . $i} }}</td>
                        @endfor
                        <td class="border px-4 py-3 font-semibold text-blue-600">
                            {{ number_format(
                                ($konsultasi->nilai_semester_1 +
                                    $konsultasi->nilai_semester_2 +
                                    $konsultasi->nilai_semester_3 +
                                    $konsultasi->nilai_semester_4 +
                                    $konsultasi->nilai_semester_5) /
                                    5,
                                2,
                            ) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Hasil Konsultasi PTN --}}
        <div class="max-w-2xl mx-auto mb-6 border border-gray-300 rounded-xl shadow-lg bg-white">
            <div class="bg-gray-100 px-6 py-4 font-semibold text-sm text-gray-700 border-b border-gray-300">
                <i class="fas fa-university text-blue-500 mr-2"></i> Pilihan Perguruan Tinggi Negeri & Jurusan
            </div>
            <div class="p-6 text-sm space-y-6 text-gray-700">
                @for ($i = 1; $i <= 2; $i++)
                    <div
                        class="border border-gray-200 rounded-xl p-4 bg-gray-50 hover:bg-gray-100 transition duration-300">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-building text-blue-500"></i>
                            <span class="font-semibold">Pilihan PTN {{ $i }}:</span>
                            <span>{{ $konsultasi->{'ptn_' . $i}->nama_ptn ?? '-' }}</span>
                        </div>
                        <div class="flex items-center space-x-2 mt-2">
                            <i class="fas fa-cogs text-green-500"></i>
                            <span class="font-semibold">Jurusan:</span>
                            <span>{{ $konsultasi->user->siswa->{'jurusan' . $i}->nama_jurusan ?? '-' }}</span>
                        </div>
                        <div class="flex items-center space-x-2 mt-2">
                            <i class="fas fa-star text-yellow-500"></i>
                            <span class="font-semibold">Nilai Jurusan:</span>
                            <span>{{ $konsultasi->user->siswa['jurusan' . $i]->nilai_jurusan ?? '-' }}</span>
                        </div>
                        <div class="mt-3 text-gray-600">
                            <span class="font-semibold">Keterangan:</span><br>
                            @php
                                $nilai_jurusan = $konsultasi->user->siswa['jurusan' . $i]->nilai_jurusan ?? null;
                                $rata_rata =
                                    ($konsultasi->nilai_semester_1 +
                                        $konsultasi->nilai_semester_2 +
                                        $konsultasi->nilai_semester_3 +
                                        $konsultasi->nilai_semester_4 +
                                        $konsultasi->nilai_semester_5) /
                                    5;
                            @endphp

                            @if ($nilai_jurusan !== null)
                                @if ($rata_rata >= $nilai_jurusan)
                                    <span class="font-bold text-green-600">Selamat, Anda lulus! </span>
                                    Nilai rata-rata Anda ({{ number_format($rata_rata, 2) }}) lebih tinggi dari nilai
                                    jurusan ({{ $nilai_jurusan }}).
                                @else
                                    <span class="font-bold text-red-600">Maaf, Anda belum lulus.</span>
                                    Nilai rata-rata Anda ({{ number_format($rata_rata, 2) }}) masih kurang dari nilai
                                    jurusan ({{ $nilai_jurusan }}).
                                @endif
                            @else
                                <span class="text-gray-500">Nilai jurusan belum tersedia.</span>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Disclaimer --}}
        <div class="text-center text-xs text-gray-600 max-w-2xl mx-auto border-t pt-6 mt-6">
            <p>Hasil ini hanya berdasarkan nilai rapor siswa.</p>
            <p>Keputusan kelulusan SNBP ada pada panitia SNPMB 2025.</p>
        </div>

        {{-- Aksi Tombol --}}
        <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-4 px-4">
            <!-- Tombol Kembali -->
            <div class="w-full md:w-auto text-center md:text-right">
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('konsultasi.index') }}"
                        class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Konsultasi
                    </a>
                @else
                    <a href="{{ route('konsultasi.lainnya') }}"
                        class="inline-flex items-center justify-center bg-gray-600 hover:bg-gray-700 text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                    </a>
                @endif
            </div>

            <!-- Tombol Download PDF -->
            <div class="w-full md:w-auto text-center md:text-left">
                <a href="{{ route('konsultasi.download', $konsultasi->id) }}"
                    class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow transition duration-200">
                    <i class="fas fa-file-download mr-2"></i> Download Hasil PDF
                </a>
            </div>
        </div>
    </div>

</body>

</html>
