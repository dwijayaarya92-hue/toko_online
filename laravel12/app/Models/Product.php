<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Pastikan nama kolom di bawah sama persis dengan yang ada di database (tabel products)
    protected $fillable = [
        'nama_produk', 
        'harga', 
        'stok'
    ];
}