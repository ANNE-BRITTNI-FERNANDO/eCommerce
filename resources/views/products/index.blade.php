@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Product List</h1>

        @if($products->isEmpty())
            <p>No products available.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="p-4 border border-gray-200 rounded-lg">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded">
                        <h2 class="font-bold text-lg mt-2">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-600">{{ Str::limit($product->description, 100) }}</p>
                        <p class="font-bold mt-2">${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 mt-4 inline-block">View Details</a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            {{ $products->links() }}
        @endif
    </div>
@endsection
