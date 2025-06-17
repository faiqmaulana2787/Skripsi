@extends('layouts.admin')

@section('title', 'Detail Hasil Ujian Siswa')

@section('content')
    <div class="container">
        <h1>Hasil Ujian Siswa: {{ $hasil->first()->user->name ?? '' }}</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Soal</th>
                    <th>Jawaban Benar?</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $h)
                    <tr>
                        <td>{{ $h->kategori->nama }}</td>
                        <td>{{ $h->soal->pertanyaan }}</td>
                        <td>
                            @if ($h->total_benar)
                                ✓
                            @else
                                ✗
                            @endif
                        </td>
                        <td>{{ number_format($h->nilai, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
