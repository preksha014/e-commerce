<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categories')->paginate(5); // Eager load categories
        $categories = Category::all(); // Fetch all categories

        // Return view with products and categories
        return view('dashboard.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all categories
        $categories = Category::all();

        // Return view with categories for add product form
        return view('dashboard.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreProductRequest $request)
    {
        // Validate all form input data
        $request->validated();
        
        // Create product with slug and integer status
        $product = Product::create(array_merge(
            $request->except(['category_ids', 'status']),
            [
                'slug' => Str::slug($request->name),
                'status' => $request->status === 'active' ? 1 : 0, // Convert status to integer (1 = active, 0 = inactive)
            ]
        ));

        // Storing images into product_images table
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');

                // Debugging
                if (!$path) {
                    return back()->withErrors(['image_error' => 'Image upload failed!']);
                }

                ProductImages::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        // Attach selected categories-->arrange categories ids
        $product->categories()->sync($request->category_ids);

        // Redirect
        return redirect()->route('admin.product')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Fetch all categories
        $categories = Category::all();

        // Return view with products and categories
        return view('dashboard.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(StoreProductRequest $request, Product $product)
     {
         // Validate input
         $validated = $request->validated();
     
         // Update product details
         $product->update([
             'name' => $validated['name'],
             'description' => $validated['description'],
             'size' => $validated['size'],
             'color' => $validated['color'],
             'price' => $validated['price'],
             'quantity' => $validated['quantity'],
             'status' => $validated['status'] === 'active' ? 1 : 0,
         ]);
     
         // Sync categories
         $product->categories()->sync($validated['categories']);
     
         // Handle images only if new images are uploaded
         if ($request->hasFile('images')) {
             // Delete old images from storage and database
             foreach ($product->images as $image) {
                 if (Storage::disk('public')->exists($image->image)) {
                     Storage::disk('public')->delete($image->image);
                 }
                 $image->delete();
             }
     
             // Upload and store new images
             foreach ($request->file('images') as $image) {
                 ProductImages::create([
                     'product_id' => $product->id,
                     'image' => $image->store('product_images', 'public'),
                 ]);
             }
         }
     
         // Redirect
         return redirect()->route('admin.product')->with('success', 'Product updated successfully!');
     }
     
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Detach categories
        $product->categories()->detach();

        // Delete the category image from storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        // Delete the product
        $product->delete();

        // Redirect back with a success message
        return redirect()->route('admin.product')->with('success', 'Product deleted successfully!');
    }
}