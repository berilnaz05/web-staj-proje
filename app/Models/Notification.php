<?php

namespace App\Models;
Use Illuminate\Database\Eloquent\Model;


class Notification extends Model
{
    protected $table = 'notifications';
        protected $fillable = [
            'user_id',
            'title',
            'message',
            'is_read'
        ];

}