<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'user_id',
    ];

    // Each product belongs to a seller (user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each product can have multiple chats (one for each buyer)
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
