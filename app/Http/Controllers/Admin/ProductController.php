<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::all();
        // dd($products->category);
        return view('dashboard.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('dashboard.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
 

     public function store(Request $request)
     {
         $validated = $request->validate([
             'name'        => 'required|string|max:255',
             'description' => 'required|string',
             'category'    => 'required|exists:categories,id',
             'price'       => 'required|numeric|min:0',
             'quantity'    => 'required|integer|min:1',
             'status'      => 'required|in:active,inactive',
             'images'      => 'required|array',
             'images.*'    => 'mimes:jpg,jpeg,png,webp', 
         ]);
     
         $validated['slug'] = Str::slug($validated['name']);
         $validated['status'] = $validated['status'] === 'active' ? 1 : 0;
     
         // Create Product
         $product = Product::create($validated);
     
         // Store Images
         foreach ($request->file('images') as $image) {
             ProductImages::create([
                 'product_id' => $product->id,
                 'image'      => $image->store('product_images', 'public'),
             ]);
         }
     
         return redirect()->route('admin.product')->with('success', 'Product added successfully.');
     }
     
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
