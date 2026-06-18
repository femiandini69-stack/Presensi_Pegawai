<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data user untuk dikirim ke view
        $users = User::with('divisi')->get(); 
        return view('dashboard', compact('users'));
    }
}