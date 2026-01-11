<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\blogController;
use App\Http\Controllers\projekController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\halamanController;
use App\Http\Controllers\Auth\LoginController;

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard utama → panggil controller
Route::get('/dashboard', [halamanController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Group dashboard (protected)
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::resource('halaman', halamanController::class);
    Route::resource('resum', ResumeController::class);
    Route::resource('projek', projekController::class);
    Route::resource('blog', blogController::class);

});
