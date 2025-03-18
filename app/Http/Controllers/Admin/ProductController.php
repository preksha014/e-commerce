<?php

namespace App\Http\Controllers\Admin;

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
        // Fetch all Products
        $products = Product::all();

        // Return view with all Products
        return view('dashboard.product.index', [
            'products' => $products
        ]);
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
    public function store(Request $request)
    {
        // Validate all forms input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $product=[
            'name' => $request->name,
            'description' => $request->description,
            'size' => $request->size,
            'color' => $request->color,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => Str::slug($request['name']),
            'status' => $request['status'] === 'active' ? 1 : 0,
        ];

        // Store Product to products table
        $product = Product::create($product);

        // Store Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                ProductImages::create([
                    'product_id' => $product->id,
                    'image' => $image->store('product_images', 'public'),
                ]);
            }
        }

        return redirect()->route('admin.product')->with('success', 'Product added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'size' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Convert 'status' to integer
        $validated['status'] = $validated['status'] === 'active' ? 1 : 0;

        // Update product details
        $product->update($validated);

        // Handle images
        if ($request->hasFile('images')) {
            // Get existing images and delete them
            $existingImages = ProductImages::where('product_id', $product->id)->get();
            foreach ($existingImages as $img) {
                if ($img->image_path && Storage::disk('public')->exists($img->image_path)) {
                    Storage::disk('public')->delete($img->image_path);
                }
                $img->delete(); // Remove old database records
            }

            // Upload and store new images
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('product_images', 'public');

                ProductImages::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                ]);
            }
        }
        return redirect()->route('admin.product')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        // Delete the category image from storage
        if ($product->images) {
            foreach ($product->images as $image):
                \Storage::delete('public/' . $image->image);
            endforeach;
        }

        // Delete the category
        $product->delete();

        // Redirect back with a success message
        return redirect()->route('admin.product')->with('success', 'Product deleted successfully!');
    }
}