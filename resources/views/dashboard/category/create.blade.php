<x-dashboard-layout>
    <x-slot name="heading">Category</x-slot>

    <div class="flex justify-center items-center flex-1 bg-gray-100">
        <div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-2xl border border-gray-200">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Add Category</h2>
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none">
                    <p id="error-name" class="text-xs text-red-500 font-semibold mt-1"></p>
                </div>

                <div class="mt-4">
                    <label for="image" class="block text-md font-medium text-gray-700">Category Image</label>
                    <input type="file" id="image" name="image" class="w-full mt-2 p-3 border rounded-lg cursor-pointer">
                    <p id="error-image" class="text-xs text-red-500 font-semibold mt-1"></p>
                    <!-- Rounded Image Preview -->
                    <div class="flex justify-start mt-4">
                        <img id="imagePreview" class="w-32 h-32 hidden object-cover">
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3 bg-violet-800 text-white mt-6 rounded-lg shadow-md hover:bg-violet-700 transition duration-200">
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