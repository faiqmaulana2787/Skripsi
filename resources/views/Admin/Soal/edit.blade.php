@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit Soal untuk {{ $kategori->nama_kategori }}</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('soal.update', ['ujian_id' => $kategori->ujian_id, 'kategori_id' => $kategori->id, 'soal_id' => $soal->id]) }}"
            method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Pertanyaan</label>
                <textarea name="pertanyaan" class="w-full border p-2 rounded" required>{{ $soal->pertanyaan }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Nilai</label>
                <input type="number" name="nilai_soal"
                    class="border border-gray-300 rounded w-full p-2 focus:ring focus:ring-blue-300"
                    value="{{ $soal->nilai_soal }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Gambar (Opsional)</label>
                <input type="file" name="gambar" class="w-full border p-2 rounded">
                @if ($soal->gambar)
                    <div class="mt-2">
                        <p class="text-gray-700">Gambar saat ini:</p>
                        <img src="{{ asset('storage/' . $soal->gambar) }}" alt="Gambar Soal" class="w-32 h-32 object-cover">
                    </div>
                @endif
            </div>

            @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">Pilihan {{ strtoupper($opt) }}</label>
                    <input type="text" name="opsi_{{ $opt }}" class="w-full border p-2 rounded"
                        value="{{ $soal['opsi_' . $opt] }}" required>
                </div>
            @endforeach

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Jawaban Benar</label>
                <select name="jawaban_benar" class="w-full border p-2 rounded">
                    <option value="a" {{ $soal->jawaban_benar == 'a' ? 'selected' : '' }}>A</option>
                    <option value="b" {{ $soal->jawaban_benar == 'b' ? 'selected' : '' }}>B</option>
                    <option value="c" {{ $soal->jawaban_benar == 'c' ? 'selected' : '' }}>C</option>
                    <option value="d" {{ $soal->jawaban_benar == 'd' ? 'selected' : '' }}>D</option>
                    <option value="e" {{ $soal->jawaban_benar == 'e' ? 'selected' : '' }}>E</option>
                </select>
            </div>
            <div class="w-full flex justify-between items-center mt-4">
                <a href="{{ route('soal.index', ['ujian_id' => $kategori->ujian_id, 'kategori_id' => $kategori->id]) }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
