<x-dashboard-layout>
    <x-slot name="heading">Edit Permission</x-slot>

    <div class="flex-grow p-8 space-y-6">
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 border border-violet-100">
            <h2 class="text-2xl font-bold text-violet-900 mb-6">Add Permission</h2>
            <form action="{{ route('admin.permission.update',$permission->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div>
                    <label for="name" class="block text-md font-medium text-gray-700">Permission Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') ?? $permission->name}}"
                        class="permission-name w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 focus:outline-none">
                    @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Slug Field -->
                <div class="hidden mt-4">
                    <label for="slug" class="text-md font-medium text-gray-700">Slug</label>
                    <input type="text" id="slug" name="slug"
                        class="permission-slug w-full mt-2 p-3 border rounded-lg focus:ring-2 focus:ring-violet-500 focus:outline-none">
                    @error('slug')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-4 mt-4"> 
                    <a href="{{ route('admin.permission') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow-md hover:bg-gray-600 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-violet-600 text-white rounded-lg shadow-md hover:bg-violet-700 transition duration-200">
                        Update Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
<script>
    $(document).ready(function () {
        $('.permission-name').on("input", function (e) {
            e.preventDefault();

            let slug = $(this).val()
                .toLowerCase()
                .replace(/ /g, "-") // Replace spaces with hyphens
                .replace(/[^\w-]+/g, ""); // Remove non-word characters

            if (slug) $('.permission-slug').val(slug);
        });
    });
</script>