<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;

class AdminController extends Controller
{
    public function index()
    {
        // Mengirim data agar tidak error "Undefined variable" di view
        $pegawai = Pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }
}