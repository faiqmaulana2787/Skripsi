@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-2">Daftar Ujian</h2>
            <p class="text-center text-gray-500 mb-6">Kelola semua data ujian beserta kategorinya.</p>

            <div class="flex flex-wrap justify-between items-center gap-3 mb-6">
                <a href="{{ route('ujian.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow text-sm flex items-center gap-2">
                    <i class="fas fa-plus"></i> Tambah Ujian
                </a>

                <form method="GET" action="{{ route('ujian.index') }}" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="border text-sm px-3 py-2 rounded w-64 shadow-sm" placeholder="Cari Nama Ujian ...">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow text-sm flex items-center gap-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="p-3 text-center">No</th>
                            <th class="p-3 text-center">Nama Ujian</th>
                            <th class="p-3 text-center">Waktu Mulai</th>
                            <th class="p-3 text-center">Waktu Selesai</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ujians as $index => $ujian)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="p-3 text-center">{{ $index + 1 }}</td>
                                <td class="p-3 text-center font-semibold text-blue-700">{{ $ujian->nama_ujian }}</td>
                                <td class="p-3 text-center">{{ $ujian->waktu_mulai }}</td>
                                <td class="p-3 text-center">{{ $ujian->waktu_selesai }}</td>
                                <td class="p-3 text-center">
                                    <div class="flex flex-wrap justify-center gap-2">
                                        <a href="{{ route('kategori.index', $ujian->id) }}"
                                            class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1 shadow">
                                            <i class="fas fa-layer-group"></i> Kategori
                                        </a>
                                        <a href="{{ route('ujian.show', $ujian->id) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1 shadow">
                                            <i class="fas fa-play"></i> Kerjakan
                                        </a>
                                        <a href="{{ route('jawaban.index', $ujian->id) }}"
                                            class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1 shadow">
                                            <i class="fas fa-file-alt"></i> Jawaban
                                        </a>
                                        <a href="{{ route('ujian.edit', $ujian->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1 shadow">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('ujian.destroy', $ujian->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus ujian ini?')"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1 shadow">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-6">Tidak ada data ujian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000,
            });
        @endif
    </script>
@endsection
