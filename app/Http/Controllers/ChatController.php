<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Product;
class ChatController extends Controller
{
// In ChatController.php
public function index()
{
    $chats = Chat::where('seller_id', auth()->id())
                 ->orWhere('buyer_id', auth()->id())
                 ->with('product') // Eager load related product
                 ->get();
    return view('dashboard.index', compact('chats'));
}


// In ChatController.php
public function store(Request $request, Product $product)
{
    // Check if the message is not empty
    if ($request->has('message') && !empty($request->message)) {
        // Create the chat if it doesn't exist
        $chat = Chat::firstOrCreate(
            ['seller_id' => $product->user_id, 'buyer_id' => auth()->id(), 'product_id' => $product->id]
        );

        // Optionally, you can add the first message when the chat is created
        $chat->messages()->create([
            'sender_id' => auth()->id(),
            'message' => $request->message
        ]);

        return redirect()->route('chats.show', $chat->id);
    }

    // If no message is sent, return back or show an error
    return redirect()->route('chats.index')->with('error', 'Message cannot be empty');
}


public function show(Chat $chat)
{
    // Fetch messages for the chat
    $messages = $chat->messages()->with('sender')->get();

    // Ensure the logged-in user is either the seller or the buyer
    if (auth()->id() !== $chat->buyer_id && auth()->id() !== $chat->seller_id) {
        abort(403, 'Unauthorized access'); // Return a 403 if the user is not part of this chat
    }

    return view('chats.show', compact('chat', 'messages'));
}


}
