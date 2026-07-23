<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HrdController;
use App\Http\Controllers\PegawaiController;

// 1. Halaman Utama & Toko Publik
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [TokoController::class, 'index'])->name('home');
Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
Route::post('/toko/checkout', [TokoController::class, 'checkout'])->name('toko.checkout');

// 3. Autentikasi bawaan Laravel
Auth::routes();

// ==========================================
// RUTE HALAMAN TOKO (PROFIL & CHAT INTERAKTIF)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Rute Menu Profil Perusahaan
    Route::get('/toko/profil', function () {
        $profil = [
            'nama_toko' => session('nama_toko', 'Telkomsel Indonesia'),
            'slogan'    => session('slogan', 'Penyedia layanan telekomunikasi digital terdepan di Indonesia yang menghubungkan seluruh negeri.'),
            'kontak'    => session('kontak', '188 / 0811-0000-111'),
            'alamat'    => session('alamat', 'Telkom Landmark Tower, Jl. Gatot Subroto No. Kav. 52, Jakarta Selatan'),
        ];
        return view('pegawai.profil', compact('profil'));
    })->name('toko.profil');

    // Rute Simpan Profil (Khusus Admin)
    Route::post('/toko/profil/update', function (\Illuminate\Http\Request $request) {
        session([
            'nama_toko' => $request->nama_toko,
            'slogan'    => $request->slogan,
            'kontak'    => $request->kontak,
            'alamat'    => $request->alamat,
        ]);
        return redirect()->route('toko.profil')->with('success', 'Profil toko berhasil diperbarui!');
    })->name('toko.profil.update');

    // Rute Menu Chat (Saling Terhubung Global untuk Semua Akun)
    Route::get('/toko/chat', function () {
        $messages = Cache::get('global_chat_messages', []);
        return view('pegawai.chat', compact('messages'));
    })->name('toko.chat');

    // Rute Kirim Pesan Chat Global
    Route::post('/toko/chat/send', function (\Illuminate\Http\Request $request) {
        $messages = Cache::get('global_chat_messages', []);
        
        $sender = (auth()->check() && auth()->user()->role == 'admin') ? 'Admin Telkomsel' : 'Pembeli #1';
        
        $messages[] = [
            'sender' => $sender,
            'text'   => $request->message,
            'time'   => date('H:i')
        ];
        
        // Simpan ke Cache global selama 24 jam
        Cache::put('global_chat_messages', $messages, 86400);
        
        return redirect()->route('toko.chat');
    })->name('toko.chat.send');

    // Rute Katalog / Kelola Produk
    Route::get('/toko/produk', function () {
        $produks = session('produks', [
            ['nama' => 'Nama Produk Keren', 'harga' => '150.000', 'stok' => '25']
        ]);
        return view('pegawai.produk', compact('produks'));
    })->name('toko.produk');

    Route::post('/toko/produk/store', function (\Illuminate\Http\Request $request) {
        $produks = session('produks', [
            ['nama' => 'Nama Produk Keren', 'harga' => '150.000', 'stok' => '25']
        ]);
        $produks[] = [
            'nama'  => $request->nama,
            'harga' => $request->harga,
            'stok'  => $request->stok,
        ];
        session(['produks' => $produks]);
        return redirect()->route('toko.produk')->with('success', 'Produk baru berhasil ditambahkan!');
    })->name('toko.produk.store');

});

// ==========================================
// 4. RUTE KHUSUS ADMIN & HRD
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Rute Admin Saja
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    });

    // Rute Pegawai & HRD Lainnya
    Route::middleware(['role:admin,hrd'])->group(function () {
        Route::get('/hrd', [HrdController::class, 'index'])->name('hrd.index');
        Route::get('/hrd/create', [HrdController::class, 'create'])->name('hrd.create');

        Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
        Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
        Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store');
        Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    });

});