@extends('layouts.admin')

@section('title', 'Daftar Konsultasi')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-2">
                Daftar Konsultasi Siswa
            </h2>
            <p class="text-center text-gray-500 mb-6">
                Data hasil nilai siswa dan kelola konsultasi.
            </p>

            <div class="flex justify-center mb-6">
                <form method="GET" action="{{ route('konsultasi.index') }}" class="flex items-center gap-3 w-full max-w-lg">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="flex-grow border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm"
                        placeholder="Cari Nama Siswa...">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm min-w-max">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="p-3 text-center">No</th>
                            <th class="p-3 text-center">No Peserta</th>
                            <th class="p-3 text-center">Nama Siswa</th>
                            <th class="p-3 text-center">Asal Sekolah</th>
                            <th class="p-3 text-center">Kelas</th>
                            <th class="p-3 text-center">Rata-Rata</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($konsultasis as $konsultasi)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 text-center font-mono">{{ $loop->iteration }}</td>
                                <td class="p-3 text-blue-600 text-center font-mono">{{ $konsultasi->user->no_peserta }}
                                </td>
                                <td class="p-3 text-blue-600 text-center font-medium">{{ $konsultasi->user->nama }}</td>
                                <td class="p-3 text-blue-600 text-center font-medium">
                                    {{ $konsultasi->user->siswa->asal_sekolah }}
                                </td>
                                <td class="p-3 text-blue-600 text-center font-medium">{{ $konsultasi->user->siswa->kelas }}
                                </td>
                                <td class="p-3 text-blue-600 text-center font-semibold">
                                    {{ number_format(
                                        ($konsultasi->nilai_semester_1 +
                                            $konsultasi->nilai_semester_2 +
                                            $konsultasi->nilai_semester_3 +
                                            $konsultasi->nilai_semester_4 +
                                            $konsultasi->nilai_semester_5) /
                                            5,
                                        2,
                                    ) }}
                                </td>
                                <td class="p-3">
                                    <div class="flex justify-center gap-2 flex-wrap">
                                        <a href="{{ route('konsultasi.show', $konsultasi->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <form action="{{ route('konsultasi.destroy', $konsultasi->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs flex items-center gap-1">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-500">
                                    Belum ada data konsultasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $konsultasis->withQueryString()->links() }}
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
