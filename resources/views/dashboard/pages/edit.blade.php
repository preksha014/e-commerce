<x-dashboard-layout>
    <x-slot:heading>Edit Page</x-slot:heading>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <form action="{{ route('admin.page.update', $page->slug) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Title Field -->
                <div class="flex flex-col space-y-1">
                    <label for="title" class="text-md font-semibold text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                </div>
                @error('title')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <!-- Slug Field -->
                <div class="flex flex-col space-y-1">
                    <label for="slug" class="text-md font-semibold text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $page->slug) }}" readonly
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                </div>

                <!-- Summernote Editor -->
                <div class="flex flex-col space-y-1">
                    <label for="summernote" class="text-md font-semibold text-gray-700">Content</label>
                    <textarea name="content" id="summernote">{{ old('content', $page->content) }}</textarea>
                </div>
                @error('content')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <!-- Status Field -->
                <div class="flex flex-col space-y-1">
                    <label for="status" class="text-md font-semibold text-gray-700">Status</label>
                    <select name="status" id="status"
                        class="w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                        <option value="active" {{ old('status', $page->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $page->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                @error('status')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <!-- Submit Button -->
                <div class="flex justify-between">
                    <a href="{{ route('admin.page') }}"
                        class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-red-600 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                        Update Page
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

            $('.page-title').on("input", function (e) {
                e.preventDefault();
                let slug = $(this).val()
                    .toLowerCase()
                    .replace(/ /g, "-") 
                    .replace(/[^\w-]+/g, ""); 

                if (slug) $('.page-slug').val(slug);
            });
        });
    </script>
</x-dashboard-layout>