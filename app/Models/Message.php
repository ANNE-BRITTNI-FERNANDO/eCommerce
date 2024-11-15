<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id', 'sender_id', 'message',
    ];

    // Each message belongs to a chat
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    // Each message has a sender (user)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
