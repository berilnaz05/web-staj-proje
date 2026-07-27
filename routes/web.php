<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

//Anasayfa
use App\Models\User;
use App\Models\Artwork;
use App\Models\Comment;

Route::get('/', function () {

    $userCount = User::count();
    $artworkCount = Artwork::count();
    $commentCount = Comment::count();

    $latestArtworks = Artwork::latest()
        ->take(6)
        ->get();

    return view('welcome', compact(
        'userCount',
        'artworkCount',
        'commentCount',
        'latestArtworks'
    ));
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

    $artworks = Artwork::latest()->take(6)->get();

    return view('dashboard', compact('artworks'));

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