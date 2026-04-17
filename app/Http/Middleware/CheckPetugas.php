<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPetugas
{
    public function handle(Request $request, Closure $next)
    {
        if (session('role') !== 'petugas') {
            return redirect('/buku')->with('error', 'Akses ditolak! Hanya petugas yang bisa melakukan ini.');
        }
        return $next($request);
    }
}