<x-dashboard-layout>
    <x-slot:heading>Order Details</x-slot:heading>

    <div class="p-6 w-full bg-white rounded-lg shadow-md">
        <!-- Order Summary -->
        <h2 class="text-2xl font-semibold mb-6">Order #{{ $order->id }}</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-6">
            <div class="p-4 bg-gray-100 rounded-lg">
                <strong class="block text-gray-700">Customer Name:</strong>
                <span class="text-lg font-semibold">{{ $order->customer->name }}</span>
            </div>
            <div class="p-4 bg-gray-100 rounded-lg">
                <strong class="block text-gray-700">Total Amount:</strong>
                <span class="text-lg font-semibold text-green-600">${{ number_format($order->total_amount, 2) }}</span>
            </div>
            <div class="p-4 bg-gray-100 rounded-lg">
                <strong class="block text-gray-700">Status:</strong>
                <span class="px-3 py-1 text-sm font-semibold text-white rounded-md
                    {{ $order->status === 'pending' ? 'bg-yellow-500' : ($order->status === 'completed' ? 'bg-green-500' : 'bg-red-500') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <!-- Order Items Table -->
        <h3 class="text-xl font-semibold mb-4">Order Items</h3>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg shadow-sm">
                <thead class="bg-gray-200">
                    <tr class="text-center text-gray-700">
                        <th class="border px-5 py-3">No</th>
                        <th class="border px-5 py-3">Product</th>
                        <th class="border px-5 py-3">Quantity</th>
                        <th class="border px-5 py-3">Price</th>
                        <th class="border px-5 py-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orderItems as $index => $item)
                        <tr class="text-center bg-white hover:bg-gray-50">
                            <td class="border px-5 py-3">{{ $index + 1 }}</td>
                            <td class="border px-5 py-3 flex items-center space-x-3">
                                <div>
                                    <p class="font-semibold">{{ $item->product->name }}</p>
                                    <div class="flex space-x-2 mt-1">
                                        @foreach ($item->product->images as $image)
                                            <img src="{{ asset('storage/' . $image->image) }}" 
                                                 alt="{{ $item->product->name }}"
                                                 class="w-12 h-12 object-cover border">
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td class="border px-5 py-3">{{ $item->quantity }}</td>
                            <td class="border px-5 py-3 text-green-600 font-semibold">${{ number_format($item->price, 2) }}</td>
                            <td class="border px-5 py-3 font-semibold text-blue-600">
                                ${{ number_format($item->quantity * $item->price, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center border px-5 py-3 text-gray-500">No items found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
