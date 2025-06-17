@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-2">
                Daftar Kategori - {{ $ujian->nama_ujian }}
            </h2>
            <p class="text-center text-gray-500 mb-6">
                Kelola kategori soal dan durasi untuk setiap jenis ujian.
            </p>

            <div class="flex flex-wrap gap-3 mb-6 items-center justify-between">
                <a href="{{ route('ujian.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded shadow text-sm flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <a href="{{ route('kategori.create', ['ujian_id' => $ujian->id]) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded shadow text-sm flex items-center gap-2">
                    <i class="fas fa-plus"></i> Tambah Kategori
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse rounded-md shadow-sm text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="p-3 text-center">No</th>
                            <th class="p-3 text-center">Nama Kategori</th>
                            <th class="p-3 text-center">Durasi (menit)</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoris as $index => $kategori)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="p-3 text-center">{{ $index + 1 }}</td>
                                <td class="p-3 text-center text-blue-700 font-semibold">{{ $kategori->nama_kategori }}</td>
                                <td class="p-3 text-center">{{ $kategori->durasi }}</td>
                                <td class="p-3 text-center flex justify-center gap-2">
                                    <a href="{{ route('soal.index', ['ujian_id' => $ujian->id, 'kategori_id' => $kategori->id]) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                        <i class="fas fa-tasks"></i> Soal
                                    </a>
                                    <a href="{{ route('kategori.edit', ['ujian_id' => $ujian->id, 'kategori_id' => $kategori->id]) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form
                                        action="{{ route('kategori.destroy', ['ujian_id' => $ujian->id, 'kategori_id' => $kategori->id]) }}"
                                        method="POST" onsubmit="return confirm('Yakin ingin menghapus?')"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 py-6">
                                    Belum ada kategori yang ditambahkan.
                                </td>
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
