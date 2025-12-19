<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; 
use Illuminate\Http\Request;
use Illuminate\Support\Str; 

class ProductController extends Controller
{
    /**
     * Home Page: Show 3 featured products
     */
    public function welcome()
    {
        $featuredProducts = Product::latest()->take(3)->get();
        return view('welcome', compact('featuredProducts'));
    }

    /**
     * Shop Page (Dashboard): List products with category filtering
     */
    public function index(Request $request)
    {
        $categories = Category::all(); // Required for the sidebar links
        $query = Product::query();

        // Check if we are filtering by a specific category ID
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
            $selectedCategory = Category::find($request->category);
        }

        $products = $query->get();
        
        return view('dashboard', compact('products', 'categories'));
    }

    /**
     * Show single product details
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product-details', compact('product'));
    }

    /**
     * Show create form (Admin Only)
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store new product (Admin Only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer|min:0', // Added missing validation
            'image'       => 'nullable|string', 
            'ram'         => 'nullable|string',
            'storage'     => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Product created successfully!');
    }

    /**
     * Show the edit form (Admin Only)
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update data in the database (Admin Only)
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|string', 
            'ram'         => 'nullable|string',
            'storage'     => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
    }

    /**
     * Delete product and cleanup image
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->image && !Str::startsWith($product->image, 'http')) {
            $imagePath = public_path($product->image);
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
        }
        
        $product->delete();
        return redirect()->route('dashboard')->with('success', 'Product removed.');
    }
}