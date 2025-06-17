@extends('layouts.siswa')

@section('content')
    <div class="container mx-auto px-6 mt-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">📚 Daftar Ujian Anda</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-xl overflow-hidden overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100 uppercase text-xs font-semibold tracking-wider">
                    <tr>
                        <th class="p-4 text-center">No</th>
                        <th class="p-4 text-center">Nama Ujian</th>
                        <th class="p-4 text-center">Waktu Mulai</th>
                        <th class="p-4 text-center">Waktu Selesai</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($ujians->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center px-6 py-4 text-gray-500 italic">
                                😕 Belum ada ujian yang tersedia untuk Anda.
                            </td>
                        </tr>
                    @else
                        @foreach ($ujians as $index => $ujian)
                            <tr class="border-t hover:bg-gray-50 transition">
                                <td class="text-center p-4 font-medium">{{ $index + 1 }}</td>
                                <td class="text-center p-4">{{ $ujian->nama_ujian }}</td>
                                <td class="text-center p-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($ujian->waktu_mulai)->format('d M Y, H:i') }}
                                </td>
                                <td class="text-center p-4 text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($ujian->waktu_selesai)->format('d M Y, H:i') }}
                                </td>
                                <td class="text-center p-4">
                                    @if (in_array($ujian->id, $jawaban_user))
                                        <span
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 text-white text-xs font-medium rounded-full">
                                            <i class="fas fa-check-circle"></i>
                                            <span class="hidden sm:inline">Sudah Dikerjakan</span>
                                        </span>
                                    @else
                                        <a href="{{ route('ujian.show', $ujian->id) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded-full hover:bg-blue-700 transition shadow">
                                            <i class="fas fa-pencil-alt"></i>
                                            <span class="hidden sm:inline">Kerjakan</span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
