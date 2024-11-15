<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


public function isSeller()
{
    return $this->role === 'seller';
}

public function isBuyer()
{
    return $this->role === 'buyer';
}
 // A user can have multiple products as a seller
 public function products()
 {
     return $this->hasMany(Product::class);
 }

 // A user can be involved in multiple chats, either as a buyer or seller
 public function buyerChats()
 {
     return $this->hasMany(Chat::class, 'buyer_id');
 }

 public function sellerChats()
 {
     return $this->hasMany(Chat::class, 'seller_id');
 }
}
