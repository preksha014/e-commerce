<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProductRequest;
use App\Models\ProductImages;
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
        try {
            $products = Product::with('categories')->paginate(5);
            $categories = Category::all();
            return view('dashboard.product.index', compact('products', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while fetching products.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = Category::all();
            return view('dashboard.product.create', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while loading the create form.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $request->validated();
            
            $product = Product::create(array_merge(
                $request->except(['category_ids', 'status']),
                [
                    'slug' => Str::slug($request->name),
                    'status' => $request->status === 'active' ? 1 : 0,
                ]
            ));

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('product_images', 'public');
                    if (!$path) {
                        return back()->withErrors(['image_error' => 'Image upload failed!']);
                    }
                    ProductImages::create(['product_id' => $product->id, 'image' => $path]);
                }
            }

            $product->categories()->sync($request->category_ids);
            return redirect()->route('admin.product')->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the product.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        try {
            $categories = Category::all();
            return view('dashboard.product.edit', compact('product', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while loading the edit form.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        try {
            $validated = $request->validated();
            
            $product->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'size' => $validated['size'],
                'color' => $validated['color'],
                'price' => $validated['price'],
                'quantity' => $validated['quantity'],
                'status' => $validated['status'] === 'active' ? 1 : 0,
            ]);

            $product->categories()->sync($validated['categories']);

            if ($request->hasFile('images')) {
                foreach ($product->images as $image) {
                    if (Storage::disk('public')->exists($image->image)) {
                        Storage::disk('public')->delete($image->image);
                    }
                    $image->delete();
                }
                foreach ($request->file('images') as $image) {
                    ProductImages::create([
                        'product_id' => $product->id,
                        'image' => $image->store('product_images', 'public'),
                    ]);
                }
            }

            return redirect()->route('admin.product')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the product.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->categories()->detach();
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }
            $product->delete();
            return redirect()->route('admin.product')->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the product.');
        }
    }
}
