<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Product;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request, $chatId)
    {
        $chat = Chat::findOrFail($chatId);

        // Ensure the logged-in user is either the buyer or seller
        if (auth()->id() !== $chat->buyer_id && auth()->id() !== $chat->seller_id) {
            abort(403, 'Unauthorized access');
        }

        // Store the message
        Message::create([
            'chat_id' => $chat->id,
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->route('chats.show', $chat->id);
    }
}

