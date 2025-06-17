@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">Tambah Kategori - {{ $ujian->nama_ujian }}</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kategori.store', ['ujian_id' => $ujian->id]) }}" method="POST"
            class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
            @csrf
            <div class="mb-4">
                <label for="nama_kategori" class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
                <input type="text" id="nama_kategori" name="nama_kategori"
                    class="border border-gray-300 rounded w-full p-2 focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label for="durasi" class="block text-gray-700 font-bold mb-2">Durasi (menit)</label>
                <input type="number" id="durasi" name="durasi"
                    class="border border-gray-300 rounded w-full p-2 focus:ring focus:ring-blue-300" required>
            </div>
            <div class="w-full flex justify-between items-center mt-4">
                <a href="{{ route('kategori.index', ['ujian_id' => $ujian->id]) }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
@endsection
