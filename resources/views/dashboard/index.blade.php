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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="even:bg-gray-100 text-gray-700">
                            <td class="py-3 px-4 border border-gray-300">{{ $product->name }}</td>
                            <td class="py-3 px-4 border border-gray-300 max-w-xs break-words">
                                {{ $product->description }}
                            </td>
                            {{-- <td class="py-3 px-4 border border-gray-300">{{ $product->description }}</td> --}}
                            <td class="py-3 px-4 border border-gray-300">{{ $product->size}}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->color}}</td>
                            <td class="py-3 px-4 border border-gray-300">
                                {{ $product->categories->pluck('name')->join(', ') }}
                            </td>

                            {{-- <td class="py-3 px-4 border border-gray-300">{{ $product->category->name }}</td> --}}
                            <td class="py-3 px-4 border border-gray-300">{{ $product->price }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->quantity }}</td>
                            <td class="py-3 px-4 border border-gray-300">{{ $product->status }}</td>
                            <td class="py-3 px-4 border border-gray-300">
                                @foreach ($product->images as $image)
                                    <img src="{{ asset('storage/' . $image->image) }}" class="w-20 h-20 object-cover"
                                        alt="Product Image">
                                @endforeach

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