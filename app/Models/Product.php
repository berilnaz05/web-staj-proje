<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductComment;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'image',
        'category',
        'condition',
        'status',
        'product_id',
        'content'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(ProductComment::class);
    }


}