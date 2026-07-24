<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


// Ana sayfa
Route::get('/', function () {
    return view('welcome');
});


// Admin paneli
Route::get('/admin', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/admin/kullanicilar', [AdminController::class, 'kullanicilar'])
    ->middleware(['auth', 'admin'])
    ->name('admin.kullanicilar');

Route::get('/admin/eserler', [AdminController::class, 'eserler'])
    ->middleware(['auth', 'admin'])
    ->name('admin.eserler');

Route::get('/admin/yorumlar', [AdminController::class, 'yorumlar'])
    ->middleware(['auth', 'admin'])
    ->name('admin.yorumlar');

Route::get('/admin/sikayetler', [AdminController::class, 'sikayetler'])
    ->middleware(['auth', 'admin'])
    ->name('admin.sikayetler');


// Kullanıcı dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__.'/auth.php';