@extends('layouts.admin')

@section('title', 'Daftar Siswa')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-md p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-users mr-2 text-blue-600"></i> Daftar Siswa Mengikuti Ujian
                </h2>
                <a href="{{ route('ujian.index') }}"
                    class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-lg shadow transition">
                    <i class="fas fa-arrow-left text-xs"></i> Kembali
                </a>
            </div>

            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full text-sm text-gray-800">
                    <thead class="bg-blue-50 text-blue-800 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-5 py-3 text-left">No</th>
                            <th class="px-5 py-3 text-left">Nama Siswa</th>
                            <th class="px-5 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse ($siswaList as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-5 py-3 font-medium text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-5 py-3">{{ $item->user->nama ?? '-' }}</td>
                                <td class="px-5 py-3 text-center">
                                    <a href="{{ route('jawaban.siswa.detail', [$ujianId, $item->user->id]) }}"
                                        class="inline-flex items-center gap-1 text-sm bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md shadow-sm transition">
                                        <i class="fas fa-eye text-xs"></i> Lihat Jawaban
                                    </a>
                                    {{-- <a href="{{ route('jawaban.editNilai', [$ujianId, $item->user->id]) }}"
                                        class="inline-flex items-center gap-1 text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md shadow-sm transition">
                                        <i class="fas fa-eye text-xs"></i> Edit Nilai
                                    </a> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-5 py-5 text-center text-gray-500 italic">
                                    Belum ada siswa yang mengikuti ujian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
