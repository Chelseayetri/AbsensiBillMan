<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekPeran
{
    public function handle(Request $request, Closure $next, ...$peran)
    {
        $user = auth()->user();

        // Jika belum login
        if (!$user) {
            return redirect('/login');
        }

        // Ambil nama peran user
        $namaPeran = $user->peran->nama_peran;

        // Jika peran tidak sesuai
        if (!in_array($namaPeran, $peran)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
