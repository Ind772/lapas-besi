<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu!');
        }

        // Cek apakah user adalah admin
        // Sesuaikan dengan struktur tabel users Anda
        // Misal: ada kolom 'role' atau 'is_admin'
        
        // Opsi 1: Jika menggunakan kolom 'role'
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized. Hanya admin yang dapat mengakses halaman ini.');
        }

        // Opsi 2: Jika menggunakan kolom 'is_admin' (boolean)
        // if (!auth()->user()->is_admin) {
        //     abort(403, 'Unauthorized. Hanya admin yang dapat mengakses halaman ini.');
        // }

        // Opsi 3: Jika menggunakan email tertentu sebagai admin
        // $adminEmails = ['admin@example.com', 'superadmin@example.com'];
        // if (!in_array(auth()->user()->email, $adminEmails)) {
        //     abort(403, 'Unauthorized. Hanya admin yang dapat mengakses halaman ini.');
        // }

        return $next($request);
    }
}