@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">Tambah PTN</h2>

        <form action="{{ route('PTN.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold">Kode PTN</label>
                <input type="number" name="kode_ptn" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Nama PTN</label>
                <input type="text" name="nama_ptn" class="w-full border p-2 rounded" required>
            </div>


            <div class="w-full flex justify-between items-center mt-4">
                <a href="{{ route('PTN.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-4">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
@endsection
