<x-dashboard-layout>
    <x-slot:heading>Create New Block</x-slot:heading>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Add New Block</h2>
            <form action="{{ route('admin.block.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Title Field -->
                <div>
                    <label for="title" class="text-md font-medium text-gray-700">Block Title</label>
                    <input type="text" id="title" name="title"
                        class="block-title w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none">
                    @error('title')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slug Field -->
                <div class="mt-4">
                    <label for="slug" class="text-md font-medium text-gray-700">Slug</label>
                    <input type="text" id="slug" name="slug"
                        class="block-slug w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none">
                    @error('slug')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Summernote Editor -->
                <div class="flex flex-col space-y-1">
                    <label for="summernote" class="text-md font-semibold text-gray-700">Content</label>
                    <textarea name="content" id="summernote"></textarea>
                </div>

                @error('content')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <!-- Status Field -->
                <div class="flex flex-col space-y-1">
                    <label for="status" class="text-md font-semibold text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                @error('status')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                        Save Block
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Summernote Script -->
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                placeholder: 'Enter your content here...',
                tabsize: 2,
                height: 150,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('.block-title').on("input", function (e) {
                e.preventDefault();

                let slug = $(this).val()
                    .toLowerCase()
                    .replace(/ /g, "-") // Replace spaces with hyphens
                    .replace(/[^\w-]+/g, ""); // Remove non-word characters

                if (slug) $('.block-slug').val(slug);
            });
        });
    </script>
</x-dashboard-layout>