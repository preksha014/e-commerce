<x-dashboard-layout>
    <x-slot:heading>Trashed Products</x-slot:heading>

    <div class="p-8 space-y-8">
        <!-- Header Section with Actions -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Trashed Products</h2>
            </div>
            <a href="{{ route('admin.product') }}"
                class="inline-flex items-center px-4 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition-colors duration-200">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Products
            </a>
        </div>
        
        @if(session('success'))
            <script>
                $(document).ready(function () {
                    toastr.success("{{ session('success') }}");
                });
            </script>
        @endif
        
        <!-- Products Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
            @if($trashedProducts->count() > 0)
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Product Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Deleted At</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashedProducts as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $product->categories->pluck('name')->join(', ') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $product->price }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $product->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $product->deleted_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    <button type="button"
                                        class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600 transition duration-200"
                                        data-restore-open data-id="{{ $product->id }}">
                                        <i class="fa-solid fa-trash-restore"></i> Restore
                                    </button>
                                    <button type="button"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200"
                                        data-force-delete-open data-id="{{ $product->id }}">
                                        <i class="fa-solid fa-trash"></i> Delete Permanently
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-4">
                    <p class="text-gray-500 text-lg">No trashed products found.</p>
                </div>
            @endif
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $trashedProducts->links() }}
        </div>
    </div>

    <!-- Restore Confirmation Modal -->
    <div id="restoreModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Restore Product</h2>
            <p class="text-gray-600">Are you sure you want to restore this product?</p>
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
            <p class="text-gray-600">This will permanently delete the product. This action cannot be undone.</p>
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
            var productId = $(this).data('id');
            $('#restoreForm').attr('action', '/admin/product/trashed/' + productId + '/restore');
            $('#restoreModal').removeClass('hidden');
        });

        $('#cancelRestore').click(function () {
            $('#restoreModal').addClass('hidden');
        });

        // Force delete modal
        $('[data-force-delete-open]').click(function () {
            var productId = $(this).data('id');
            $('#forceDeleteForm').attr('action', '/admin/product/trashed/' + productId + '/force-delete');
            $('#forceDeleteModal').removeClass('hidden');
        });

        $('#cancelForceDelete').click(function () {
            $('#forceDeleteModal').addClass('hidden');
        });
    });
</script>