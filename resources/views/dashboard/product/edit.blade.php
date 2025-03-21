<x-dashboard-layout>

    <x-slot name="heading">Edit Product</x-slot>

    <div class="flex justify-center items-center flex-1 bg-gray-100">
        <div class="w-full max-w-lg p-6 bg-white shadow-md rounded-lg border border-gray-300">
            <h2 class="text-xl font-bold text-center text-gray-900 mb-4">Edit Product</h2>

            <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" 
                        class="w-full mt-1 p-2 border rounded-md">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" 
                        class="w-full mt-1 p-2 border rounded-md">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-2 gap-3 mt-1">
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700">Size</label>

                        <input type="text" id="size" name="size" value="{{ old('size', $product->size) }}" 
                            class="w-full mt-1 p-2 border rounded-md">
                        @error('size')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                        <input type="text" id="color" name="color" value="{{ old('color', $product->color) }}" 
                            class="w-full mt-1 p-2 border rounded-md">
                        @error('color')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-2">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <div class="mt-1">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input type="checkbox" id="category_{{ $category->id }}" name="categories[]"
                                    value="{{ $category->id }}" class="mr-2" {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'checked' : '' }}>

                                <label for="category_{{ $category->id }}"
                                    class="text-gray-700">{{ $category->name }}</label>
                            </div>
                        @endforeach
                        @error('category_ids')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-1">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}"
                            step="0.01"  class="w-full mt-1 p-2 border rounded-md">
                        @error('price')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" id="quantity" name="quantity"
                            value="{{ old('quantity', $product->quantity) }}" 
                            class="w-full mt-1 p-2 border rounded-md">
                        @error('quantity')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-2">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="w-full mt-1 p-2 border rounded-md bg-white">
                        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active
                        </option>
                        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
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
                    @error('images[]')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-between mt-4">
                    <a href="{{ route('admin.product') }}"
                        class="px-6 py-2 bg-gray-500 text-white rounded-md shadow-md hover:bg-gray-600 transition duration-200">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-violet-800 text-white rounded-md shadow-md hover:bg-violet-700 transition duration-200">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>