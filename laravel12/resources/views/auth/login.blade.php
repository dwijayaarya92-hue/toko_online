<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Kita</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="text-center fw-bold mb-4">🔑 Login Toko</h3>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label text-secondary">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required autofocus>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label text-secondary">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <!-- Tombol Masuk -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Masuk</button>
                        </div>
                    </form>

                    <!-- Link Daftar -->
                    <div class="text-center mt-3">
                        <p>Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-decoration-none">Daftar sekarang</a>
                        </p>
                    </div>

                    <!-- Tombol Sosial Media -->
                    <hr class="my-4">
                    <p class="text-center text-muted mb-3">Atau masuk dengan:</p>
                    <div class="d-grid gap-2">
                        <a href="{{ url('/auth/google') }}" class="btn btn-outline-danger">
                            <i class="fab fa-google"></i> Login dengan Google
                        </a>
                        <a href="{{ url('/auth/facebook') }}" class="btn btn-outline-primary">
                            <i class="fab fa-facebook"></i> Login dengan Facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>