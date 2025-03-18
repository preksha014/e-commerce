<x-dashboard-layout>
    <x-slot:heading>Admin Dashboard</x-slot:heading>
    <!-- Main Content -->
    <div class="flex-grow p-8">
        <!-- Summary Cards -->
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold text-gray-700">Total Products</h3>
                <p class="text-2xl text-gray-600">120</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold text-gray-700">Total Orders</h3>
                <p class="text-2xl text-gray-600">350</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold text-gray-700">Total Customers</h3>
                <p class="text-2xl text-gray-600">1,200</p>
            </div>
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
                            <td class="py-3 px-4 border border-gray-300">{{ $product->size}}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->color}}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->category->name }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->price }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->quantity }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->status }}</td>
                            <td class="py-3 px-4 border border-gray-300">
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Product Image"
                                        class="w-16 h-16 object-cover">
                                @endforeach

                            </td>
                            <td class="py-3 px-4 space-x-2 border border-gray-300">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                    class="bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-600 transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-red-600 transition duration-200"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <!-- More Products Here -->
                </tbody>
            </table>
        </div>

        <!-- Order Status Table -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-700 mb-4">Order Status</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-200 text-left">
                        <th class="py-3 px-4 border border-gray-300">Order ID</th>
                        <th class="py-3 px-4 border border-gray-300">Customer</th>
                        <th class="py-3 px-4 border border-gray-300">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="even:bg-gray-100">
                        <td class="py-3 px-4 border border-gray-300">#1001</td>
                        <td class="py-3 px-4 border border-gray-300">John Doe</td>
                        <td class="py-3 px-4 border border-gray-300">Shipped</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>