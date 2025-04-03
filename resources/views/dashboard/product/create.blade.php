<x-dashboard-layout>
    <x-slot name="heading">Add Product</x-slot>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Product Details</h2>
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Product Name</label>
                    <input type="text" id="name" name="name" class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none"></textarea>
                    @error('description')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-700">Size</label>
                        <input type="text" id="size" name="size" step="0.01" class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        @error('size')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                        <input type="text" id="color" name="color" class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        @error('color')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="mt-3">
                    <label class="block text-sm font-medium text-gray-700">Categories</label>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        @foreach($categories as $category)
                            <div class="flex items-center">
                                <input type="checkbox" id="category_{{ $category->id }}" name="category_ids[]" value="{{ $category->id }}" 
                                    class="mr-2 border-gray-300 rounded text-blue-600">
                                <label for="category_{{ $category->id }}" class="text-sm text-gray-700">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('category_ids')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>                
                <div class="grid grid-cols-2 gap-3 mt-3">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <input type="number" id="price" name="price" step="0.01" class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        @error('price')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        @error('quantity')
                            <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-3">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none bg-white">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <label for="images" class="block text-sm font-medium text-gray-700">Product Images</label>
                    <input type="file" id="images" name="images[]" multiple class="w-full mt-2 p-3 border rounded-lg cursor-pointer focus:outline-none" accept="image/*">
                
                    <!-- Image Previews Container -->
                    <div id="imagePreviewContainer" class="flex flex-wrap gap-2 mt-4"></div>
                
                    @error('images[]')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full py-3 px-4 bg-violet-600 hover:bg-violet-700 text-white mt-6 rounded-lg shadow-md transition duration-200 text-md font-semibold">Add Product</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>

<!-- Image Preview Script -->
<script>
    document.getElementById('images').addEventListener('change', function (event) {
        var input = event.target;
        var previewContainer = document.getElementById('imagePreviewContainer');
        
        // Clear previous previews
        previewContainer.innerHTML = '';

        if (input.files) {
            Array.from(input.files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    var reader = new FileReader();
                    var imgElement = document.createElement('img');
                    imgElement.className = "w-32 h-32 object-cover";

                    reader.onload = function (e) {
                        imgElement.src = e.target.result;
                        previewContainer.appendChild(imgElement);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>