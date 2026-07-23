<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Method untuk menampilkan halaman utama kasir/toko
    public function index()
    {
        $products = Product::all();
        return view('tokoku', compact('products'));
    }

    // Method untuk memproses transaksi checkout
    public function checkout(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);

        if ($product->stock < $request->qty) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        // Kurangi stok produk
        $product->decrement('stock', $request->qty);

        $totalBayar = $product->price * $request->qty;

        // Simpan riwayat transaksi sementara di session
        $transaksiBaru = [
            'nama' => $product->name,
            'qty' => $request->qty,
            'total' => $totalBayar,
            'waktu' => now()->format('H:i:s')
        ];
        
        $riwayat = session()->get('riwayat_transaksi', []);
        array_unshift($riwayat, $transaksiBaru);
        session()->put('riwayat_transaksi', $riwayat);

        return redirect()->back()->with('success', "Transaksi Berhasil! Total Bayar: Rp " . number_format($totalBayar, 0, ',', '.'));
    }

    // Method untuk menampilkan form tambah produk
public function createProduct()
{
    return view('tambah_produk');
}

// Method untuk menyimpan produk baru ke database
public function storeProduct(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'stock' => $request->stock,
    ]);

    return redirect()->route('toko.index')->with('success', 'Produk baru berhasil ditambahkan!');
}

public function resetHistory()
{
    session()->forget('riwayat_transaksi');
    return redirect()->back()->with('success', 'Riwayat transaksi berhasil dibersihkan!');
}
}