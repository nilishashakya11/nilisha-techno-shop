<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Add a product to the session cart
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        
        // Check if there is enough stock
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Sorry, this item is out of stock!');
        }

        $cart = session()->get('cart', []);

        // If product already exists in cart, increase quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // New item in cart
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => Str::startsWith($product->image, 'http') ? $product->image : asset($product->image)
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    /**
 * Simulate checkout and clear the cart
 */
public function checkout()
{
    // Check if cart is empty before proceeding
    if (!session()->has('cart') || count(session('cart')) == 0) {
        return redirect()->route('dashboard')->with('error', 'Your cart is empty!');
    }

    // logic: Here is where you would normally save an Order to the database
    
    // Clear the cart session
    session()->forget('cart');

    return view('checkout-success');
}

    /**
     * Remove an item from the cart
     */
    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed successfully!');
    }
}