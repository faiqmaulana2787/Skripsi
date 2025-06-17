@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-8 text-center text-blue-600">Buat Ujian Baru</h2>

        <form action="{{ route('ujian.store') }}" method="POST"
            class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200">
            @csrf
            <!-- Nama Ujian -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Nama Ujian</label>
                <input type="text" name="nama_ujian"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>

            <!-- Waktu Mulai -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Waktu Mulai</label>
                <input type="datetime-local" name="waktu_mulai"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>

            <!-- Waktu Selesai -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Waktu Selesai</label>
                <input type="datetime-local" name="waktu_selesai"
                    class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                    required>
            </div>

            <!-- Pilih Siswa yang Bisa Mengerjakan -->
            <div class="mb-6">
                <label class="font-medium block mb-2">Pilih Siswa yang Bisa Mengerjakan:</label>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($siswa as $user)
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                class="h-5 w-5 text-blue-500 focus:ring-blue-300 border-gray-300 rounded-lg"
                                {{ in_array($user->id, old('user_ids', isset($ujian) ? $ujian->users->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                            <span class="text-gray-700">{{ $user->nama }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            @if (isset($ujian))
                <div class="mt-6">
                    <h4 class="text-lg font-semibold">Siswa yang Bisa Mengerjakan:</h4>
                    <ul class="list-disc pl-5 text-gray-700">
                        @foreach ($ujian->users as $user)
                            <li>{{ $user->nama }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Buttons -->
            <div class="w-full flex justify-between items-center mt-8">
                <a href="{{ route('ujian.index') }}"
                    class="bg-gray-500 text-white px-6 py-3 rounded-lg transition duration-300 hover:bg-gray-600">
                    Kembali
                </a>
                <button type="submit"
                    class="bg-blue-500 text-white px-6 py-3 rounded-lg transition duration-300 hover:bg-blue-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
