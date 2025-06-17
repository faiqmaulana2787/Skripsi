@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">
            Konsultasi Siswa
        </h2>

        <form action="{{ route('konsultasi.update', $konsultasi->id) }}" method="POST"
            class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $konsultasi->user->nama) }}"
                        class="w-full border-gray-300 bg-gray-100 border p-2 rounded focus:ring focus:ring-blue-300"
                        readonly>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">No Peserta</label>
                    <input type="text" name="no_peserta" value="{{ old('no_peserta', $konsultasi->no_peserta) }}"
                        class="w-full border-gray-300 bg-gray-100 border p-2 rounded focus:ring focus:ring-blue-300"
                        readonly>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">Asal Sekolah</label>
                    <input type="text" name="asal_sekolah"
                        value="{{ old('asal_sekolah', $konsultasi->siswas->asal_sekolah) }}"
                        class="w-full border-gray-300 bg-gray-100 border p-2 rounded focus:ring focus:ring-blue-300"
                        readonly>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('asal_sekolah', $konsultasi->siswas->kelas) }}"
                        class="w-full border-gray-300 bg-gray-100 border p-2 rounded focus:ring focus:ring-blue-300"
                        readonly>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="mb-4">
                        <label class="block font-semibold">Nilai Semester {{ $i }}</label>
                        <input type="number" step="0.01" name="nilai_semester_{{ $i }}"
                            class="w-full border p-2 rounded"
                            value="{{ old('nilai_semester_' . $i, $konsultasi->{'nilai_semester_' . $i} ?? '') }}" required>
                    </div>
                @endfor
                <div class="mb-4">
                    <label class="block font-semibold">Nilai Rata-Rata</label>
                    <input type="number" step="0.01" name="nilai_rata"
                        value="{{ number_format(($konsultasi->nilai_semester_1 + $konsultasi->nilai_semester_2 + $konsultasi->nilai_semester_3 + $konsultasi->nilai_semester_4 + $konsultasi->nilai_semester_5) / 5, 2) }}"
                        class="w-full border p-2 rounded bg-gray-100" readonly>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block font-semibold">Pilihan 1</label>
                    <input type="text" name="nama_ptn"
                        value="{{ ($konsultasi->ptn_1->nama_ptn ?? '-') .
                            ' - ' .
                            ($konsultasi->siswas->jurusan1->jenjang ?? '-') .
                            ' - ' .
                            ($konsultasi->siswas->jurusan1->nama_jurusan ?? '-') }}"
                        class="w-full border-gray-300 bg-gray-100 border p-2 rounded focus:ring focus:ring-blue-300"
                        readonly>
                </div>
                <div class="mb-4">
                    <label for="nilai_jurusan_1" class="font-semibold">Nilai Jurusan 1</label>
                    <input type="number" step="0.01" min="0" max="100" class="w-full border p-2 rounded"
                        id="nilai_jurusan_1" name="nilai_jurusan_1"
                        value="{{ old('nilai_jurusan_1', $konsultasi->nilai_jurusan_1) }}" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Pilihan 2</label>
                    <input type="text" name="nama_ptn"
                        value="{{ ($konsultasi->ptn_2->nama_ptn ?? '-') .
                            ' - ' .
                            ($konsultasi->siswas->jurusan2->jenjang ?? '-') .
                            ' - ' .
                            ($konsultasi->siswas->jurusan2->nama_jurusan ?? '-') }}"
                        class="w-full border-gray-300 bg-gray-100 border p-2 rounded focus:ring focus:ring-blue-300"
                        readonly>
                </div>
                <div class="mb-4">
                    <label for="nilai_jurusan_2" class="font-semibold">Nilai Jurusan 2</label>
                    <input type="number" step="0.01" min="0" max="100" class="w-full border p-2 rounded"
                        id="nilai_jurusan_2" name="nilai_jurusan_2"
                        value="{{ old('nilai_jurusan_2', $konsultasi->nilai_jurusan_2) }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="hasil_konsultasi" class="font-semibold">Hasil Konsultasi</label>
                <textarea class="w-full border p-2 rounded" id="hasil_konsultasi" name="hasil_konsultasi" rows="4" required>{{ old('hasil_konsultasi', $konsultasi->hasil_konsultasi) }}</textarea>
            </div>

            <div class="flex justify-between mt-6">
                <a href="{{ route('konsultasi.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Kembali
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </div>
        </form>

    </div>
@endsection
