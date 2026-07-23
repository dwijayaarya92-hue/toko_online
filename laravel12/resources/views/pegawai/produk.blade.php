<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="text-success mb-1">📦 Daftar Produk Toko</h2>
                            <p class="text-muted mb-0">Kelola stok dan harga produk jualanmu di sini.</p>
                        </div>
                        <a href="{{ route('toko.index') }}" class="btn btn-secondary btn-sm shadow-sm">&larr; Kembali ke Toko</a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Tambah Produk -->
                    <div class="card bg-white border shadow-sm p-3 mb-4 rounded-3">
                        <h5 class="mb-3 text-success">➕ Tambah Produk Baru</h5>
                        <form action="{{ route('toko.produk.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Produk" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="harga" class="form-control" placeholder="Harga (Cth: 50.000)" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="stok" class="form-control" placeholder="Stok" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success w-100 fw-bold">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Daftar Produk -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th style="width: 22%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($produks as $index => $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p['nama'] }}</td>
                                    <td>Rp {{ $p['harga'] }}</td>
                                    <td>{{ $p['stok'] }} pcs</td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button type="button" class="btn btn-sm btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#editModal{{ $index }}">
                                            ✏️ Edit
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $index }}">
                                            🗑️ Hapus
                                        </button>

                                        <!-- Modal Edit Produk -->
                                        <div class="modal fade" id="editModal{{ $index }}" tabindex="-1" aria-labelledby="editModalLabel{{ $index }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-warning text-dark">
                                                        <h5 class="modal-title fw-bold" id="editModalLabel{{ $index }}">✏️ Edit Produk</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('toko.produk.update', $index) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body py-4">
                                                            <div class="mb-3 text-start">
                                                                <label class="form-label fw-bold">Nama Produk</label>
                                                                <input type="text" name="nama" class="form-control" value="{{ $p['nama'] }}" required>
                                                            </div>
                                                            <div class="mb-3 text-start">
                                                                <label class="form-label fw-bold">Harga</label>
                                                                <input type="text" name="harga" class="form-control" value="{{ $p['harga'] }}" required>
                                                            </div>
                                                            <div class="mb-3 text-start">
                                                                <label class="form-label fw-bold">Stok</label>
                                                                <input type="number" name="stok" class="form-control" value="{{ $p['stok'] }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer bg-light justify-content-center">
                                                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-warning text-white px-4 fw-bold">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hapus Produk -->
                                        <div class="modal fade" id="deleteModal{{ $index }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $index }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-0 shadow">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $index }}">⚠️ Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center py-4">
                                                        <p class="fs-5 mb-1">Yakin ingin menghapus produk</p>
                                                        <strong class="text-danger fs-4">"{{ $p['nama'] }}"</strong>?
                                                        <p class="text-muted small mt-2">Data yang dihapus tidak bisa dikembalikan lagi.</p>
                                                    </div>
                                                    <div class="modal-footer bg-light justify-content-center">
                                                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                                        <form action="{{ route('toko.produk.delete', $index) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger px-4">Ya, Hapus!</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada produk yang ditambahkan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>