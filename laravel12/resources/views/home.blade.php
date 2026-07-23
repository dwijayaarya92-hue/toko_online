<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Kita</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Toko Kita</a>
        <div class="d-flex">
            <!-- Tombol Logout -->
            <a href="{{ route('logout') }}" class="btn btn-outline-light" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="fw-bold">Selamat Datang!</h3>
                    <p class="text-muted">Anda berhasil login ke dashboard Toko Kita.</p>
                    <hr>
                    
                    <!-- PENTING: Gunakan tag <a> agar bisa diklik sebagai link -->
                    <a href="{{ route('pegawai.index') }}" class="btn btn-primary me-2">Kelola Pegawai</a>
                    <a href="{{ route('toko.index') }}" class="btn btn-success">Buka Kasir</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>