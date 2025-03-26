<x-layout>
    <x-slot:heading>Cart</x-slot:heading>
    <section class="min-h-screen bg-gray-50 py-8 lg:py-12">
        <div class="container mx-auto max-w-[1200px] px-4 lg:px-8">
            <div class="lg:flex lg:gap-8">
                <!-- Cart Items Section -->
                <section class="flex-grow px-4 lg:px-0">
                    @if(!$is_empty)
                        <div class="overflow-x-auto border border-gray-200 shadow-sm">
                            <table class="w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-sm font-semibold text-gray-600">ITEM
                                        </th>
                                        <th scope="col" class="px-6 py-4 text-center text-sm font-semibold text-gray-600">
                                            PRICE</th>
                                        <th scope="col" class="px-6 py-4 text-center text-sm font-semibold text-gray-600">
                                            QUANTITY</th>
                                        <th scope="col" class="px-6 py-4 text-center text-sm font-semibold text-gray-600">
                                            TOTAL</th>
                                        <th scope="col" class="px-6 py-4 text-center text-sm font-semibold text-gray-600">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($cart as $id => $item)
                                        <tr class="hover:bg-gray-50" data-slug="{{ $item['slug'] }}">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-4">
                                                    <img class="h-20 w-20 object-cover"
                                                        src="{{ asset('storage/' . $item['image']) }}"
                                                        alt="{{ $item['name'] }}" />
                                                    <div>
                                                        <h3 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center text-sm text-gray-500">
                                                &#36;{{ number_format($item['price'], 2) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center space-x-1">
                                                    <form
                                                        action="{{ route('cart.update', ['slug' => $item['slug'], 'action' => 'decrement']) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button data-slug="{{ $item['slug'] }}" data-action="decrement"
                                                            type="submit"
                                                            class="update-cart inline-flex h-8 w-8 items-center justify-center border border-gray-300 bg-white text-gray-500 transition-colors hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                    <span class="quantity-value w-8 text-center text-sm">{{ $item['quantity'] }}</span>
                                                    <form
                                                        action="{{ route('cart.update', ['slug' => $item['slug'], 'action' => 'increment']) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button data-slug="{{ $item['slug'] }}" data-action="increment"
                                                            type="submit"
                                                            class="update-cart inline-flex h-8 w-8 items-center justify-center border border-gray-300 bg-white text-gray-500 transition-colors hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center text-sm font-medium text-gray-900 item-total">
                                                &#36;{{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <form action="{{ route('cart.remove', ['slug' => $item['slug']]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button data-slug="{{ $item['slug'] }}" type="submit"
                                                        class="remove-from-cart text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                        <span class="sr-only">Remove item</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="h-5 w-5">
                                                            <path fill-rule="evenodd"
                                                                d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="border border-gray-200 bg-white p-6 text-center shadow-sm">
                            <p class="text-lg text-gray-500">Your cart is empty.</p>
                        </div>
                    @endif
                </section>

                <!-- Order Summary Section -->
                <section class="mt-8 w-full lg:mt-0 lg:w-80">
                    <div class="sticky top-8">
                        <x-order-summary :cart_total="$cart_total" :cart_count="$cart_count">
                            <a href="/checkout-address" class="mt-6 block">
                                <button
                                    class="w-full bg-violet-900 px-5 py-3 text-sm font-medium text-white transition-colors hover:bg-violet-800 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2">
                                    Proceed to checkout
                                </button>
                            </a>
                        </x-order-summary>
                    </div>
                </section>
            </div>
    </section>
</x-layout>