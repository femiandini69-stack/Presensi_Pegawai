<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login, dan apakah role-nya 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); 
        }

        // 2. Jika bukan admin, lempar kembali ke dashboard dengan pesan error
        return redirect()->route('dashboard')->with('error', 'Hanya Admin yang dapat mengakses halaman tersebut!');
    }
}