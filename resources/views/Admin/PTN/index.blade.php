@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-2">Daftar Perguruan Tinggi Negeri</h2>
            <p class="text-center text-gray-500 mb-6">Kelola daftar PTN dan akses jurusan yang tersedia untuk setiap kampus.
            </p>
            <div class="flex flex-wrap gap-3 mb-6 items-center justify-between">
                <a href="{{ route('PTN.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded shadow text-sm flex items-center gap-2">
                    <i class="fas fa-plus"></i> Tambah
                </a>

                <form action="{{ route('PTN.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex items-center gap-2">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.xls,.csv"
                        class="border border-gray-300 text-sm px-3 py-1.5 rounded w-56 shadow-sm">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded shadow text-sm flex items-center gap-2">
                        <i class="fas fa-file-import"></i> Import
                    </button>
                </form>

                <form method="GET" action="{{ route('PTN.index') }}" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="border text-sm px-3 py-1.5 rounded w-56 shadow-sm"
                        placeholder="Cari Perguruan Tinggi Negri ...">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded shadow flex items-center text-sm">
                        <i class="fas fa-search mr-1"></i> Cari
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse rounded-md shadow-sm text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="p-3 text-center">No</th>
                            <th class="p-3 text-center">Kode PTN</th>
                            <th class="p-3 text-center">Nama PTN</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($p_t_n_s as $index => $ptn)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="p-3 text-center">{{ $index + 1 }}</td>
                                <td class="p-3 text-center font-mono text-blue-700">{{ $ptn->kode_ptn }}</td>
                                <td class="p-3 text-center font-semibold text-blue-600">{{ $ptn->nama_ptn }}</td>
                                <td class="p-3 text-center flex justify-center gap-2">
                                    <a href="{{ route('jurusan.index', $ptn->kode_ptn) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                        <i class="fas fa-eye"></i> Jurusan
                                    </a>
                                    <a href="{{ route('PTN.edit', $ptn->kode_ptn) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('PTN.destroy', $ptn->kode_ptn) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data PTN ini?')"
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
                                <td colspan="4" class="text-center text-gray-500 py-6">Belum ada data PTN yang
                                    ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $p_t_n_s->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
