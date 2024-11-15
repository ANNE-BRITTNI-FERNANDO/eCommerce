@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p><strong>Price:</strong> ${{ $product->price }}</p>
    <p><strong>Seller:</strong> {{ $product->user->name }}</p>
    
    <!-- Chat Button -->
    @if(Auth::id() !== $product->user_id)
        <form action="{{ route('products.chat', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Chat with Seller</button>
        </form>
    @else
        <p class="text-muted">You are the seller of this product.</p>
    @endif
</div>
@endsection
