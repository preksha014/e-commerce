<x-dashboard-layout>

    <x-slot name="heading">Edit Product</x-slot>

    <div class="flex justify-center items-center flex-1 bg-gray-100">
        <div class="w-full max-w-lg p-6 bg-white shadow-md rounded-lg border border-gray-300">
            <h2 class="text-xl font-bold text-center text-gray-900 mb-4">Edit Product</h2>

            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')             
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                        class="w-full mt-1 p-2 border rounded-md">
                </div>
                <div class="mt-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" required
                        class="w-full mt-1 p-2 border rounded-md">{{ old('description', $product->description) }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-1">
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700">Size</label>

                        <input type="text" id="size" name="size" value="{{ old('size', $product->size) }}" required
                            class="w-full mt-1 p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                        <input type="text" id="color" name="color" value="{{ old('color', $product->color) }}" required
                            class="w-full mt-1 p-2 border rounded-md">
                    </div>
                </div>
                <div class="mt-2">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category" name="category" required class="w-full mt-1 p-2 border rounded-md bg-white">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-1">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                            step="0.01" required class="w-full mt-1 p-2 border rounded-md">
                    </div>
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" id="quantity" name="quantity"
                            value="{{ old('quantity', $product->quantity) }}" required
                            class="w-full mt-1 p-2 border rounded-md">
                    </div>
                </div>
                <div class="mt-2">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" required class="w-full mt-1 p-2 border rounded-md bg-white">
                        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active
                        </option>
                        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive</option>
                    </select>
                </div>
                <div class="mt-2">
                    <label for="images" class="block text-sm font-medium text-gray-700">Product Images</label>
                    <input type="file" id="images" name="images[]" multiple class="w-full mt-1 p-2 border rounded-md">
                    @if ($product->images->isNotEmpty())
                        <div class="mt-2 flex flex-wrap gap-2">
                            <p class="text-gray-600 w-full">Current Images:</p>
                            @foreach($product->images as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Product Image"
                                    class="w-16 h-16 object-cover mt-2 border border-gray-300 shadow-md">
                            @endforeach
                        </div>
                    @endif
                </div>
                <button type="submit" class="w-full py-2 bg-violet-800 text-white mt-4 text-md">Update Product</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>