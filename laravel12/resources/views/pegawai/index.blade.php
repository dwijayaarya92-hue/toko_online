<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Navigasi Menu Utama (Tombol Toko, Profil, Produk, Chat, & Pegawai) -->
            <div class="d-flex justify-content-center flex-wrap gap-2 mb-4">
                <a href="{{ route('toko.index') }}" class="btn btn-outline-primary fw-bold shadow-sm">🛒 Halaman Kasir</a>
                <a href="{{ route('pegawai.index') }}" class="btn btn-primary fw-bold shadow-sm">👥 Data Pegawai</a>
                <a href="{{ route('toko.profil') }}" class="btn btn-outline-success fw-bold shadow-sm">⚙️ Profil Toko</a>
                <a href="{{ route('toko.produk') }}" class="btn btn-outline-warning fw-bold shadow-sm">📦 Daftar Produk</a>
                <a href="{{ route('toko.chat') }}" class="btn btn-outline-info fw-bold shadow-sm">💬 Chat Pembeli</a>
            </div>

            <!-- TOMBOL KEMBALI -->
            <div class="mb-3">
                <a href="{{ route('toko.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                    &larr; Kembali
                </a>
            </div>

            <!-- Card Utama -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white p-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">👥 Data Pegawai Toko</h4>
                    
                    <!-- Tombol Tambah Saja di sini -->
                    <a href="{{ route('pegawai.create') }}" class="btn btn-sm btn-success fw-bold shadow-sm">
                        + Tambah Pegawai
                    </a>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-3">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Umur</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pegawai as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->jk }}</td>
                                    <td>{{ $p->umur }} Tahun</td>
                                    <td>{{ $p->ttl }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>
                                        <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">🗑️ Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada data pegawai.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>