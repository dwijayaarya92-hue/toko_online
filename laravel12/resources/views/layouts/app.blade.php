<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Saya</title>
    <!-- TAMBAHKAN LINK BOOTSTRAP INI YA SAYANG -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="/toko">TokoSaya</a>
            <div class="navbar-nav">
                @if(auth()->check())
                    @if(auth()->user()->role == 'admin')
                        <a class="nav-link" href="/admin">Admin</a>
                        <a class="nav-link" href="/hrd">HRD</a>
                    @endif
                    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'hrd')
                        <a class="nav-link" href="/pegawai">Pegawai</a>
                    @endif
                    <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- FORM LOGOUT -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <!-- JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>