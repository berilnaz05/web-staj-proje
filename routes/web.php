<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

//Anasayfa
use App\Models\User;
use App\Models\Artwork;
use App\Models\Comment;

use App\Models\Product;
use App\Http\Controllers\ProductController;

Route::get('/urun/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/sanat-pazari', function () {

    $products = Product::latest()
        ->where('status', 'satista')
        ->get();

    return view('sanat-pazari', compact('products'));
})->name('sanat-pazari');


Route::get('/', function () {

    $userCount = User::count();
    $artworkCount = Artwork::count();
    $commentCount = Comment::count();

    $latestArtworks = Artwork::latest()
        ->take(6)
        ->get();

    $products = Product::latest()
        ->where('status', 'satista')
        ->take(6)
        ->get();

    return view('welcome', compact(
        'userCount',
        'artworkCount',
        'commentCount',
        'latestArtworks',
        'products'
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

    $artworks = Artwork::where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('dashboard', compact('artworks'));

})->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/urun/{product}', [ProductController::class, 'show'])
    ->name('products.show');

    Route::middleware('auth')->group(function () {





    Route::post('/urun/{product}/yorum',[ProductController::class, 'comment'])
        ->name('products.comment');

    Route::get('/urun/{product}/duzenle', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/urun/{product}', [ProductController::class, 'update'])
        ->name('products.update');


    Route::delete('/urun/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

    Route::patch('/urun/{product}/satildi', [ProductController::class, 'updateStatus'])
        ->name('products.sold');

    Route::get('/urunlerim', function () {

    $products = Product::where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('urunlerim', compact('products'));

    })->name('urunlerim');

    Route::get('/urun-ekle', [ProductController::class, 'create'])
        ->name('products.create');

    Route::post('/urun-ekle', [ProductController::class, 'store'])
        ->name('products.store');
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__.'/auth.php';