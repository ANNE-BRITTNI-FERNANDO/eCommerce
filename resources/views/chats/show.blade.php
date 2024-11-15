@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chat about "{{ $chat->product->name }}"</h1>

    <!-- Display all messages -->
    <div class="chat-box border rounded p-3 mb-3">
        @forelse($messages as $message)
            <div class="mb-2">
                <strong>{{ $message->sender->name }}:</strong>
                <p>{{ $message->message }}</p>
                <small class="text-muted">{{ $message->created_at->format('d M Y, h:i A') }}</small>
            </div>
        @empty
            <p class="text-muted">No messages yet.</p>
        @endforelse
    </div>

    <!-- Message form -->
    <form action="{{ route('messages.store', $chat->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <textarea name="message" class="form-control" rows="3" placeholder="Type your message..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Send Message</button>
    </form>
</div>
@endsection
