<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        // dd($category);
        return view('dashboard.category.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug',
            'image' => 'required|mimes:png,jpg,webp', 
        ]);

        $validated['image'] = $request->file('image')->store('category_images', 'public');

        Category::create($validated);

        return redirect()->route('admin.category')->with('success', 'Category added successfully.');
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
    public function edit(string $slug)
    {
        //
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        //
        $category = Category::where('slug', $slug)->firstOrFail();

        $attributes = $request->validate([
            'name' => ['required'],
            'image' => ['nullable', 'mimes:png,jpg,webp'],
        ]);

        // Auto-generate slug from name
        $attributes['slug'] = Str::slug($request->name);

        // If a new image is uploaded, store it and replace the old one
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
            $attributes['image'] = $imagePath;
        }

        $category->update($attributes);

        return redirect()->route('admin.category')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        // Find the category by slug
        $category = Category::where('slug', $slug)->firstOrFail();

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
