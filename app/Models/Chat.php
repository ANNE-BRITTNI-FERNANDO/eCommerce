<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'buyer_id', 'seller_id',
    ];

    // Each chat is associated with a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Each chat is associated with a buyer (user)
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // Each chat is associated with a seller (user)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // Each chat has multiple messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
