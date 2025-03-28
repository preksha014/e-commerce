<x-dashboard-layout>
    <x-slot:heading>Products</x-slot:heading>

    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-700">Products Management</h2>
            <div class="flex space-x-3">
                <a href="{{ route('admin.product.trashed') }}"
                    class="bg-gray-600 text-white px-5 py-2 rounded-md shadow-md hover:bg-gray-700 transition">
                    <i class="fa-solid fa-trash"></i> Trash
                </a>
                <a href="{{ route('admin.product.create') }}"
                    class="bg-blue-600 text-white px-5 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
                    + Add Product
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
        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-300 text-left text-gray-700">
                        <th class="py-3 px-4 border border-gray-300">Product Name</th>
                        <th class="py-3 px-4 border border-gray-300">Category</th>
                        <th class="py-3 px-4 border border-gray-300">Price</th>
                        <th class="py-3 px-4 border border-gray-300">Status</th>
                        <th class="py-3 px-4 border border-gray-300">Images</th>
                        <th class="py-3 px-4 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
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
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->image) }}" class="w-20 h-20 object-cover"
                                        alt="Product Image">
                                @endforeach

                            </td>
                            <td class="py-3 px-4 space-x-2 border border-gray-300">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                    class="bg-green-500 text-white px-3 py-2 rounded-md shadow-md hover:bg-green-600 transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="{{ route('admin.product.show', $product->id) }}"
                                    class="bg-blue-500 text-white px-3 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <button type="button"
                                    class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200"
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