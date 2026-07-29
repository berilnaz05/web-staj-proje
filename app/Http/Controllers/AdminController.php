<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artwork;
use App\Models\Comment;
use App\Models\Report;
use App\Models\Product;

class AdminController extends Controller
{



    public function deleteProduct(Product $product)
    {
        $product->delete();

        return back()->with(
            'success',
            'Ürün silindi.'
        );
    }

    public function urunler()
    {
        $products = Product::latest()->get();

        return view('admin.urunler', compact('products'));
    }


    public function dashboard()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.dashboard', [
            'userCount' => User::count(),
            'artworkCount' => Artwork::count(),
            'commentCount' => Comment::count(),
            'reportCount' => Report::count(),
        ]);
    }

    public function kullanicilar()
    {
        $users = User::latest()->get();

        return view('admin.kullanicilar', compact('users'));
    }

    public function eserler()
    {
        $artworks = Artwork::latest()->get();

        return view('admin.eserler', compact('artworks'));
    }

    public function yorumlar()
    {
        $comments = Comment::latest()->get();

        return view('admin.yorumlar', compact('comments'));
    }

    public function sikayetler()
    {
        $reports = Report::latest()->get();

        return view('admin.sikayetler', compact('reports'));
    }
}