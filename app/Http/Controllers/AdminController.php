<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artwork;
use App\Models\Comment;
use App\Models\Report;

class AdminController extends Controller
{
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
        return view('admin.kullanicilar');
    }

    public function eserler()
    {
        return view('admin.eserler');
    }

    public function yorumlar()
    {
        return view('admin.yorumlar');
    }

    public function sikayetler()
    {
        return view('admin.sikayetler');
    }
}