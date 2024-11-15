<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class ProductController extends Controller
{
    // Display a list of products
    public function index()
    {
        $products = Product::with('user')->paginate(10);  // This should fetch all products along with the user details
        return view('products.index', compact('products'));  // Pass the products to the view
    }
    

    // Display a specific product
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Show the form to create a new product
    public function create()
    {
        return view('products.create');
    }

    // Store the new product in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
}
