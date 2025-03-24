<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function show(string $slug)
    {
        try {
            // Fetch category and its products
            $category = Category::where('slug', $slug)->with('products')->firstOrFail();

            // Get products related to this category
            $products = $category->products;

            return view('user.catalog', compact('category', 'products'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching category details.');
        }
    }
}
