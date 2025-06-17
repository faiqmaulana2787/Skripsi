@extends('layouts.admin')

@section('title', 'List Siswa Ujian')

@section('content')
    <div class="container">
        <h1>List Siswa Ujian</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Siswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswaList as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->user->name }}</td>
                        <td>
                            <a href="{{ route('admin.hasil.detail_siswa', ['ujianId' => $ujianId, 'userId' => $siswa->user_id]) }}"
                                class="btn btn-sm btn-primary">Lihat Hasil</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
