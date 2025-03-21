<x-layout>
    <x-slot:heading>Checkout</x-slot:heading>
    <div class="flex-grow flex justify-center items-center min-h-screen bg-gray-100 px-4">
        <section class="w-full max-w-3xl p-6">
            <div class="text-center">
                <p class="text-3xl font-bold text-gray-800">We Accepted your order!</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="mx-auto my-4 h-16 w-16 text-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                </svg>
                <p class="text-gray-700">Thank you, <span class="font-bold">{{ $customer->name }}</span></p>
                <p class="text-gray-600">Your order is confirmed!</p>
            </div>

            <!-- Order Details -->
            <div class="mt-6 bg-gray-50 rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800">Order Summary</h2>
                <div class="overflow-x-auto">
                    <table class="w-full mt-4 border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200 text-gray-700">
                                <th class="p-3 border">Product</th>
                                <th class="p-3 border">Quantity</th>
                                <th class="p-3 border">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $item)
                                <tr class="text-gray-700">
                                    <td class="p-3 border">{{ $item['name'] }}</td>
                                    <td class="p-3 border text-center">{{ $item['quantity'] }}</td>
                                    <td class="p-3 border text-right"> {{ number_format($item['price']) }} ₹</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-right mt-4">
                    <p class="text-lg font-semibold text-gray-800">Total: {{ number_format($total) }} ₹</p>
                </div>
            </div>

            <!-- Back to Home Button -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="bg-violet-900 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                    Back to Home
                </a>
            </div>
        </section>
    </div>
</x-layout>
