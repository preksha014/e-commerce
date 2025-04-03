<x-dashboard-layout>
    <x-slot name="heading">Category</x-slot>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Add Category</h2>
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name"
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
                    <!-- Rounded Image Preview -->
                    <div class="flex justify-start mt-4">
                        <img id="imagePreview" class="w-32 h-32 hidden object-cover rounded-lg border-2 border-violet-200">
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 bg-violet-600 hover:bg-violet-700 text-white mt-6 rounded-lg shadow-md transition duration-200 text-md font-semibold">
                    Add Category
                </button>
            </form>
        </div>
    </div>
</x-dashboard-layout>

<!-- Image Preview Script -->
<script>
    document.getElementById('image').addEventListener('change', function (event) {
        var input = event.target;
        var preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>