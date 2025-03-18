<x-dashboard-layout>
    <x-slot:heading>Edit Category</x-slot:heading>

    <div class="flex justify-center items-center flex-1 bg-gray-100">
        <div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-lg border border-gray-300">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Edit Category</h2>

            <form action="{{ route('admin.category.update', $category->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" value="{{ $category->name }}" required
                        class="w-full mt-2 p-3 border border-gray-400 rounded-lg focus:ring-2 focus:ring-violet-700 focus:outline-none">
                </div>

                <div>
                    <label for="image" class="block text-md font-medium text-gray-700">Category Image</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full mt-2 p-3 border border-gray-400 rounded-lg focus:ring-2 focus:ring-violet-700 focus:outline-none">

                    <!-- Show Current Image -->
                    @if ($category->image)
                        <div class="mt-3">
                            <p class="text-gray-600">Current Image:</p>
                            <img src="{{ asset('storage/' . $category->image) }}"
                                class="w-32 h-32 object-cover mt-2 border border-gray-300 shadow-md">
                        </div>
                    @endif
                </div>

                <div class="flex justify-between mt-4">
                    <a href="{{ route('admin.category') }}" 
                        class="px-6 py-2 bg-gray-500 text-white rounded-md shadow-md hover:bg-gray-600 transition duration-200">
                        Cancel
                    </a>
                
                    <button type="submit" 
                        class="px-6 py-2 bg-violet-800 text-white rounded-md shadow-md hover:bg-violet-700 transition duration-200">
                        Update Category
                    </button>
                </div>      
            </form>
        </div>
    </div>
</x-dashboard-layout>