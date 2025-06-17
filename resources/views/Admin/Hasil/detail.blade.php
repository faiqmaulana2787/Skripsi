@extends('layouts.admin')

@section('title', 'Detail Hasil Ujian')

@section('content')
    <div class="container">
        <h1>Detail Hasil Ujian - Admin View</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Kategori</th>
                    <th>Soal</th>
                    <th>Benar</th>
                    <th>Salah</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $h)
                    <tr>
                        <td>{{ $h->user->name }}</td>
                        <td>{{ $h->kategori->nama }}</td>
                        <td>{{ $h->soal->pertanyaan }}</td>
                        <td>{{ $h->total_benar }}</td>
                        <td>{{ $h->total_salah }}</td>
                        <td>{{ number_format($h->nilai, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
