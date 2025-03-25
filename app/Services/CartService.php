<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    public function calculateCartTotals(array $cart): void
    {
        $cart_total = 0;
        $cart_count = 0;

        foreach ($cart as $item) {
            $cart_total += $item['price'] * $item['quantity'];
            $cart_count += $item['quantity'];
        }

        session(['cart_total' => $cart_total, 'cart_count' => $cart_count]);
    }

    public function getCart(): array
    {
        return session('cart', []);
    }

    public function getTotal(): float
    {
        return session('cart_total', 0);
    }

    public function addToCart(string $slug, int $quantity = 1): array
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $cart = $this->getCart();

        if (isset($cart[$product->slug])) {
            $cart[$product->slug]['quantity'] += $quantity;
        } else {
            $cart[$product->slug] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->images->first()->image ?? null,
                'quantity' => $quantity,
                'slug' => $product->slug,
            ];
        }

        session(['cart' => $cart]);
        $this->calculateCartTotals($cart);

        return [
            'cart' => $cart,
            'cart_total' => session('cart_total'),
            'cart_count' => session('cart_count'),
        ];
    }

    public function updateCart(string $slug, string $action): array
    {
        $cart = $this->getCart();

        if (!isset($cart[$slug])) {
            return [
                'cart' => $cart,
                'cart_total' => session('cart_total'),
                'cart_count' => session('cart_count')
            ];
        }

        if ($action === 'increment') {
            $cart[$slug]['quantity']++;
        } elseif ($action === 'decrement') {
            if ($cart[$slug]['quantity'] > 1) {
                $cart[$slug]['quantity']--;
            } else {
                unset($cart[$slug]);
            }
        }

        session(['cart' => $cart]);
        $this->calculateCartTotals($cart);

        return [
            'cart' => $cart,
            'cart_total' => session('cart_total'),
            'cart_count' => session('cart_count')
        ];
    }

    public function removeFromCart(string $slug): array
    {
        $cart = $this->getCart();

        if (isset($cart[$slug])) {
            unset($cart[$slug]);
            session(['cart' => $cart]);
            $this->calculateCartTotals($cart);
        }

        return [
            'cart' => $cart,
            'cart_total' => session('cart_total')
        ];
    }
}