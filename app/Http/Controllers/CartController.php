<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use Exception;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function viewCart()
    {
        try {
            $cart = $this->cartService->getCart();

            return view('user.cart', [
                'cart' => $cart,
                'cart_total' => session('cart_total', 0),
                'cart_count' => session('cart_count', 0),
            ]);
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load cart. Please try again.');
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $result = $this->cartService->addToCart($request->slug, $request->input('quantity', 1));

            return response()->json([
                'message' => 'Item added to cart successfully!',
                'cart' => $result['cart'],
                'cart_total' => $result['cart_total'],
                'cart_count' => $result['cart_count'],
            ]);
        } catch (Exception $e) {
            \Log::error('Add to cart failed: ' . $e->getMessage()); // Log error
            return response()->json(['message' => 'Failed to add item to cart. Please try again.'], 500);
        }
    }

    public function updateCart(string $slug, Request $request)
    {
        try {
            $result = $this->cartService->updateCart($slug, $request->action);
            $cart = $result['cart'];

            if (!isset($cart[$slug]) && $request->action !== 'decrement') {
                return response()->json(['message' => 'Item not found in cart'], 404);
            }

            $response = [
                'cart_count' => session('cart_count', 0),
                'cart_total' => session('cart_total', 0)
            ];

            if (empty($cart)) {
                $response['message'] = 'Your cart is empty';
            } else {
                $response['message'] = 'Cart updated successfully';
                if (isset($cart[$slug])) {
                    $response['item'] = [
                        'slug' => $slug,
                        'quantity' => $cart[$slug]['quantity'],
                        'price' => $cart[$slug]['price']
                    ];
                }
            }

            return response()->json($response);
        } catch (Exception $e) {
            \Log::error('Cart update failed: ' . $e->getMessage()); // Log error
            return response()->json(['message' => 'Failed to update cart. Please try again.'], 500);
        }
    }

    public function removeFromCart(string $slug)
    {
        try {
            $result = $this->cartService->removeFromCart($slug);

            return response()->json([
                'message' => 'Item removed from cart',
                'cart' => $result['cart'],
                'cart_total' => $result['cart_total'],
                'cart_count' => $result['cart_count']
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to remove item from cart'], 500);
        }
    }
}