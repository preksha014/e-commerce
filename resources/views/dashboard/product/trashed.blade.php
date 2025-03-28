<x-dashboard-layout>
    <x-slot:heading>Trashed Products</x-slot:heading>

    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-gray-700">Trashed Products</h2>
            <a href="{{ route('admin.product') }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow-md hover:bg-blue-700 transition duration-200">
                <i class="fa-solid fa-arrow-left"></i> Back to Products
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
        <div class="bg-white p-6 rounded-lg shadow-lg overflow-x-auto">
            @if($trashedProducts->count() > 0)
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-violet-300 text-left text-gray-700">
                            <th class="py-3 px-4 border border-gray-300">Product Name</th>
                            <th class="py-3 px-4 border border-gray-300">Category</th>
                            <th class="py-3 px-4 border border-gray-300">Price</th>
                            <th class="py-3 px-4 border border-gray-300">Status</th>
                            <th class="py-3 px-4 border border-gray-300">Deleted At</th>
                            <th class="py-3 px-4 border border-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashedProducts as $product)
                            <tr class="even:bg-gray-100 text-gray-700">
                                <td class="py-3 px-4 border border-gray-300">{{ $product->name }}</td>
                                <td class="py-3 px-4 border border-gray-300">
                                    {{ $product->categories->pluck('name')->join(', ') }}
                                </td>
                                <td class="py-3 px-4 border border-gray-300">{{ $product->price }}</td>
                                <td class="py-3 px-4 border border-gray-300">
                                    <span
                                        class="px-4 py-2 rounded-full text-white font-semibold text-lg {{ $product->status ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ $product->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 border border-gray-300">
                                    {{ $product->deleted_at->diffForHumans() }}
                                </td>
                                <td class="py-3 px-4 border border-gray-300 space-x-2">
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