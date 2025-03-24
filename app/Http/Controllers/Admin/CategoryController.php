<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Fetch all categories
            $categories = Category::paginate(10);

            // Return view with all categories
            return view('dashboard.category.index', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching categories.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // Return view for add category form
            return view('dashboard.category.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while loading the create form.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            // Validate all form inputs
            $validated = $request->validated();

            $category = Category::create([
                'name' => $request->name,
                'slug' => Str::slug($validated['name']), // Auto-generate slug from name
                'image' => $request->file('image')->store('category_images', 'public'),
            ]);

            // Attach products if provided
            if ($request->has('products')) {
                $category->products()->attach($request->products);
            }

            // Redirect
            return redirect()->route('admin.category')->with('success', 'Category added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the category.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        try {
            // Return view for edit category with category value
            return view('dashboard.category.edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while loading the edit form.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, Category $category)
    {
        try {
            // Validate all forms attributes
            $validated = $request->validated();

            $validated = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ];

            // If a new image is uploaded, store it and replace the old one
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('category_images', 'public');
            }

            // Update the data of category
            $category->update($validated);

            // Sync products if provided-->arrange ids of products
            if ($request->has('products')) {
                $category->products()->sync($request->products);
            }

            // Redirect
            return redirect()->route('admin.category')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the category.');
        }
    }
}