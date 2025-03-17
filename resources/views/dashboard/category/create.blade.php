<x-dashboard-layout>
    <x-slot name="heading">Category</x-slot>

    <div class="flex justify-center items-center flex-1 bg-gray-100">
        <div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-lg border border-gray-300">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Add Category</h2>
            <form id="category-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" required class="w-full mt-2 p-3 border rounded-lg">
                </div>
                <div class="hidden">
                    <label for="slug" class="block text-md font-medium text-gray-700">Category Slug</label>
                    <input type="text" id="slug" name="slug" readonly
                        class="w-full mt-2 p-3 border rounded-lg bg-gray-100">
                </div>
                <div class="mt-4">
                    <label for="image" class="block text-md font-medium text-gray-700">Category Image</label>
                    <input type="file" id="image" name="image" required class="w-full mt-2 p-3 border rounded-lg">
                </div>
                <button type="submit" class="w-full py-3 bg-violet-800 text-white mt-4">Add Category</button>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#name').on('keyup', function () {
                let name = $(this).val();
                if (name.length > 0) {
                    let slug = name.toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-]/g, '');
                    $('#slug').val(slug);
                } else {
                    $('#slug').val('');
                }
            });
        });
    </script>
</x-dashboard-layout>