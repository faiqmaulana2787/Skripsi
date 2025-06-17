<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Konsultasi SNBP 2025</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 40px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .header img {
            width: 80px;
            height: auto;
            margin-bottom: 8px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .sub-title {
            font-size: 14px;
            color: #555;
        }

        .section {
            margin-bottom: 25px;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            margin-top: 40px;
            border-top: 1px dashed #999;
            padding-top: 10px;
            color: #777;
        }

        .highlight {
            font-weight: bold;
            color: #2c7a7b;
        }

        .status-lulus {
            color: green;
            font-weight: bold;
        }

        .status-tidak-lulus {
            color: red;
            font-weight: bold;
        }

        .keterangan {
            margin-top: 8px;
            font-size: 11px;
            color: #444;
        }

        .keterangan span {
            font-weight: bold;
        }
    </style>
</head>

<body>

    {{-- Header --}}
    <div class="header">
        <img src="{{ public_path('img/logo_ecc.png') }}" alt="Logo ECC">
        <div class="title">Hasil Konsultasi SNBP 2025</div>
        <div class="sub-title">BIMBEL ECC NGAWI</div>
    </div>

    {{-- Data Siswa --}}
    <div class="section">
        <div class="section-title">Informasi Siswa</div>
        <p><strong>Nama:</strong> {{ $konsultasi->user->nama }}</p>
        <p><strong>Asal Sekolah:</strong> {{ $konsultasi->user->siswa->asal_sekolah ?? '-' }}</p>
    </div>

    {{-- Nilai Rapor --}}
    <div class="section">
        <div class="section-title">Nilai Rapor Semester 1–5</div>
        <table>
            <thead>
                <tr>
                    @for ($i = 1; $i <= 5; $i++)
                        <th>Semester {{ $i }}</th>
                    @endfor
                    <th>Rata-rata</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @for ($i = 1; $i <= 5; $i++)
                        <td>{{ $konsultasi->{'nilai_semester_' . $i} }}</td>
                    @endfor
                    @php
                        $rata_rata =
                            ($konsultasi->nilai_semester_1 +
                                $konsultasi->nilai_semester_2 +
                                $konsultasi->nilai_semester_3 +
                                $konsultasi->nilai_semester_4 +
                                $konsultasi->nilai_semester_5) /
                            5;
                    @endphp
                    <td class="highlight">{{ number_format($rata_rata, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Pilihan PTN & Evaluasi --}}
    <div class="section">
        <div class="section-title">Evaluasi Pilihan PTN</div>
        @for ($i = 1; $i <= 2; $i++)
            @php
                $namaPtn = $konsultasi->{'ptn_' . $i}->nama_ptn ?? '-';
                $jurusan = $konsultasi->user->siswa->{'jurusan' . $i}->nama_jurusan ?? '-';
                $nilai_jurusan = $konsultasi->user->siswa->{'jurusan' . $i}->nilai_jurusan ?? null;
            @endphp
            <p>
                <strong>PTN {{ $i }}:</strong> {{ $namaPtn }}<br>
                <strong>Jurusan:</strong> {{ $jurusan }}<br>
                <strong>Nilai Jurusan:</strong> {{ $nilai_jurusan ?? '-' }}
            </p>

            {{-- Keterangan --}}
            <div class="keterangan">
                <span>Keterangan:</span><br>
                @if ($nilai_jurusan !== null)
                    @if ($rata_rata >= $nilai_jurusan)
                        <span class="status-lulus">Selamat, Anda lulus!</span>
                        Nilai rata-rata Anda ({{ number_format($rata_rata, 2) }}) lebih tinggi dari nilai jurusan
                        ({{ $nilai_jurusan }}).
                    @else
                        <span class="status-tidak-lulus">Maaf, Anda belum lulus.</span>
                        Nilai rata-rata Anda ({{ number_format($rata_rata, 2) }}) masih kurang dari nilai jurusan
                        ({{ $nilai_jurusan }}).
                    @endif
                @else
                    <span class="text-gray-500">Nilai jurusan belum tersedia.</span>
                @endif
            </div>
        @endfor
    </div>

    {{-- Kesimpulan --}}
    <div class="section">
        <div class="section-title">Kesimpulan</div>
        @php
            $prediksi = null;
            for ($i = 1; $i <= 2; $i++) {
                $nilai_jurusan = $konsultasi->siswas->{'jurusan' . $i}->nilai_jurusan ?? null;
                $nama_jurusan = $konsultasi->siswas->{'jurusan' . $i}->nama_jurusan ?? null;
                if ($nilai_jurusan !== null && $rata_rata >= $nilai_jurusan) {
                    $prediksi = $nama_jurusan;
                    break;
                }
            }
        @endphp

        @if ($prediksi)
            <p>
                Berdasarkan analisis nilai rapor Anda, Anda diprediksi
                <strong class="highlight">masuk ke jurusan {{ $prediksi }}</strong>.
                Hasil ini bersifat prediksi dan tidak menjamin kelulusan karena keputusan akhir berada di tangan panitia
                seleksi nasional.
            </p>
        @else
            <p>
                Berdasarkan analisis nilai rapor Anda, <strong class="highlight">belum ada jurusan yang bisa diprediksi
                    akan Anda masuki</strong>,
                karena nilai rata-rata Anda masih di bawah ambang batas dari kedua jurusan yang dipilih.
            </p>
        @endif
    </div>

    {{-- Footer --}}
    <div class="footer">
        Dokumen ini dicetak otomatis oleh sistem ECC. Informasi bersifat prediktif berdasarkan data yang diberikan
        siswa.
    </div>

</body>

</html>
