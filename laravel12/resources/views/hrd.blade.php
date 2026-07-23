@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Tombol Kembali dan Judul -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm mb-2">&larr; Kembali</a>
            <h2>Data Karyawan</h2>
        </div>
        <a href="{{ route('hrd.create') }}" class="btn btn-primary">Tambah Karyawan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $emp)
            <tr>
                <td>{{ $emp->nama }}</td>
                <td>{{ $emp->jabatan }}</td>
                <td>{{ $emp->email }}</td>
                <td>
                    <button class="btn btn-sm btn-warning">Edit</button>
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data karyawan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection