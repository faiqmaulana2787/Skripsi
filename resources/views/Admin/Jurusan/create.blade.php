@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">Tambah Jurusan</h2>

        <form action="{{ route('jurusan.store', ['kode_ptn' => $ptn->kode_ptn]) }}" method="POST"
            class="max-w-lg mx-auto bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label for="kode_jurusan" class="block font-semibold">Kode Jurusan:</label>
                <input type="number" name="kode_jurusan" required
                    class="border border-gray-300 rounded w-full p-2 focus:ring focus:ring-blue-300">
            </div>
            <div class="mb-4">
                <label for="jenjang" class="block font-semibold">Jenjang:</label>
                <input type="text" name="jenjang" required
                    class="border border-gray-300 rounded w-full p-2 focus:ring focus:ring-blue-300">
            </div>
            <div class="mb-4">
                <label for="nama_jurusan" class="block font-semibold">Nama Jurusan:</label>
                <input type="text" name="nama_jurusan" required
                    class="border border-gray-300 rounded w-full p-2 focus:ring focus:ring-blue-300">
            </div>
            <div class="mb-4">
                <label for="nilai_jurusan" class="block font-semibold">Nilai Jurusan:</label>
                <input type="number" name="nilai_jurusan" required
                    class="border border-gray-300 rounded w-full p-2 focus:ring focus:ring-blue-300">
            </div>
            <div class="w-full flex justify-between items-center mt-4">
                <a href="{{ route('jurusan.index', $ptn->kode_ptn) }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded mr-4">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
@endsection
