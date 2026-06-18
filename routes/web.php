<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController; // <--- WAJIB TAMBAHKAN INI

Route::get('/', function () { return view('welcome'); });

Route::middleware(['auth', 'verified'])->group(function () {
    // Rute dashboard sekarang memanggil DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
});

Route::middleware(['auth'])->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');

    Route::middleware(['admin'])->group(function () {
        Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
        Route::get('/attendance/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
        Route::put('/attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
        Route::delete('/attendance/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    });
});

require __DIR__.'/auth.php';