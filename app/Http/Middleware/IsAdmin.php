<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Karena semua user di tabel users adalah admin, langsung izinkan
        // Jika nanti ada role system, bisa tambahkan pengecekan role di sini
        // if (Auth::user()->role !== 'admin') {
        //     return redirect('/')->with('error', 'Anda tidak memiliki akses.');
        // }

        return $next($request);
    }
}
