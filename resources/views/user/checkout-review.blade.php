{{-- {{ dd($cartItems) }} --}}
<x-layout>
    <x-slot:heading>Checkout</x-slot:heading>
    <div class="flex-grow">
        <section class="container mx-auto max-w-[1200px] py-5 lg:flex lg:flex-row lg:py-10">
            <h2 class="mx-auto px-5 text-2xl font-bold md:hidden">
                Checkout Review
            </h2>
            <!-- form  -->
            <section class="grid w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10">
                <x-table activeColumn="order" />    

                <!-- Product table  -->

                <table class="mt-3 hidden w-full lg:table">
                    <thead class="h-16 bg-neutral-100">
                        <tr>
                            <th>ITEM</th>
                            <th>QUANTITY</th>
                            <th>PRICE</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1 -->
                        {{-- {{ dd($cartItems) }} --}}
                        @foreach($cartItems as $id => $item)
                        {{-- {{ dd($item) }} --}}
                        <tr class="h-[100px] border-b">
                            <td class="align-middle">
                                <div class="flex">
                                    <img class="w-[90px]" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" />
                                    <div class="ml-3 flex flex-col justify-center">
                                        <p class="text-xl font-bold">{{ $item['name'] }}</p>
                                        {{-- <p class="text-sm text-gray-400">Size: XL</p> --}}
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="mx-auto text-center">&#36;320</td> --}}
                            <td class="text-center align-middle">{{ $item['quantity'] }}</td>
                            {{-- <td class="mx-auto text-center">&#36;320</td> --}}

                            <td class="px-6 py-4 text-center text-sm font-medium text-gray-900">
                                {{ number_format($item['price']) }} ₹
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-medium text-gray-900">
                                {{ number_format($item['price'] * $item['quantity']) }} ₹
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- /Product table  -->

                <div class="flex w-full items-center justify-between">
                    <a href="/catalog" class="hidden text-sm text-violet-900 lg:block">&larr; Back to the
                        shop</a>

                    <div class="mx-auto flex justify-center gap-2 lg:mx-0">
                        <a href="/checkout-payment" class="bg-purple-900 px-4 py-2 text-white">Previous step</a>
                        <form action="{{ route('checkout.place.order') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-amber-400 px-4 py-2">Place Order</button>
                        </form>
                        {{-- <a href="{{ route('checkout.place.order') }}" class="bg-amber-400 px-4 py-2">Place Order</a> --}}
                    </div>
                </div>
            </section>
            <!-- /form  -->

            <!-- Summary  -->
            <x-order-summary :cart_total="session('cart_total', 0)" :cart_count="session('cart_count', 0)" />

        </section>
    </div>
</x-layout>