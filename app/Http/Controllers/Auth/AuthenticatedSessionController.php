<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display login page
     */
    public function create(): View
    {
        return view('auth.login');
    }


    /**
     * Handle login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();


        $user = Auth::user();


        // Kalau admin
        if ($user->role == 'admin') {

            return redirect('/admin/dashboard');

        }


        // Kalau pegawai
        if ($user->role == 'pegawai') {

            return redirect('/pegawai/dashboard');

        }


        // Default
        return redirect('/');

    }



    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {

        Auth::guard('web')->logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();


        return redirect('/');

    }
}