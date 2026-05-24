<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('attendance.index');
});


// test perubahan
Route::resource('attendance', AttendanceController::class);