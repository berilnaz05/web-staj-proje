<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use App\Models\User;

class FriendController extends Controller
{
    // Arkadaşlık isteği gönder
public function send(User $user)
{
    if ($user->id == auth()->id()) {
        return back();
    }

    $exists = Friend::where(function ($q) use ($user) {
        $q->where('sender_id', auth()->id())
          ->where('receiver_id', $user->id);
    })->orWhere(function ($q) use ($user) {
        $q->where('sender_id', $user->id)
          ->where('receiver_id', auth()->id());
    })->exists();

    if ($exists) {
        return back()->with('error', 'Bu kullanıcıyla zaten arkadaşsınız veya bekleyen isteğiniz var.');
    }

    Friend::create([
        'sender_id' => auth()->id(),
        'receiver_id' => $user->id,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Arkadaşlık isteği gönderildi.');
}

    // İsteği kabul et
    public function accept(Friend $friend)
    {
        if ($friend->receiver_id != auth()->id()) {
            abort(403);
        }

        $friend->update([
            'status' => 'accepted'
        ]);

        return back()->with('success', 'Arkadaşlık isteği kabul edildi.');
    }

    // İsteği reddet
    public function reject(Friend $friend)
    {
        if ($friend->receiver_id != auth()->id()) {
            abort(403);
        }

        $friend->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Arkadaşlık isteği reddedildi.');
    }
}