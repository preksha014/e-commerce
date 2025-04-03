<x-dashboard-layout>
    <x-slot:heading>Edit Category</x-slot:heading>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Edit Category</h2>

            <form action="{{ route('admin.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" value="{{ $category->name }}" required 
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="image" class="block text-md font-medium text-gray-700">Category Image</label>
                    <input type="file" id="image" name="image" accept="image/*" 
                        class="w-full mt-2 p-3 border rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
                    @error('image')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                    
                    @if ($category->image)
                        <div class="mt-4">
                            <p class="text-sm font-medium text-gray-700">Current Image:</p>
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-32 h-32 object-cover mt-2 rounded-lg border-2 border-violet-200 shadow-md">
                        </div>
                    @endif
                </div>
            
                <div class="flex justify-end space-x-4 mt-6">
                    <a href="{{ route('admin.category') }}"
                        class="py-3 px-6 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow-md transition duration-200 text-md font-semibold">
                        Cancel
                    </a>
                    <button type="submit"
                        class="py-3 px-6 bg-violet-600 hover:bg-violet-700 text-white rounded-lg shadow-md transition duration-200 text-md font-semibold">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>