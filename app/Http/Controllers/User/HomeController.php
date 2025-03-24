<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\StaticBlock;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::all();
            $products = Product::all();
            $block = StaticBlock::where('slug', 'banner-home')->first();
            return view('user.home', compact('categories', 'products', 'block'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching home data.');
        }
    }

    public function about()
    {
        try {
            $block = StaticBlock::where('slug', 'bn1')->first();
            return view('user.about', compact('block'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching about data.');
        }
    }

    public function contact()
    {
        try {
            $block = StaticBlock::where('slug', 'bn1')->first();
            return view('user.contact', compact('block'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching contact data.');
        }
    }
}