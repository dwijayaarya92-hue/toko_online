@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Header dengan Tombol Kembali di Samping TokoSaya -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('toko.index') }}" class="btn btn-outline-danger btn-sm fw-bold rounded-pill px-3">&larr; Kembali ke Beranda</a>
            <h4 class="fw-bold text-dark m-0">TokoSaya</h4>
        </div>
        <div>
            @auth
                <span class="text-muted small">Login sebagai: <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->role }})</span>
            @endauth
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Menu -->
        <div class="col-md-3 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3">
                <h5 class="fw-bold mb-3 text-secondary" style="font-size: 1rem;">Menu Perusahaan</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('toko.profil') }}" class="btn btn-light text-dark fw-semibold text-start rounded-3 py-2 px-3 border-0 shadow-sm">
                        👤 Profil
                    </a>
                    <a href="{{ route('toko.chat') }}" class="btn btn-danger text-white fw-semibold text-start rounded-3 py-2 px-3 border-0 shadow-sm">
                        💬 @if(auth()->check() && auth()->user()->role == 'admin') Chat Pembeli @else Chat Admin @endif
                    </a>
                </div>
            </div>
        </div>

        <!-- Konten Chat Real-Time AJAX -->
        <div class="col-md-9">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h3 class="fw-bold text-danger mb-1">
                    @if(auth()->check() && auth()->user()->role == 'admin')
                        💬 Daftar Pesan / Chat Pembeli
                    @else
                        💬 Pusat Bantuan & Chat Admin
                    @endif
                </h3>
                <p class="text-muted small">Pesan terkirim secara instan tanpa perlu memuat ulang (refresh) halaman.</p>
                <hr>
                
                <!-- Kotak Riwayat Pesan -->
                <div id="chat-container" class="p-3 bg-light rounded-4 mb-3" style="height: 350px; overflow-y: auto;">
                    @forelse($messages as $msg)
                        <div class="mb-3 text-{{ $msg['sender'] == 'Admin Telkomsel' ? 'end' : 'start' }}">
                            <span class="badge {{ $msg['sender'] == 'Admin Telkomsel' ? 'bg-danger' : 'bg-secondary' }} mb-1">
                                {{ $msg['sender'] }} <small style="font-size: 9px; opacity: 0.8;">({{ $msg['time'] }})</small>
                            </span>
                            <div>
                                <div class="p-3 {{ $msg['sender'] == 'Admin Telkomsel' ? 'bg-danger text-white' : 'bg-white text-dark' }} rounded-3 shadow-sm d-inline-block text-start" style="max-width: 75%;">
                                    {{ $msg['text'] }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div id="no-message" class="text-center text-muted py-5">
                            <p class="mb-1">Belum ada riwayat percakapan.</p>
                            <small>Kirim pesan pertama kamu di bawah ini!</small>
                        </div>
                    @endforelse
                </div>

                <!-- Form Kirim Pesan dengan AJAX -->
                <form id="chat-form" action="{{ route('toko.chat.send') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="message-input" name="message" class="form-control" placeholder="Ketik pesan kamu di sini..." required autocomplete="off">
                        <button class="btn btn-danger px-4 fw-bold" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script AJAX agar Pesan Langsung Masuk Tanpa Refresh + Auto Refresh Chat Berkala -->
<script>
    const chatContainer = document.getElementById('chat-container');

    // Fungsi agar otomatis scroll ke pesan paling bawah
    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }
    window.onload = scrollToBottom;

    // Kirim pesan via AJAX tanpa reload halaman
    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        let inputField = document.getElementById('message-input');

        fetch("{{ route('toko.chat.send') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if(response.ok) {
                inputField.value = ''; // Kosongkan input setelah terkirim
                fetchMessages();       // Langsung ambil data chat terbaru
            }
        })
        .catch(error => console.error('Gagal mengirim pesan:', error));
    });

    // Fungsi untuk mengambil pesan terbaru secara otomatis tiap 3 detik tanpa refresh
    function fetchMessages() {
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            let parser = new DOMParser();
            let doc = parser.parseFromString(html, 'text/html');
            let newChatContainer = doc.getElementById('chat-container').innerHTML;
            
            // Perbarui isi kotak chat hanya jika ada perubahan
            if(chatContainer.innerHTML !== newChatContainer) {
                chatContainer.innerHTML = newChatContainer;
                scrollToBottom();
            }
        });
    }

    // Jalankan pengecekan pesan otomatis setiap 3 detik agar admin/pembeli bisa melihat balasan secara live
    setInterval(fetchMessages, 3000);
</script>
@endsection