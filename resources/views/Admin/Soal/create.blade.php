@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">Tambah Soal untuk {{ $kategori->nama_kategori }}</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('soal.store', ['ujian_id' => $kategori->ujian_id, 'kategori_id' => $kategori->id]) }}"
            method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Pertanyaan</label>
                <textarea name="pertanyaan" class="w-full border p-2 rounded" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Nilai</label>
                <input type="number" name="nilai_soal"
                    class="border border-gray-300 rounded w-full p-2 focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Gambar (Opsional)</label>
                <input type="file" name="gambar" class="w-full border p-2 rounded">
            </div>

            @foreach (['A', 'B', 'C', 'D', 'E'] as $opsi)
                <div class="mb-4">
                    <label class="block font-semibold text-gray-700">Opsi {{ $opsi }}</label>
                    <input type="text" name="opsi_{{ strtolower($opsi) }}" class="w-full border p-2 rounded" required>
                </div>
            @endforeach

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Jawaban Benar</label>
                <select name="jawaban_benar" class="w-full border p-2 rounded">
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>E</option>
                </select>
            </div>
            <div class="w-full flex justify-between items-center mt-4">
                <a href="{{ route('soal.index', ['ujian_id' => $kategori->ujian_id, 'kategori_id' => $kategori->id]) }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
@endsection
