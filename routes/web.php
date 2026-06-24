<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresensiController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH USER (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD REDIRECT
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('pegawai.dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PEGAWAI DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:pegawai'])->group(function () {
        Route::get('/pegawai/dashboard', function () {
            return view('pegawai.dashboard');
        })->name('pegawai.dashboard');
    });

    /*
    |--------------------------------------------------------------------------
    | PRESENSI (FULL CRUD - FIXED)
    |--------------------------------------------------------------------------
    */
    Route::prefix('presensi')->name('presensi.')->group(function () {

        Route::get('/', [PresensiController::class, 'index'])->name('index');        // LIST / LOG
        Route::get('/create', [PresensiController::class, 'create'])->name('create'); // FORM
        Route::post('/', [PresensiController::class, 'store'])->name('store');        // SIMPAN

        Route::get('/{id}/edit', [PresensiController::class, 'edit'])->name('edit');  // EDIT
        Route::put('/{id}', [PresensiController::class, 'update'])->name('update');   // UPDATE

        Route::delete('/{id}', [PresensiController::class, 'destroy'])->name('destroy'); // HAPUS
    });

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('/dashboard/data', [DashboardController::class, 'data']);

    /*
    |--------------------------------------------------------------------------
    | MASTER DATA
    |--------------------------------------------------------------------------
    */
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('pengajuan', PengajuanController::class);

    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */
    Route::get('/laporan/pdf', [LaporanController::class, 'pdf']);
    Route::get('/laporan/rekap', [LaporanController::class, 'rekapPdf']);
});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| AUTH DEFAULT (BREEZE / FORTIFY)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';