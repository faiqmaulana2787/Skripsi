@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-3xl font-bold mb-2 text-center text-gray-800">Daftar Jurusan</h2>
            <p class="text-center text-gray-500 mb-6">Jurusan yang terdaftar pada PTN <strong>{{ $ptn->nama_ptn }}</strong>
            </p>

            <div class="flex flex-wrap gap-3 mb-6 items-center justify-between">
                <div class="flex items-center space-x-3">
                    <a href="{{ route('PTN.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1.5 rounded shadow">
                        <i class="fas fa-arrow-left mr-1"></i>
                    </a>

                    <a href="{{ route('jurusan.create', ['kode_ptn' => $ptn->kode_ptn]) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded shadow">
                        <i class="fas fa-plus mr-1"></i> Tambah Jurusan
                    </a>
                </div>

                <form action="{{ route('jurusan.import', ['kode_ptn' => $ptn->kode_ptn]) }}" method="POST"
                    enctype="multipart/form-data" class="flex items-center gap-2">
                    @csrf
                    <input type="file" name="file" accept=".xlsx, .xls, .csv"
                        class="border px-3 py-2 rounded w-64 text-sm">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded shadow text-sm flex items-center gap-2">
                        <i class="fas fa-file-import"></i> Import Excel
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto mt-6">
                <table class="w-full border-collapse text-sm">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="p-3 text-center">No</th>
                            <th class="p-3 text-center">Kode Jurusan</th>
                            <th class="p-3 text-center">Jenjang</th>
                            <th class="p-3 text-center">Nama Jurusan</th>
                            <th class="p-3 text-center">Nilai Jurusan</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jurusans as $key => $jurusan)
                            <tr class="hover:bg-gray-50 border-b">
                                <td class="p-3 text-center">{{ $key + 1 }}</td>
                                <td class="p-3 text-center font-mono text-blue-600">{{ $jurusan->kode_jurusan }}</td>
                                <td class="p-3 text-center">
                                    <span class="inline-block px-3 py-1 text-xs bg-indigo-100 text-indigo-700 rounded-full">
                                        {{ $jurusan->jenjang }}
                                    </span>
                                </td>
                                <td class="p-3 text-center font-medium text-blue-600">{{ $jurusan->nama_jurusan }}</td>
                                <td class="p-3 text-center font-medium text-blue-600">{{ $jurusan->nilai_jurusan }}</td>
                                <td class="p-3 text-center space-x-2">
                                    <a href="{{ route('jurusan.edit', ['kode_ptn' => $ptn->kode_ptn, 'kode_jurusan' => $jurusan->kode_jurusan]) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs shadow">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form
                                        action="{{ route('jurusan.destroy', ['kode_ptn' => $ptn->kode_ptn, 'kode_jurusan' => $jurusan->kode_jurusan]) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Yakin ingin menghapus jurusan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-6">Tidak ada data jurusan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $jurusans->withQueryString()->links() }}
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
