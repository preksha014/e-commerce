<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function show(string $slug){
        // Fetch category and its products
        $category = Category::where('slug', $slug)->with('products')->firstOrFail();
        
        // Get products related to this category
        $products = $category->products;

        return view('user.catalog', compact('category', 'products'));
    }
}
