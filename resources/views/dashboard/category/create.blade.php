<x-dashboard-layout>
    <x-slot name="heading">Category</x-slot>

    <div class="flex justify-center items-center flex-1 bg-gray-100">
        <div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-lg border border-gray-300">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Add Category</h2>
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" class="w-full mt-2 p-3 border rounded-lg">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="image" class="block text-md font-medium text-gray-700">Category Image</label>
                    <input type="file" id="image" name="image" class="w-full mt-2 p-3 border rounded-lg">
                </div>
                @error('image')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="w-full py-3 bg-violet-800 text-white mt-4">Add Category</button>
            </form>
        </div>
    </div>
</x-dashboard-layout>