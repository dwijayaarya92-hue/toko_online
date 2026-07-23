<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-success text-white p-3">
                        <h4 class="mb-0 text-center">➕ Tambah Produk Baru</h4>
                    </div>
                    <div class="card-body p-4">

                        <form action="{{ route('toko.produk.simpan') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label text-muted fw-bold">Nama Produk:</label>
                                <input type="text" name="name" class="form-control" placeholder="Contoh: Es Teh Manis" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted fw-bold">Harga (Rp):</label>
                                <input type="number" name="price" class="form-control" placeholder="Contoh: 5000" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted fw-bold">Stok Awal:</label>
                                <input type="number" name="stock" class="form-control" placeholder="Contoh: 100" required>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-success shadow-sm fw-bold">Simpan Produk</button>
                                <a href="{{ route('toko.index') }}" class="btn btn-outline-secondary fw-bold">Kembali ke Kasir</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>