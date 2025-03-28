<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
     * Display a listing of trashed categories.
     */
    public function trashed()
    {
        try {
            // Fetch soft deleted categories
            $trashedCategories = Category::onlyTrashed()->paginate(10);

            // Return view with all trashed categories
            return view('dashboard.category.trashed', compact('trashedCategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching trashed categories.');
        }
    }

    /**
     * Restore the specified trashed category.
     */
    public function restore($id)
    {
        try {
            // Find the trashed category
            $category = Category::onlyTrashed()->findOrFail($id);
            
            // Restore the category
            $category->restore();

            return redirect()->route('admin.category.trashed')->with('success', 'Category restored successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while restoring the category.');
        }
    }

    /**
     * Permanently delete the category.
     */
    public function forceDelete($id)
    {
        try {
            // Find the trashed category
            $category = Category::onlyTrashed()->findOrFail($id);
            
            // Detach all related products
            $category->products()->detach();

            // Delete the category image from storage
            if ($category->image) {
                \Storage::delete('public/' . $category->image);
            }
            
            // Permanently delete the category
            $category->forceDelete();

            return redirect()->route('admin.category.trashed')->with('success', 'Category permanently deleted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while permanently deleting the category.');
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
            $validated = $request->validated();

            $category = Category::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
                'image' => $request->file('image')->store('category_images', 'public'),
            ]);

            return redirect()->route('admin.category')->with('success', 'Category added successfully.');

        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while adding the category.'], 500);
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
            $validated = $request->validated();

            $updatedData = [
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']),
            ];

            if ($request->hasFile('image')) {
                $updatedData['image'] = $request->file('image')->store('category_images', 'public');
            }

            $category->update($updatedData);

            return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the category.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Soft delete the category
            $category->delete();

            // Redirect back with a success message
            return redirect()->route('admin.category')->with('success', 'Category moved to trash.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the category.');
        }
    }
}