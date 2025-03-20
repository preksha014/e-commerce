<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function viewCart()
    {
        $cart = $this->cartService->getCart();

        return view('user.cart', [
            'cart' => $cart,
            'cart_total' => session('cart_total', 0),
            'cart_count' => session('cart_count', 0)
        ]);
    }

    public function addToCart(Request $request)
    {
        $result = $this->cartService->addToCart($request->slug, $request->input('quantity', 1));

        return response()->json([
            'message' => 'Item added to cart',
            'cart' => $result['cart'],
            'cart_total' => $result['cart_total'],
            'cart_count' => $result['cart_count'],
        ]);
    }

    public function updateCart(string $slug, Request $request)
    {
        $success = $this->cartService->updateCart($slug, $request->action);

        if ($success) {
            return redirect()->back()->with('success', 'Cart updated successfully');
        }

        return redirect()->back()->with('error', 'Item not found in cart');
    }

    public function removeFromCart(string $slug)
    {
        $result = $this->cartService->removeFromCart($slug);

        return response()->json([
            'message' => 'Item removed from cart', 
            'cart' => $result['cart'], 
            'cart_total' => $result['cart_total']
        ]);
    }
}