@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Conversations</h1>

    @if($chats->isEmpty())
        <p class="text-muted">No conversations found.</p>
    @else
        <ul class="list-group">
            @foreach($chats as $chat)
                <li class="list-group-item">
                    <a href="{{ route('chats.show', $chat->id) }}">
                        Conversation with {{ $chat->buyer_id == auth()->id() ? $chat->seller->name : $chat->buyer->name }} 
                        about "{{ $chat->product->name }}"
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
