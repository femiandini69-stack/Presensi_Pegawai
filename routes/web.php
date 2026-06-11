<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
| DASHBOARD
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
| AUTH AREA
*/
Route::middleware(['auth'])->group(function () {

    // Attendance (CRUD)
    Route::resource('attendance', AttendanceController::class);

    // Presensi (manual route)
    Route::get('/presensi/create', [PresensiController::class, 'create'])
        ->name('presensi.create');

    Route::post('/presensi', [PresensiController::class, 'store'])
        ->name('presensi.store');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
| AUTH ROUTES (BREEZE)
*/
require __DIR__.'/auth.php';