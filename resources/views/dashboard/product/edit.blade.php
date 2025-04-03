<x-dashboard-layout>
    <x-slot:heading>Edit Product</x-slot:heading>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Edit Product</h2>

            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Product Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required 
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="description" class="block text-md font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="size" class="block text-md font-medium text-gray-700">Size</label>
                        <input type="text" id="size" name="size" value="{{ old('size', $product->size) }}" 
                            class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        @error('size')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="color" class="block text-md font-medium text-gray-700">Color</label>
                        <input type="text" id="color" name="color" value="{{ old('color', $product->color) }}" 
                            class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        @error('color')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="category" class="block text-md font-medium text-gray-700">Category</label>
                    <div class="mt-2 grid grid-cols-2 gap-2">
                        @foreach($categories as $category)
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="category_{{ $category->id }}" name="category_ids[]" 
                                    value="{{ $category->id }}" class="w-4 h-4 text-violet-600 border-gray-300 rounded focus:ring-violet-500"
                                    {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label for="category_{{ $category->id }}" class="text-gray-700">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('category_ids')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="price" class="block text-md font-medium text-gray-700">Price ($)</label>
                        <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                            class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        @error('price')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="quantity" class="block text-md font-medium text-gray-700">Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                            class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        @error('quantity')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <label for="status" class="block text-md font-medium text-gray-700">Status</label>
                    <select id="status" name="status" 
                        class="w-full mt-2 p-3 border rounded-lg bg-white focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="images" class="block text-md font-medium text-gray-700">Product Images</label>
                    <input type="file" id="images" name="images[]" multiple accept="image/*"
                        class="w-full mt-2 p-3 border rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
                    
                    @if ($product->images->isNotEmpty())
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-700">Current Images:</p>
                            <div class="flex flex-wrap gap-4 mt-2">
                                @foreach($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Product Image"
                                        class="w-32 h-32 object-cover rounded-lg border-2 border-violet-200 shadow-md">
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @error('images[]')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('admin.product') }}"
                        class="py-3 px-6 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow-md transition duration-200 text-md font-semibold">
                        Cancel
                    </a>
                    <button type="submit"
                        class="py-3 px-6 bg-violet-600 hover:bg-violet-700 text-white rounded-lg shadow-md transition duration-200 text-md font-semibold">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>