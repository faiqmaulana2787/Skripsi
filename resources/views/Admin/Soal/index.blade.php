@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
                Daftar Soal - {{ $kategori->nama_kategori }}
            </h2>
            <p class="text-center text-gray-500 mb-6">
                Kelola pertanyaan, pilihan jawaban, dan gambar soal untuk kategori ini.
            </p>

            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <a href="{{ route('kategori.index', ['ujian_id' => $kategori->ujian_id]) }}"
                    class="inline-flex items-center gap-2 text-sm bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg shadow transition">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <form
                    action="{{ route('soal.import', ['ujian_id' => $kategori->ujian_id, 'kategori_id' => $kategori->id]) }}"
                    method="POST" enctype="multipart/form-data" class="flex items-center gap-3">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.xls,.csv"
                        class="text-sm border border-gray-300 px-3 py-1.5 rounded-lg shadow-sm w-60 focus:ring focus:ring-blue-200">
                    <button type="submit"
                        class="inline-flex items-center gap-2 text-sm bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
                        <i class="fas fa-file-import"></i> Import
                    </button>
                </form>

                <a href="{{ route('soal.create', ['ujian_id' => $kategori->ujian_id, 'kategori_id' => $kategori->id]) }}"
                    class="inline-flex items-center gap-2 text-sm bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                    <i class="fas fa-plus"></i> Tambah Soal
                </a>
            </div>

            <div class="overflow-x-auto rounded-md shadow-inner">
                <table class="min-w-full bg-white text-sm border border-gray-200">
                    <thead class="bg-gray-100 text-gray-700 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="p-3 text-center whitespace-nowrap">No</th>
                            <th class="p-3 text-center whitespace-nowrap">Pertanyaan</th>
                            <th class="p-3 text-center whitespace-nowrap">Nilai</th>
                            <th class="p-3 text-center whitespace-nowrap">Gambar</th>
                            <th class="p-3 text-center whitespace-nowrap">A</th>
                            <th class="p-3 text-center whitespace-nowrap">B</th>
                            <th class="p-3 text-center whitespace-nowrap">C</th>
                            <th class="p-3 text-center whitespace-nowrap">D</th>
                            <th class="p-3 text-center whitespace-nowrap">E</th>
                            <th class="p-3 text-center whitespace-nowrap">Jawaban</th>
                            <th class="p-3 text-center whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($soals as $index => $soal)
                            <tr class="hover:bg-gray-50 border-b text-center">
                                <td class="p-3">{{ $index + 1 }}</td>
                                <td class="p-3 max-w-xs truncate">{{ $soal->pertanyaan }}</td>
                                <td class="p-3 max-w-xs truncate">{{ $soal->nilai_soal }}</td>
                                <td class="p-3">
                                    @if ($soal->gambar)
                                        <img src="{{ asset('storage/' . $soal->gambar) }}" alt="Gambar"
                                            class="w-16 h-16 object-cover rounded shadow mx-auto">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="p-3">{{ $soal->opsi_a }}</td>
                                <td class="p-3">{{ $soal->opsi_b }}</td>
                                <td class="p-3">{{ $soal->opsi_c }}</td>
                                <td class="p-3">{{ $soal->opsi_d }}</td>
                                <td class="p-3">{{ $soal->opsi_e }}</td>
                                <td class="p-3 font-bold text-blue-600">{{ strtoupper($soal->jawaban_benar) }}</td>
                                <td class="p-3">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('soal.edit', ['ujian_id' => $kategori->ujian_id, 'kategori_id' => $kategori->id, 'soal_id' => $soal->id]) }}"
                                            class="text-xs bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded shadow flex items-center gap-1 transition">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form
                                            action="{{ route('soal.destroy', ['ujian_id' => $kategori->ujian_id, 'kategori_id' => $kategori->id, 'soal_id' => $soal->id]) }}"
                                            method="POST" onsubmit="return confirm('Hapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-xs bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded shadow flex items-center gap-1 transition">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-gray-400 py-6">
                                    Belum ada soal yang ditambahkan.
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
