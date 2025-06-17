@extends('layouts.admin')

@section('title', 'Detail Jawaban')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-md p-8">
            <div class="flex items-center justify-between mb-6 flex-wrap gap-2">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-clipboard-check text-blue-600 mr-2"></i> Detail Jawaban Siswa
                </h2>
                <a href="{{ route('jawaban.siswa.list', $jawabans->first()->ujian_id ?? '') }}"
                    class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition">
                    <i class="fas fa-arrow-left text-xs"></i> Kembali
                </a>
            </div>

            @php
                $totalBenar = $jawabans
                    ->filter(fn($jawaban) => $jawaban->jawaban === $jawaban->soal->jawaban_benar)
                    ->count();
            @endphp

            <div class="mb-6 text-right">
                <span class="inline-block text-sm bg-blue-100 text-blue-800 font-semibold px-4 py-2 rounded-lg shadow">
                    Total Jawaban Benar: {{ $totalBenar }} / {{ $jawabans->count() }}
                </span>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full text-sm text-gray-800">
                    <thead class="bg-blue-50 text-blue-800 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Pertanyaan</th>
                            <th class="px-4 py-3 text-center">Jawaban Siswa</th>
                            @if (auth()->user()->role === 'admin')
                                <th class="px-4 py-3 text-center">Jawaban Benar</th>
                            @endif
                            <th class="px-4 py-3 text-center">Kategori</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($jawabans as $index => $jawaban)
                            @php
                                $isCorrect = $jawaban->jawaban === $jawaban->soal->jawaban_benar;
                            @endphp
                            <tr class="{{ $isCorrect ? 'bg-green-50' : 'bg-red-50' }} hover:bg-opacity-80 transition">
                                <td class="px-4 py-3 font-medium">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-left">
                                    {{ $jawaban->soal->pertanyaan ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center font-semibold {{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $jawaban->jawaban ?? '-' }}
                                </td>
                                @if (auth()->user()->role === 'admin')
                                    <td class="px-4 py-3 text-center text-blue-600 font-semibold">
                                        {{ $jawaban->soal->jawaban_benar ?? '-' }}
                                    </td>
                                @endif
                                <td class="px-4 py-3 text-center">
                                    {{ $jawaban->kategori->nama_kategori ?? '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->role === 'admin' ? 5 : 4 }}"
                                    class="px-5 py-6 text-center text-gray-500 italic">
                                    Belum ada data jawaban.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
