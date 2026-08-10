<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
Use App\Models\Message;
use App\Models\Notification;


class MessageController extends Controller
{


public function send(Request $request)
{
    Message::create([
    'sender_id' => auth()->id(),
    'receiver_id' => $request->receiver_id,
    'message' => $request->message,
    'is_read' => false,
    ]);

    Notification::create([
        'user_id' => $request->receiver_id,
        'title' => 'Yeni Mesaj',
        'message' => auth()->user()->name . ' sana mesaj gönderdi.',
        'is_read' => false,
    ]);

    return response()->json([
        'success' => true
    ]);
}

public function getMessages(User $user)
{
    

    Message::where('sender_id', $user->id)
        ->where('receiver_id', auth()->id())
        ->where('is_read', false)
        ->update([
            'is_read' => true
        ]);

    $messages = Message::where(function ($query) use ($user) {

        $query->where('sender_id', auth()->id())
              ->where('receiver_id', $user->id);

    })->orWhere(function ($query) use ($user) {

        $query->where('sender_id', $user->id)
              ->where('receiver_id', auth()->id());

    })
    ->orderBy('created_at')
    ->get();

    return response()->json($messages);
}


    public function index()
{
    $friendIds = \App\Models\Friend::where(function ($query) {

        $query->where('sender_id', auth()->id())
              ->orWhere('receiver_id', auth()->id());

    })
    ->where('status', 'accepted')
    ->get()
    ->map(function ($friend) {

        return $friend->sender_id == auth()->id()
            ? $friend->receiver_id
            : $friend->sender_id;

    });

    $users = \App\Models\User::whereIn('id', $friendIds)->get();

    return view('messages.index', compact('users'));
}
}
