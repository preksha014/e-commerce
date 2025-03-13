<x-dashboard-layout>
    <x-slot:heading>Category</x-slot:heading>
    <div class="flex justify-center items-center flex-1 bg-gray-100">
        <div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-lg border border-gray-300">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-6">Add Category</h2>
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div>
                    <label for="name" class="block text-lg font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter category name" required 
                        class="w-full mt-2 p-3 border border-gray-400 rounded-lg focus:ring-2 focus:ring-violet-700 focus:outline-none">
                </div>
                <div>
                    <label for="image" class="block text-lg font-medium text-gray-700">Category Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required 
                        class="w-full mt-2 p-3 border border-gray-400 rounded-lg focus:ring-2 focus:ring-violet-700 focus:outline-none">
                </div>
                <button type="submit" 
                    class="w-full py-3 bg-violet-800 text-white text-lg hover:bg-violet-700 transition duration-200">
                    Add Category
                </button>
            </form>
        </div>
    </div>
</x-dashboard-layout>
