@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-2">Daftar Akun Siswa</h2>
            <p class="text-center text-gray-500 mb-6">Kelola akun siswa untuk sistem ujian.</p>

            <div class="flex flex-wrap gap-3 mb-6 items-center justify-between">
                <a href="{{ route('siswa.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded shadow text-sm flex items-center gap-2">
                    <i class="fas fa-plus"></i> Tambah Siswa
                </a>

                <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex items-center gap-2">
                    @csrf
                    <input type="file" name="file" accept=".xlsx, .xls, .csv"
                        class="border border-gray-300 text-sm px-3 py-1.5 rounded w-56 shadow-sm">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded shadow text-sm flex items-center gap-2">
                        <i class="fas fa-file-import"></i> Import Excel
                    </button>
                </form>

                <form method="GET" action="{{ route('siswa.index') }}" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="border text-sm px-3 py-1.5 rounded w-56 shadow-sm" placeholder="Cari Nama Siswa ...">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded shadow flex items-center text-sm">
                        <i class="fas fa-search mr-1"></i> Cari
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm min-w-max">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="p-3 text-center">No</th>
                            <th class="p-3 text-center">No Peserta</th>
                            <th class="p-3 text-center">Nama</th>
                            <th class="p-3 text-center">Asal Sekolah</th>
                            <th class="p-3 text-center">Kelas</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $index => $siswa)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="p-3 text-center">{{ $index + 1 }}</td>
                                <td class="p-3 text-center text-blue-600 font-mono">{{ $siswa->user->no_peserta }}</td>
                                <td class="p-3 text-center text-blue-600 font-medium">{{ $siswa->user->nama }}</td>
                                <td class="p-3 text-center text-blue-600 font-medium">{{ $siswa->asal_sekolah }}</td>
                                <td class="p-3 text-center text-blue-600 font-medium">
                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                                        {{ $siswa->kelas }}
                                    </span>
                                </td>
                                <td class="p-3 text-center space-x-1">
                                    <a href="{{ route('siswa.show', $siswa->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs shadow items-center gap-1 inline-flex">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('siswa.edit', $siswa->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs shadow items-center gap-1 inline-flex">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus akun siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow flex items-center gap-1">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-gray-500 py-6">Tidak ada data siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $siswas->withQueryString()->links() }}
                </div>
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
