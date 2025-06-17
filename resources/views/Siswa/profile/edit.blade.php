@extends('layouts.siswa')

@section('content')
    <div class="container mx-auto px-6 mt-10">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
            ✏️ Edit Profil Siswa
        </h2>

        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST"
            class="bg-white p-8 rounded-2xl shadow-lg max-w-4xl mx-auto space-y-8">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg shadow-md">
                    <strong class="block font-semibold mb-2">Terjadi kesalahan:</strong>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-profile-field label="No Peserta" name="no_peserta" :value="old('no_peserta', $siswa->user->no_peserta)" readonly />
                <x-profile-field label="Nama" name="nama" :value="old('nama', $siswa->user->nama)" required />
                <x-profile-field label="Asal Sekolah" name="asal_sekolah" :value="old('asal_sekolah', $siswa->asal_sekolah)" required />
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                    <select name="kelas" id="kelas"
                        class="w-full border-gray-300 border p-3 rounded-lg focus:ring focus:ring-blue-300" required>
                        <option value="">Pilih Kelas</option>
                        @foreach (['VII', 'VIII', 'IX', 'X', 'XI', 'XII'] as $kelas)
                            <option value="{{ $kelas }}"
                                {{ old('kelas', $siswa->kelas) == $kelas ? 'selected' : '' }}>
                                {{ $kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="ptn_fields" class="{{ $siswa->kelas == 'XII' ? '' : 'hidden' }}">
                <h3 class="text-xl font-semibold mt-8 mb-4 text-gray-700 border-b pb-2">Pilihan PTN & Jurusan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for ($i = 1; $i <= 4; $i++)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">PTN {{ $i }}</label>
                            <select name="kode_ptn_{{ $i }}" id="kode_ptn_{{ $i }}"
                                class="w-full border-gray-300 border p-3 rounded-lg bg-white focus:ring focus:ring-blue-300">
                                <option value="">Pilih PTN</option>
                                @foreach ($p_t_n_s as $ptn)
                                    <option value="{{ $ptn->kode_ptn }}"
                                        {{ old("kode_ptn_$i", $siswa["kode_ptn_$i"]) == $ptn->kode_ptn ? 'selected' : '' }}>
                                        {{ $ptn->nama_ptn }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jurusan PTN
                                {{ $i }}</label>
                            <select name="kode_jurusan_{{ $i }}" id="kode_jurusan_{{ $i }}"
                                class="w-full border-gray-300 border p-3 rounded-lg bg-white focus:ring focus:ring-blue-300">
                                <option value="">Pilih Jurusan</option>
                                {{-- Diisi via JS --}}
                            </select>
                        </div>
                    @endfor
                </div>
            </div>

            <x-profile-field label="Password (Kosongkan jika tidak diubah)" name="password" type="password" />

            <div class="flex justify-between mt-10">
                <a href="{{ route('siswa.profile') }}"
                    class="inline-flex items-center gap-2 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition shadow">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>

    <script>
        const kelasSelect = document.getElementById('kelas');
        const ptnFields = document.getElementById('ptn_fields');
        const semuaJurusan = @json($jurusans);

        function showOrHidePTNFields() {
            ptnFields.classList.toggle('hidden', kelasSelect.value !== 'XII');
        }

        kelasSelect.addEventListener('change', showOrHidePTNFields);
        showOrHidePTNFields();

        function updateJurusanDropdown(ptnSelectId, jurusanSelectId, selectedKodeJurusan = '') {
            const ptnSelect = document.getElementById(ptnSelectId);
            const jurusanSelect = document.getElementById(jurusanSelectId);

            function renderOptions() {
                const selectedKodePTN = ptnSelect.value;
                const filteredJurusan = semuaJurusan.filter(j => j.kode_ptn.toString() === selectedKodePTN);
                jurusanSelect.innerHTML = '<option value="">Pilih Jurusan</option>';
                filteredJurusan.forEach(j => {
                    const option = document.createElement('option');
                    option.value = j.kode_jurusan;
                    option.textContent = j.nama_jurusan;
                    if (j.kode_jurusan == selectedKodeJurusan) option.selected = true;
                    jurusanSelect.appendChild(option);
                });
            }

            ptnSelect.addEventListener('change', renderOptions);
            renderOptions();
        }

        @for ($i = 1; $i <= 4; $i++)
            updateJurusanDropdown("kode_ptn_{{ $i }}", "kode_jurusan_{{ $i }}",
                "{{ old("kode_jurusan_$i", $siswa["kode_jurusan_$i"]) }}");
        @endfor
    </script>
@endsection
