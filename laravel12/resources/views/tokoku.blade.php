@extends('layouts.app')

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light mb-4 shadow-sm bg-white">
    <div class="container">
        <a class="navbar-brand fw-bold text-danger" href="/toko">{{ session('nama_toko', 'Telkomsel Indonesia') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item"><a class="nav-link fw-semibold text-dark px-2" href="/toko/produk">Paket Orbit</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold text-dark px-2" href="/toko/profil">Telkomsel POIN</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold text-dark px-2" href="/toko/chat">Bantuan</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <!-- Sidebar Menu Perusahaan (DIJAMIN BISA DIKLIK) -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <h5 class="fw-bold mb-3 text-secondary" style="font-size: 1rem;">Menu Perusahaan</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="/toko/profil" class="btn btn-light text-dark fw-semibold text-start rounded-3 py-2 px-3 border-0 shadow-sm">
                        👤 Profil
                    </a>
                    <a href="/toko/chat" class="btn btn-light text-dark fw-semibold text-start rounded-3 py-2 px-3 border-0 shadow-sm">
                        💬 @if(auth()->check() && auth()->user()->role == 'admin') Chat Pembeli @else Chat Admin @endif
                    </a>
                </div>
            </div>
        </div>

        <!-- Konten Utama Beranda -->
        <div class="col-md-9">
            <div class="card border-0 shadow-lg rounded-4 text-white p-4 mb-4" style="background: linear-gradient(135deg, #ec1c24 0%, #b30000 100%);">
                <h1 class="fw-bold display-6 mb-2">{{ session('nama_toko', 'Telkomsel Indonesia') }}</h1>
                <p class="mb-3" style="opacity: 0.9;">
                    {{ session('slogan', 'Penyedia layanan telekomunikasi digital terdepan di Indonesia.') }}
                </p>
                <div class="d-flex flex-wrap gap-3" style="font-size: 0.9rem;">
                    <div>📞 <strong>Kontak:</strong> {{ session('kontak', '188') }}</div>
                    <div>📍 <strong>Alamat:</strong> {{ session('alamat', 'Jakarta Selatan') }}</div>
                </div>
            </div>

            <!-- Katalog Produk -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark m-0">📦 Katalog Produk & Perdana</h4>
                
                @if(auth()->check() && auth()->user()->role == 'admin')
                    <a href="/toko/produk" class="btn btn-danger btn-sm fw-bold rounded-pill px-3">+ Kelola Produk</a>
                @endif
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
                        <div class="bg-light rounded-3 text-center py-4 mb-3 text-muted">
                            🖼️ Foto Produk
                        </div>
                        <h5 class="fw-bold text-dark">Kartu Perdana Telkomsel</h5>
                        <p class="text-danger fw-bold fs-5 mb-2">Rp 25.000</p>
                        <p class="text-muted small mb-0">Kuota internet besar langsung aktif.</p>
                        
                        <!-- Tombol Beli hanya muncul jika BUKAN admin -->
                        @if(!auth()->check() || auth()->user()->role != 'admin')
                            <button class="btn btn-outline-danger btn-sm w-100 fw-bold rounded-pill mt-3">Beli Sekarang</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection