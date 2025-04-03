<x-dashboard-layout>
    <x-slot:heading>Trashed Categories</x-slot:heading>

    <div class="p-8 space-y-8">
        <!-- Header Section with Actions -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Trashed Categories</h2>
            </div>
            <a href="{{ route('admin.category') }}"
                class="inline-flex items-center px-4 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition-colors duration-200">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Categories
            </a>
        </div>
        
        @if(session('success'))
            <script>
                $(document).ready(function () {
                    toastr.success("{{ session('success') }}");
                });
            </script>
        @endif
        
        <!-- Categories Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                @if($trashedCategories->count() > 0)
                    <table class="w-full whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category Name</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category Image</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Deleted At</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trashedCategories as $category)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-start">
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image"
                                                class="w-24 h-24 object-cover rounded-lg shadow-sm border border-gray-200">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $category->deleted_at->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 text-sm space-x-2">
                                    <button type="button"
                                        class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600 transition duration-200"
                                        data-restore-open data-id="{{ $category->id }}">
                                        <i class="fa-solid fa-trash-restore"></i> Restore
                                    </button>
                                    <button type="button"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200"
                                        data-force-delete-open data-id="{{ $category->id }}">
                                        <i class="fa-solid fa-trash"></i> Delete Permanently
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-4">
                    <p class="text-gray-500 text-lg">No trashed categories found.</p>
                </div>
            @endif
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $trashedCategories->links() }}
        </div>
    </div>

    <!-- Restore Confirmation Modal -->
    <div id="restoreModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Restore Category</h2>
            <p class="text-gray-600">Are you sure you want to restore this category?</p>
            <div class="mt-4 flex justify-end space-x-2">
                <button id="cancelRestore"
                    class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600 transition duration-200">
                    Cancel
                </button>
                <form id="restoreForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600 transition duration-200">
                        Restore
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Force Delete Confirmation Modal -->
    <div id="forceDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4 text-red-600">Permanent Deletion</h2>
            <p class="text-gray-600">This will permanently delete the category. This action cannot be undone.</p>
            <div class="mt-4 flex justify-end space-x-2">
                <button id="cancelForceDelete"
                    class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600 transition duration-200">
                    Cancel
                </button>
                <form id="forceDeleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200">
                        Delete Permanently
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-dashboard-layout>

<script>
    $(document).ready(function () {
        // Restore modal
        $('[data-restore-open]').click(function () {
            var categoryId = $(this).data('id');
            $('#restoreForm').attr('action', '/admin/category/trashed/' + categoryId + '/restore');
            $('#restoreModal').removeClass('hidden');
        });

        $('#cancelRestore').click(function () {
            $('#restoreModal').addClass('hidden');
        });

        // Force delete modal
        $('[data-force-delete-open]').click(function () {
            var categoryId = $(this).data('id');
            $('#forceDeleteForm').attr('action', '/admin/category/trashed/' + categoryId + '/force-delete');
            $('#forceDeleteModal').removeClass('hidden');
        });

        $('#cancelForceDelete').click(function () {
            $('#forceDeleteModal').addClass('hidden');
        });
    });
</script>