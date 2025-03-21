<x-dashboard-layout>
    <x-slot:heading>Order Details</x-slot:heading>

    <div class="p-6 w-full bg-white rounded-lg shadow-md">
        <!-- Order Summary -->
        <h2 class="text-2xl font-semibold mb-6">Order #{{ $order->id }}</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-6">
            <div class="p-4 bg-gray-100 rounded-lg flex flex-col justify-center items-center text-center">
                <strong class="text-gray-700 text-lg font-bold">Customer Name:</strong>
                <span class="text-xl font-bold">{{ $order->customer->name }}</span>
            </div>

            <div class="p-4 bg-gray-100 rounded-lg flex flex-col justify-center items-center text-center">
                <strong class="text-gray-700 text-lg font-bold">Total Amount:</strong>
                <span class="text-xl font-bold text-green-600">{{ number_format($order->total_amount) }} ₹</span>
            </div>

            <div class="p-4 bg-gray-100 rounded-lg">
                <form action="{{ route('admin.order.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <label for="status" class="block text-gray-700 text-lg font-bold mb-2">Status:</label>

                    <select name="status" id="status"
                        class="w-full mt-2 px-3 py-2 rounded-md border border-gray-300 text-gray-700 focus:outline-none focus:ring focus:ring-blue-300">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered
                        </option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                    </select>

                    <button type="submit"
                        class="mt-4 w-full bg-blue-500 text-white py-2 rounded-md font-semibold hover:bg-blue-600 transition-all">
                        Update
                    </button>
                </form>
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
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $item->product->name }}"
                                                class="w-12 h-12 object-cover border">
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td class="border px-5 py-3">{{ $item->quantity }}</td>
                            <td class="border px-5 py-3 text-green-600 font-semibold">{{ number_format($item->price) }} ₹
                            </td>
                            <td class="border px-5 py-3 font-semibold text-blue-600">
                                {{ number_format($item->quantity * $item->price) }} ₹
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