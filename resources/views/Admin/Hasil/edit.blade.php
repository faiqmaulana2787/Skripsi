@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white p-6 rounded shadow-md max-w-xl mx-auto">
            <h2 class="text-2xl font-semibold mb-4">Edit Nilai Hasil Ujian</h2>

            <form action="{{ route('hasilujian.update', $hasilUjian->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                    <p class="text-gray-800">{{ $hasilUjian->user->name ?? '-' }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama Ujian</label>
                    <p class="text-gray-800">{{ $hasilUjian->ujian->nama_ujian ?? '-' }}</p>
                </div>

                <div class="mb-4">
                    <label for="total_benar" class="block text-sm font-medium text-gray-700">Total Benar</label>
                    <input type="number" name="total_benar" id="total_benar"
                        value="{{ old('total_benar', $hasilUjian->total_benar) }}"
                        class="form-input w-full mt-1 border-gray-300 rounded shadow-sm" required>
                </div>

                <div class="mb-4">
                    <label for="total_salah" class="block text-sm font-medium text-gray-700">Total Salah</label>
                    <input type="number" name="total_salah" id="total_salah"
                        value="{{ old('total_salah', $hasilUjian->total_salah) }}"
                        class="form-input w-full mt-1 border-gray-300 rounded shadow-sm" required>
                </div>

                <div class="mb-6">
                    <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai (%)</label>
                    <input type="number" name="nilai" id="nilai" step="0.01" max="100"
                        value="{{ old('nilai', $hasilUjian->nilai) }}"
                        class="form-input w-full mt-1 border-gray-300 rounded shadow-sm" required>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('hasilujian.index') }}" class="mr-4 text-sm text-gray-600 hover:underline">Batal</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
