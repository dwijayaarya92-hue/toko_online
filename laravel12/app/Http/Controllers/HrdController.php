<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; // Memanggil model Employee yang tadi kamu tunjukin

class HrdController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model Employee
        $employees = Employee::all();
        
        // Mengirim data tersebut ke file hrd.blade.php
        return view('hrd', compact('employees'));
    }

    public function create()
    {
        return view('tambah_karyawan');
    }
}