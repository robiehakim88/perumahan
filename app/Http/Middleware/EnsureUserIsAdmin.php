<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        \Log::info('Middleware EnsureUserIsAdmin dipanggil');

        if (!auth()->check()) {
            \Log::info('Pengguna tidak login. Mengalihkan ke halaman login.');
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (auth()->user()->role !== 'admin') {
            \Log::info('Pengguna bukan admin. Mengalihkan ke halaman utama.');
            return redirect('/')->with('error', 'Anda tidak memiliki akses sebagai admin.');
        }

        \Log::info('Pengguna adalah admin. Melanjutkan...');
        return $next($request);
    }
}

