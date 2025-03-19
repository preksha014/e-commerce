<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Calculate total price and count
    private function calculateCartTotals($cart): void
    {
        $cart_total = 0;
        $cart_count = 0;

        foreach ($cart as $item) {
            $cart_total += $item['price'] * $item['quantity'];
            $cart_count += $item['quantity'];
        }

        session(['cart_total' => $cart_total, 'cart_count' => $cart_count]);
    }

    // View Cart
    public function viewCart()
    {
        $cart = session('cart', []);
        $this->calculateCartTotals($cart);

        return view('user.cart', [
            'cart' => $cart,
            'cart_total' => session('cart_total', 0),
            'cart_count' => session('cart_count', 0)
        ]);
    }

    // Add to Cart
    public function addToCart(Request $request)
    {
        $product = Product::where('slug', $request->slug)->firstOrFail();
        $cart = session()->get('cart', []);

        $cart[$product->slug] = [
            'name' => $product->name,
            'price' => $product->price,
            "image" => $product->images->first()->image,
            "quantity" => $request->input('quantity', 1),
            'slug' => $product->slug,
        ];

        session()->put('cart', $cart);
        $this->calculateCartTotals($cart);

        return response()->json(['message' => 'Item added to cart', 'cart' => $cart, 'cart_total' => session('cart_total')]);
    }

    // Remove Item from Cart
    public function removeFromCart(string $slug)
    {
        $cart = session('cart', []);

        if (isset($cart[$slug])) {
            unset($cart[$slug]);
            session(['cart' => $cart]);
            $this->calculateCartTotals($cart);
        }

        return response()->json(['message' => 'Item removed from cart', 'cart' => $cart, 'cart_total' => session('cart_total')]);
    }
}