@extends('layouts.admin')

@section('title', 'Semua Jawaban Ujian')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-list-ul text-blue-600 mr-2"></i> Semua Jawaban Ujian
            </h2>

            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full text-sm text-gray-800">
                    <thead class="bg-blue-50 text-blue-800 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama Siswa</th>
                            @foreach ($soals as $soal)
                                <th class="px-4 py-3 text-center">Soal {{ $loop->iteration }}</th>
                            @endforeach
                            <th class="px-4 py-3 text-center">Total Benar</th>
                            <th class="px-4 py-3 text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @php
                            $no = 1;
                            $totalJawabanBenarSemua = 0;
                            $totalNilaiSemua = 0;
                            $benarPerSoal = array_fill(0, $soals->count(), 0);
                        @endphp
                        @foreach ($siswaList as $siswa)
                            @php
                                $jawabanSiswa = $jawabans->where('user_id', $siswa->user_id);
                                $jumlahBenar = 0;
                                $nilaiTotal = 0;
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center">{{ $no++ }}</td>
                                <td class="px-4 py-3 text-center font-semibold">{{ $siswa->user->nama }}</td>

                                @foreach ($soals as $index => $soal)
                                    @php
                                        $jawaban = $jawabanSiswa->firstWhere('soal_id', $soal->id);
                                        $benar = $jawaban && $jawaban->jawaban === $soal->jawaban_benar;
                                        if ($benar) {
                                            $jumlahBenar++;
                                            $benarPerSoal[$index]++;
                                            $nilaiTotal += $soal->nilai_soal;
                                        }
                                    @endphp
                                    <td
                                        class="px-4 py-3 text-center font-semibold {{ $benar ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $jawaban->jawaban ?? '-' }}
                                    </td>
                                @endforeach

                                <td class="px-4 py-3 text-center font-bold text-blue-700">
                                    {{ $jumlahBenar }}
                                </td>
                                <td class="px-4 py-3 text-center font-bold text-green-700">
                                    {{ $nilaiTotal }}
                                </td>
                            </tr>
                            @php
                                $totalJawabanBenarSemua += $jumlahBenar;
                                $totalNilaiSemua += $nilaiTotal;
                            @endphp
                        @endforeach

                        {{-- Total Jawaban Benar per Soal --}}
                        <tr class="bg-gray-100 font-semibold">
                            <td colspan="2" class="px-4 py-3 text-right">Total Jawaban Benar Soal</td>
                            @foreach ($benarPerSoal as $jumlah)
                                <td class="px-4 py-3 text-center text-blue-600">{{ $jumlah }}</td>
                            @endforeach
                            <td class="px-4 py-3 text-center font-bold text-blue-800">
                                {{ $totalJawabanBenarSemua }}
                            </td>
                            <td class="px-4 py-3 text-center font-bold text-green-800">
                                {{ $totalNilaiSemua }}
                            </td>
                        </tr>
                        <a href="{{ route('export.jawaban') }}"
                            class="inline-block mb-4 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow">
                            <i class="fas fa-file-excel mr-2"></i> Export Excel
                        </a>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
