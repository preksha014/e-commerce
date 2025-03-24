<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();
            return view('user.catalog', [
                'products' => $products,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching products');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();
            return view('user.product-overview', compact('product'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching product details');
        }
    }
}
