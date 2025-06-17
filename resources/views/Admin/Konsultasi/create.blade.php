@extends('layouts.siswa')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center">
            Konsultasi
        </h2>

        <form action="{{ route('konsultasi.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
            @csrf
            @if (isset($konsultasi))
                @method('PUT')
            @endif

            @for ($i = 1; $i <= 5; $i++)
                <div class="mb-4">
                    <label class="block font-semibold">Nilai Semester {{ $i }}</label>
                    <input type="number" step="0.01" name="nilai_semester_{{ $i }}"
                        class="w-full border p-2 rounded"
                        value="{{ old('nilai_semester_' . $i, $konsultasi->{'nilai_semester_' . $i} ?? '') }}" required>
                </div>
            @endfor

            <div class="flex justify-between mt-6">
                <a href="{{ route('konsultasi.lainnya') }}"
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
