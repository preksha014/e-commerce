<x-dashboard-layout>
    <x-slot name="heading">Product</x-slot>

    <div class="flex justify-center items-center flex-1 bg-gray-100">
        <div class="w-full max-w-lg p-6 bg-white shadow-md rounded-lg border border-gray-300">
            <h2 class="text-xl font-bold text-center text-gray-900 mb-4">Add Product</h2>
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                    <input type="text" id="name" name="name" class="w-full mt-1 p-2 border rounded-md">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" class="w-full mt-1 p-2 border rounded-md"></textarea>
                    @error('description')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                        <input type="text" id="size" name="size" step="0.01" class="w-full mt-1 p-2 border rounded-md">
                        @error('size')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                        <input type="text" id="color" name="color" class="w-full mt-1 p-2 border rounded-md">
                        @error('color')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="mt-3">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select id="category_id" name="category_id" class="w-full mt-1 p-2 border rounded-md bg-white">
                        <option value="">Select Category</option>i
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <input type="number" id="price" name="price" step="0.01"
                            class="w-full mt-1 p-2 border rounded-md">
                        @error('price')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="w-full mt-1 p-2 border rounded-md">
                        @error('quantity')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="w-full mt-1 p-2 border rounded-md bg-white">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="images" class="block text-sm font-medium text-gray-700">Product Images</label>
                    <input type="file" id="images" name="images[]" multiple class="w-full mt-1 p-2 border rounded-md">
                    @error('images[]')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full py-2 bg-violet-800 text-white mt-4 text-md">Add Product</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>