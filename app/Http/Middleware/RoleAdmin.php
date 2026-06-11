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
        // cek user login
        if (!auth()->check()) {
            abort(403, 'Akses Ditolak. Silakan login terlebih dahulu.');
        }

        // cek role admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses Ditolak. Anda bukan Administrator.');
        }

        return $next($request);
    }
}