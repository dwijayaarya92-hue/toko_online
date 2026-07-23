<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pegawai Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Card Form -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-success text-white p-3">
                        <h4 class="mb-0 text-center">➕ Tambah Pegawai Baru</h4>
                    </div>
                    <div class="card-body p-4">

                        <!-- Menampilkan Eror Validasi Jika Ada -->
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pegawai.store') }}" method="POST">
                            @csrf

                            <!-- Nama Pegawai -->
                            <div class="mb-3">
                                <label class="form-label fw-bold text-secondary">Nama Lengkap</label>
                                <input type="text" name="nama_pegawai" class="form-control" placeholder="Contoh: Budi Santoso" value="{{ old('nama_pegawai') }}" required>
                            </div>

                            <div class="row">
                                <!-- Jenis Kelamin -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-secondary">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <!-- Umur -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-secondary">Umur (Tahun)</label>
                                    <input type="number" name="umur" class="form-control" placeholder="Contoh: 25" min="17" value="{{ old('umur') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Tempat Lahir -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-secondary">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control" placeholder="Contoh: Jakarta" value="{{ old('tempat_lahir') }}" required>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-secondary">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-secondary">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Tuliskan alamat rumah pegawai..." required>{{ old('alamat') }}</textarea>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success fw-bold">💾 Simpan Data Pegawai</button>
                                <a href="{{ route('pegawai.index') }}" class="btn btn-outline-secondary fw-bold">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>