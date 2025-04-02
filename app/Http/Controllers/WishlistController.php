<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        $products = Product::whereIn('id', array_keys($wishlist))->get();
        return view('user.wishlist.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$product->id])) {
            return response()->json(['success' => false, 'message' => 'Product already in wishlist!']);
        }

        $wishlist[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'added_at' => now()->toDateTimeString()
        ];

        session()->put('wishlist', $wishlist);

        return response()->json(['success' => true, 'message' => 'Product added to wishlist!']);
    }

    public function destroy($product_id)
    {
        $wishlist = session()->get('wishlist', []);

        if (isset($wishlist[$product_id])) {
            unset($wishlist[$product_id]);
            session()->put('wishlist', $wishlist);
        }

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Product removed from wishlist!']);
        }
        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }

    public function clear()
    {
        session()->put('wishlist', []);
        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Wishlist cleared!']);
        }

        return redirect()->back()->with('success', 'Wishlist cleared!');
    }

    public function check($product_id)
    {
        $wishlist = session()->get('wishlist', []);
        $in_wishlist = isset($wishlist[$product_id]);

        return response()->json([
            'in_wishlist' => $in_wishlist
        ]);
    }

    public function checkStatus()
    {
        $wishlist = session()->get('wishlist', []);
        return response()->json([
            'count' => count($wishlist)
        ]);
    }
}