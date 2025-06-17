@extends('layouts.ujian')

@section('title', 'Education Center Class')

@section('content')
    <form id="formUjian" action="{{ route('jawaban.submit', $ujian->id) }}" method="POST">
        @csrf

        <div x-data="ujianData(
            {{ $ujian->kategoris->count() }},
            {{ json_encode($ujian->kategoris->pluck('durasi')) }}
        )" x-init="startTimer()" class="space-y-8">

            <!-- Header Timer & Kategori -->
            <div class="flex justify-between items-center bg-white p-4 rounded-xl shadow-md border border-gray-200">
                <div class="text-blue-600 font-semibold text-lg">
                    Kategori <span x-text="kategoriIndex + 1"></span> dari <span x-text="totalKategori"></span>
                </div>
                <div class="text-red-600 font-semibold text-right text-sm md:text-base">
                    ⏰ Sisa Waktu: <span x-text="formattedTime" class="font-bold text-lg"></span>
                </div>
            </div>

            @foreach ($ujian->kategoris as $kategoriIndex => $kategori)
                <div x-show="kategoriIndex === {{ $kategoriIndex }}" x-data="{ soalIndex: 0, totalSoal: {{ $kategori->soals->count() }} }"
                    class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 space-y-8">

                    <h2 class="text-2xl text-center font-bold text-blue-700 border-b pb-2">
                        {{ $kategori->nama_kategori }}
                    </h2>

                    @foreach ($kategori->soals as $soalIndex => $soal)
                        <div x-show="soalIndex === {{ $soalIndex }}" class="space-y-5">
                            <div>
                                <p class="text-lg font-semibold">
                                    {{ $loop->iteration }}. {{ $soal->pertanyaan }}
                                </p>

                                @if ($soal->gambar)
                                    <div class="flex justify-center mt-4">
                                        <img src="{{ asset('storage/' . $soal->gambar) }}" alt="Gambar Soal"
                                            class="rounded-lg shadow-md max-w-md w-full">
                                    </div>
                                @endif
                            </div>

                            @php
                                $opsiJawaban = [
                                    'A' => $soal->opsi_a,
                                    'B' => $soal->opsi_b,
                                    'C' => $soal->opsi_c,
                                    'D' => $soal->opsi_d,
                                    'E' => $soal->opsi_e,
                                ];
                            @endphp

                            <div class="space-y-3">
                                @foreach ($opsiJawaban as $key => $opsi)
                                    <label
                                        class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                                        <input type="radio" name="jawaban[{{ $soal->id }}]"
                                            value="{{ $key }}" class="accent-blue-600 w-5 h-5" required
                                            x-on:change="completed[{{ $kategoriIndex }} + '-' + {{ $soalIndex }}] = true">
                                        <span class="text-base font-medium">{{ $key }}.
                                            {{ $opsi }}</span>
                                    </label>
                                @endforeach
                            </div>

                            <!-- Navigasi Soal -->
                            <div class="flex justify-between mt-6">
                                <button type="button"
                                    class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg text-sm md:text-base transition"
                                    x-on:click="soalIndex--" x-bind:disabled="soalIndex === 0">
                                    ← Sebelumnya
                                </button>

                                <button type="button"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm md:text-base transition"
                                    x-bind:class="{ 'hidden': !completed[{{ $kategoriIndex }} + '-' + {{ $soalIndex }}] }"
                                    x-on:click="soalIndex++" x-bind:disabled="soalIndex >= totalSoal - 1">
                                    Selanjutnya →
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <!-- Navigasi Kategori -->
                    <div class="flex justify-center mt-8">
                        <template x-if="soalIndex === totalSoal - 1 && kategoriIndex < totalKategori - 1">
                            <button type="button"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl text-base font-semibold shadow transition"
                                x-on:click="nextKategori()">
                                Lanjut ke Kategori Berikutnya
                            </button>
                        </template>

                        <template x-if="soalIndex === totalSoal - 1 && kategoriIndex === totalKategori - 1">
                            <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl text-base font-semibold shadow transition">
                                Selesai & Kirim Jawaban
                            </button>
                        </template>
                    </div>
                </div>
            @endforeach
        </div>
    </form>

    <script>
        function ujianData(totalKategori, daftarDurasi) {
            return {
                kategoriIndex: 0,
                completed: {},
                totalKategori,
                daftarDurasi,
                waktu: 0,
                formattedTime: '',
                timer: null,

                startTimer() {
                    this.waktu = this.daftarDurasi[this.kategoriIndex] * 60;
                    this.updateTimeDisplay();

                    if (this.timer) clearInterval(this.timer);

                    this.timer = setInterval(() => {
                        if (this.waktu <= 0) {
                            clearInterval(this.timer);
                            this.handleTimeout();
                        } else {
                            this.waktu--;
                            this.updateTimeDisplay();
                        }
                    }, 1000);
                },

                updateTimeDisplay() {
                    const minutes = Math.floor(this.waktu / 60);
                    const seconds = this.waktu % 60;
                    this.formattedTime = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                },

                nextKategori() {
                    if (this.kategoriIndex < this.totalKategori - 1) {
                        this.kategoriIndex++;
                        this.startTimer();
                    }
                },

                handleTimeout() {
                    if (this.kategoriIndex < this.totalKategori - 1) {
                        this.kategoriIndex++;
                        this.startTimer();
                    } else {
                        document.getElementById('formUjian').submit();
                    }
                }
            };
        }
    </script>
@endsection
