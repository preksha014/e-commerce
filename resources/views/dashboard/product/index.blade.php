<x-dashboard-layout>
    <x-slot:heading>Products</x-slot:heading>

    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-700">Products Management</h2>
            <a href="{{ route('admin.product.create') }}" class="bg-blue-500 text-white px-5 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
                Add Product
            </a>
        </div>

        <!-- Products Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-200 text-left text-gray-700">
                        <th class="py-3 px-4 border border-gray-300">Product Name</th>
                        <th class="py-3 px-4 border border-gray-300">Description</th>
                        <th class="py-3 px-4 border border-gray-300">Size</th>
                        <th class="py-3 px-4 border border-gray-300">Color</th>
                        <th class="py-3 px-4 border border-gray-300">Category</th>
                        <th class="py-3 px-4 border border-gray-300">Price</th>
                        <th class="py-3 px-4 border border-gray-300">Quantity</th>
                        <th class="py-3 px-4 border border-gray-300">Status</th>
                        <th class="py-3 px-4 border border-gray-300">Images</th>
                        <th class="py-3 px-4 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="even:bg-gray-100 text-gray-700">
                            <td class="py-3 px-4 border border-gray-300">{{ $product->name }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->description }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->size }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->color }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->category->name }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->price }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->quantity }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->status }}</td>
                            <td class="py-3 px-4 border border-gray-300">
                                {{-- <img src="{{ asset('storage/'.$product->images) }}"> --}}
                            </td>
                            <td class="py-3 px-4 border border-gray-300">
                                <button
                                    class="bg-green-500 text-white px-3 py-1 rounded-md shadow-md hover:bg-green-600 transition">
                                    Edit
                                </button>
                                <button
                                    class="bg-red-500 text-white px-3 py-1 rounded-md shadow-md ml-2 hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <!-- More Products Here -->
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>