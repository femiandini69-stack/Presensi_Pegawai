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

        // Cek admin
        if (auth()->check() && auth()->user()->role === 'admin') {

            return $next($request);

        }


        // Jika bukan admin
        return redirect('/pegawai/dashboard')
            ->with('error', 'Hanya Admin yang dapat mengakses halaman tersebut!');

    }
}