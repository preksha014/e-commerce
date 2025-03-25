<x-dashboard-layout>
    <x-slot:heading>Edit Category</x-slot:heading>

    <div class="flex justify-center items-center flex-1 bg-gray-100">
        <div class="w-full max-w-lg p-8 bg-white shadow-xl rounded-lg border border-gray-300">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Edit Category</h2>

            <form id="editCategoryForm" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name" value="{{ $category->name }}" required class="w-full mt-2 p-3 border rounded-lg">
                    <p id="error-name" class="text-xs text-red-500 font-semibold mt-1"></p>
                </div>
            
                <div>
                    <label for="image" class="block text-md font-medium text-gray-700">Category Image</label>
                    <input type="file" id="image" name="image" accept="image/*" class="w-full mt-2 p-3 border rounded-lg">
                    <p id="error-image" class="text-xs text-red-500 font-semibold mt-1"></p>
                    
                    @if ($category->image)
                        <div class="mt-3">
                            <p class="text-gray-600">Current Image:</p>
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-32 h-32 object-cover mt-2 border border-gray-300 shadow-md">
                        </div>
                    @endif
                </div>
            
                <button type="submit" class="w-full py-3 bg-violet-800 text-white mt-4">Update Category</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#editCategoryForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission
    
                var formData = new FormData(this);
    
                $.ajax({
                    url: "{{ route('admin.category.update', $category->id) }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.success);
                        window.location.href = "{{ route('admin.category') }}";
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $('#error-name').text(errors.name ? errors.name[0] : '');
                            $('#error-image').text(errors.image ? errors.image[0] : '');
                        } else {
                            toastr.error('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
</x-dashboard-layout>