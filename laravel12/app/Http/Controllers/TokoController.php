<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {
        // Ambil data profil dari session
        $profil = [
            'nama_toko' => session('nama_toko', 'TokoSayang'),
            'slogan'    => session('slogan', 'Diskon spesial khusus buat kamu, jangan sampai kehabisan ya!'),
            'kontak'    => session('kontak', '081234567890'),
            'alamat'    => session('alamat', 'Jl. Kenangan No. 123, Kota Bahagia'),
        ];

        // Ambil data produk dari session (default ada 1 produk awal jika kosong)
        $produks = session('produks', [
            ['nama' => 'Nama Produk Keren', 'harga' => '150.000', 'stok' => '25']
        ]);

        return view('tokoku', compact('profil', 'produks'));
    }

    public function checkout(Request $request)
    {
        return redirect()->route('toko.index')->with('success', 'Checkout berhasil!');
    }
}