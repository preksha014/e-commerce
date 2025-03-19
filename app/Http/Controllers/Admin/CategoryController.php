<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all categories
        $categories = Category::all();

        // Return view with all categories
        return view('dashboard.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return view for add category form
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate all form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpg,webp', 
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug'=> Str::slug($validated['name']), // Auto-generate slug from name
            'image' => $request->file('image')->store('category_images', 'public'),
        ]);

        // Attach products if provided
        if ($request->has('products')) {
            $category->products()->attach($request->products);
        }
    
        // Redirect
        return redirect()->route('admin.category')->with('success', 'Category added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $products = Product::all();
        return view('dashboard.category.edit', compact('category', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate all forms attributes
        $request->validate([
            'name' => ['required'],
            'image' => ['nullable', 'mimes:png,jpg,webp'],
        ]);

        $attributes = [
            'slug' => Str::slug($request->name),
        ];

        // If a new image is uploaded, store it and replace the old one
        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('category_images', 'public');
        }

        // Update the data of category
        $category->update($attributes);

        // Sync products if provided
        if ($request->has('products')) {
            $category->products()->sync($request->products);
        }

        // Redirect
        return redirect()->route('admin.category')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Detach all related products
        $category->products()->detach();

        // Delete the category image from storage
        if ($category->image) {
            \Storage::delete('public/' . $category->image);
        }

        // Delete the category
        $category->delete();

        // Redirect back with a success message
        return redirect()->route('admin.category')->with('success', 'Category deleted successfully!');
    }
}