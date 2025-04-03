<x-dashboard-layout>
    <x-slot:heading>Products</x-slot:heading>

    <div class="p-8 space-y-8">
        <!-- Header Section with Actions -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 bg-white p-6 rounded-xl shadow-sm">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Products Management</h2>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.product.trashed') }}"
                    class="px-4 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <i class="fa-solid fa-trash mr-2"></i>Trash
                </a>
                <a href="{{ route('admin.product.create') }}"
                    class="px-4 py-2 bg-violet-50 text-violet-600 rounded-lg hover:bg-violet-100 transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>Add Product
                </a>
            </div>
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
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Product Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Images</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $product->categories->pluck('name')->join(', ') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $product->price }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-sm rounded-full {{ $product->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $product->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex -space-x-2">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('storage/' . $image->image) }}" class="w-10 h-10 rounded-lg object-cover border-2 border-white"
                                            alt="Product Image">
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                        class="p-2 bg-violet-50 text-violet-600 rounded-lg hover:bg-violet-100 transition-colors duration-200">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ route('admin.product.show', $product->id) }}"
                                        class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button type="button"
                                        class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors duration-200"
                                        data-action-open data-id="{{ $product->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Are you sure?</h2>
                <p class="text-gray-600">Do you really want to delete this product? <br> This action cannot be undone.
                </p>
                <div class="mt-4 flex justify-end space-x-2">
                    <button id="cancelDelete"
                        class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600 transition duration-200">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
</x-dashboard-layout>

<script>
    $(document).ready(function () {
        // Open modal and set product ID
        $('[data-action-open]').click(function () {
            var productId = $(this).data('id');
            $('#deleteForm').attr('action', '/admin/product/' + productId + '/delete');
            $('#deleteModal').removeClass('hidden');
        });

        // Close modal
        $('#cancelDelete').click(function () {
            $('#deleteModal').addClass('hidden');
        });
    });
</script>