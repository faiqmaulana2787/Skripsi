@extends('layouts.admin')

@section('title', 'Daftar Hasil Ujian')

@section('content')
    <div class="container">
        <h1>Daftar Hasil Ujian</h1>
        <a href="{{ route('admin.hasil.list_siswa', $ujianId) }}" class="btn btn-primary mb-3">Lihat Daftar Siswa</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Kategori</th>
                    <th>Jumlah Benar</th>
                    <th>Jumlah Salah</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $h)
                    <tr>
                        <td>{{ $h->user->name }}</td>
                        <td>{{ $h->kategori->nama }}</td>
                        <td>{{ $h->total_benar }}</td>
                        <td>{{ $h->total_salah }}</td>
                        <td>{{ number_format($h->nilai, 2) }}</td>
                        <td>
                            <a href="{{ route('admin.hasil.detail_siswa', ['ujianId' => $ujianId, 'userId' => $h->user_id]) }}"
                                class="btn btn-sm btn-info">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
