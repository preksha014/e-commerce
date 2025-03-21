<x-dashboard-layout>
    <x-slot:heading>
        Admin Dashboard
    </x-slot:heading>

    <div class="flex-grow p-8 space-y-8">
        <!-- Summary Cards -->
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
            @foreach ([
                ['title' => 'Total Products', 'count' => $totalProducts],
                ['title' => 'Total Orders', 'count' => $totalOrders],
                ['title' => 'Total Customers', 'count' => $totalCustomers],
            ] as $card)
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-xl font-bold text-gray-700">{{ $card['title'] }}</h3>
                    <p class="text-2xl text-gray-600">{{ number_format($card['count']) }}</p>
                </div>
            @endforeach
        </div>

        <!-- Products Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Products</h2>
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300">
                    <thead>
                        <tr class="bg-violet-300 text-gray-700 text-left">
                            @foreach ([
                                'Product Name', 'Description', 'Size', 'Color',
                                'Category', 'Price', 'Quantity', 'Status', 'Images'
                            ] as $header)
                                <th class="py-3 px-4 border border-gray-300">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="even:bg-gray-100 text-gray-700">
                                <td class="py-3 px-4 border border-gray-300">{{ $product->name }}</td>
                                <td class="py-3 px-4 border border-gray-300 max-w-xs break-words">{{ $product->description }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $product->size }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $product->color }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $product->categories->pluck('name')->join(', ') }}</td>
                                <td class="py-3 px-4 border border-gray-300">${{ number_format($product->price, 2) }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $product->quantity }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $product->status }}</td>
                                <td class="py-3 px-4 border border-gray-300 flex flex-wrap gap-2">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('storage/' . $image->image) }}" class="w-20 h-20 object-cover" alt="Product Image">
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $products->links() }}</div>
        </div>

        <!-- Order Status Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Order Status</h2>
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300">
                    <thead>
                        <tr class="bg-violet-300 text-gray-700 text-left">
                            @foreach (['Order ID', 'Customer', 'Status'] as $header)
                                <th class="py-3 px-4 border border-gray-300">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="even:bg-gray-100">
                                <td class="py-3 px-4 border border-gray-300">{{ $order->id }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $order->customer->name }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $orders->links() }}</div>
        </div>
    </div>
</x-dashboard-layout>
