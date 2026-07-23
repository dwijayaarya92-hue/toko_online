<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika user belum login, lempar ke halaman login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Cek apakah role user ada di dalam daftar akses yang diizinkan
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, arahkan ke halaman utama/toko
        return redirect('/toko')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}