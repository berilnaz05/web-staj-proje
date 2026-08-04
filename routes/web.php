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
use App\Http\Controllers\FriendController;
use App\Models\Friend;
use Illuminate\Http\Request;

use App\Http\Controllers\ArtworkController;


//Eserler Sayfası
Route::get('/eserler', function () {
    return view('artworks.index');
})->name('artworks.index');

Route::get('/eserler', [ArtworkController::class, 'index'])
    ->name('artworks.index');

Route::get('/eser-olustur', [ArtworkController::class, 'create'])
    ->middleware('auth')
    ->name('artworks.create');

Route::post('/eser-olustur', [ArtworkController::class, 'store'])
    ->middleware('auth')
    ->name('artworks.store');

Route::get('/eser/{artwork}', [ArtworkController::class, 'show'])
    ->name("artworks.show");

Route::get('/eser/{artwork}/duzenle',
    [ArtworkController::class, 'edit'])
    ->name('artworks.edit');

Route::put('/eser/{artwork}',
    [ArtworkController::class, 'update'])
    ->name('artworks.update');

Route::delete('/eser/{artwork}',
    [ArtworkController::class, 'destroy'])
    ->name('artworks.destroy');



Route::post('/friend/send/{user}',
    [FriendController::class, 'send'])
    ->middleware('auth')
    ->name('friend.send');

Route::get('/ara', function (Request $request) {

    $q = $request->q;

    $products = Product::where('title', 'like', "%{$q}%")
        ->get();

    $artworks = Artwork::where('title', 'like', "%{$q}%")
        ->get();

    $users = User::where('name', 'like', "%{$q}%")
        ->get();

    return view('search', compact(
        'q',
        'products',
        'artworks',
        'users'
    ));

})->name('search');


Route::get('/arkadaslik-istekleri', function () {

    $requests = Friend::where(
        'receiver_id',
        auth()->id()
    )
    ->where('status', 'pending')
    ->with('sender')
    ->get();

    return view(
        'arkadaslik-istekleri',
        compact('requests')
    );

})->middleware('auth')->name('friend.requests');


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
Route::delete('/admin/urunler/{product}',[AdminController::class, 'deleteProduct'])
    ->middleware(['auth', 'admin'])
    ->name('admin.product.delete');

Route::get('/admin/urunler', [AdminController::class, 'urunler'])
    ->middleware(['auth', 'admin'])
    ->name('admin.urunler');

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
Route::get('/dashboard', function (Illuminate\Http\Request $request) {

    $artworks = Artwork::where('user_id', auth()->id())
        ->latest()
        ->get();

    $tab = $request->get('tab', 'home');

    $friends = \App\Models\Friend::where('status', 'accepted')
        ->where(function ($query) {
            $query->where('sender_id', auth()->id())
                  ->orWhere('receiver_id', auth()->id());
        })
        ->get();

    return view('dashboard', compact(
        'artworks',
        'tab',
        'friends'
    ));

})->middleware(['auth', 'verified'])->name('dashboard');


   

Route::middleware('auth')->group(function () {

    Route::post('/friend/send/{user}',
        [FriendController::class, 'send'])
        ->name('friend.send');

    Route::post('/friend/accept/{friend}',
        [FriendController::class, 'accept'])
        ->name('friend.accept');

    Route::post('/friend/reject/{friend}',
        [FriendController::class, 'reject'])
        ->name('friend.reject');

});


    Route::delete('/yorum-sil/{comment}',[ProductController::class, 'deleteComment']
        )->name('products.comment.delete');

    Route::post('/urun/{product}/yorum', [ProductController::class, 'comment'])
    ->name('products.comment');

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


    Route::get('/kullanicilar', function () {

    $users = \App\Models\User::where(
        'id',
        '!=',
        auth()->id()
    )->get();

    return view('kullanicilar', compact('users'));

})->middleware('auth')->name('users.index');





require __DIR__.'/auth.php';
