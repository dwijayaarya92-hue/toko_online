@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Sidebar Menu -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <h5 class="fw-bold mb-3 text-secondary" style="font-size: 1rem;">Menu Perusahaan</h5>
                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a href="{{ route('toko.profil') }}" class="nav-link text-dark fw-semibold rounded-3 bg-light">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('toko.chat') }}" class="nav-link text-dark fw-semibold rounded-3">
                            @if(auth()->check() && auth()->user()->role == 'admin')
                                Chat Pembeli
                            @else
                                Chat Admin
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Konten Form Pengaturan Profil -->
        <div class="col-md-9">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h3 class="text-danger fw-bold mb-2">⚙️ Pengaturan Profil Perusahaan</h3>
                <p class="text-muted mb-4">Ubah informasi resmi perusahaan atau toko di sini.</p>

                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('toko.profil.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Perusahaan / Toko</label>
                        <input type="text" name="nama_toko" class="form-control" value="{{ session('nama_toko', 'Telkomsel Indonesia') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Slogan / Deskripsi Singkat</label>
                        <input type="text" name="slogan" class="form-control" value="{{ session('slogan', 'Penyedia layanan telekomunikasi digital terdepan di Indonesia.') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Layanan / Kontak</label>
                        <input type="text" name="kontak" class="form-control" value="{{ session('kontak', '188') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Kantor Pusat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ session('alamat', 'Jakarta Selatan') }}</textarea>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <button type="submit" class="btn btn-danger fw-bold px-4 py-2 rounded-pill">Simpan Perubahan</button>
                        <a href="{{ route('toko.index') }}" class="btn btn-outline-secondary px-3 py-2 rounded-pill">&larr; Kembali ke Beranda</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection