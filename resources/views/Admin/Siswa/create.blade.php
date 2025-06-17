@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Tambah Akun Siswa</h2>

        <form action="{{ route('siswa.store') }}" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                    <strong>Oops! Ada kesalahan:</strong>
                    <ul class="mt-2 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="mb-4">
                <label class="block font-semibold text-gray-700">No Peserta</label>
                <input type="text" name="no_peserta"
                    class="w-full border-gray-300 border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Nama</label>
                <input type="text" name="nama"
                    class="w-full border-gray-300 border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Asal Sekolah</label>
                <input type="text" name="asal_sekolah"
                    class="w-full border-gray-300 border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Kelas</label>
                <select name="kelas" id="kelas"
                    class="w-full border-gray-300 border p-2 rounded focus:ring focus:ring-blue-300" required>
                    <option value="">Pilih Kelas</option>
                    @foreach (['VII', 'VII', 'IX', 'X', 'XI', 'XII'] as $kelas)
                        <option value="{{ $kelas }}" {{ old('kelas') == $kelas ? 'selected' : '' }}>
                            {{ $kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div id="ptn_fields" class="mb-4 hidden">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="mb-4">
                        <label class="block font-semibold">PTN {{ $i }}</label>
                        <select name="kode_ptn_{{ $i }}" id="kode_ptn_{{ $i }}"
                            class="w-full border p-2 rounded">
                            <option value="">Pilih PTN</option>
                            @foreach ($p_t_n_s as $ptn)
                                <option value="{{ $ptn->kode_ptn }}">{{ $ptn->nama_ptn }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Jurusan PTN {{ $i }}</label>
                        <select name="kode_jurusan_{{ $i }}" id="kode_jurusan_{{ $i }}"
                            class="w-full border p-2 rounded bg-white">
                            <option value="">Pilih Jurusan</option>
                            {{-- Akan diisi via JS --}}
                        </select>
                    </div>
                @endfor
            </div>

            <div class="mb-4">
                <label class="block font-semibold text-gray-700">Password</label>
                <input type="password" name="password"
                    class="w-full border-gray-300 border p-2 rounded focus:ring focus:ring-blue-300" required>
            </div>

            <div class="w-full flex justify-between items-center mt-4">
                <a href="{{ route('siswa.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-4">Kembali</a>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>

        </form>
    </div>

    <script>
        const kelasSelect = document.getElementById('kelas');
        const ptnFields = document.getElementById('ptn_fields');
        const semuaJurusan = @json($jurusans);

        kelasSelect.addEventListener('change', function() {
            if (this.value === 'XII') {
                ptnFields.classList.remove('hidden');
            } else {
                ptnFields.classList.add('hidden');
                // Reset semua dropdown PTN dan jurusan
                for (let i = 1; i <= 4; i++) {
                    document.getElementById(`kode_ptn_${i}`).value = '';
                    const jurusanDropdown = document.getElementById(`kode_jurusan_${i}`);
                    jurusanDropdown.innerHTML = '<option value="">Pilih Jurusan</option>';
                }
            }
        });

        // Fungsi filter jurusan per PTN
        function updateJurusanDropdown(ptnSelectId, jurusanSelectId) {
            const ptnSelect = document.getElementById(ptnSelectId);
            const jurusanSelect = document.getElementById(jurusanSelectId);

            ptnSelect.addEventListener('change', function() {
                const selectedKodePTN = this.value;
                const filteredJurusan = semuaJurusan.filter(j => j.kode_ptn.toString() === selectedKodePTN);

                jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';
                filteredJurusan.forEach(j => {
                    const option = document.createElement('option');
                    option.value = j.kode_jurusan;
                    option.textContent = j.nama_jurusan;
                    jurusanSelect.appendChild(option);
                });
            });
        }

        // Aktifkan fungsi filter untuk PTN 1 - 4
        for (let i = 1; i <= 4; i++) {
            updateJurusanDropdown(`kode_ptn_${i}`, `kode_jurusan_${i}`);
        }
    </script>
@endsection
