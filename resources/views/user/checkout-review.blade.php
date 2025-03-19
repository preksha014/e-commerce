<!doctype html>
<html lang="en">

<head>
    @include('partials.meta')
    <title>Checkout</title>
</head>

<body x-data="{ desktopMenuOpen: false, mobileMenuOpen: false}">
    @include('partials.head')
    <main class="h-screen flex flex-col justify-between">

        @include('partials.nav')

        <div class="flex-grow">
            <section class="container mx-auto max-w-[1200px] py-5 lg:flex lg:flex-row lg:py-10">
                <h2 class="mx-auto px-5 text-2xl font-bold md:hidden">
                    Checkout Review
                </h2>
                <!-- form  -->
                <section class="grid w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10">
          <x-table activeColumn="order"/>

                    <!-- Mobile product table  -->
                    <section class="container mx-auto my-3 flex w-full flex-col gap-3 md:hidden">
                        <!-- 1 -->

                        <div class="flex w-full border px-4 py-4">
                            <img class="self-start object-contain" width="90px"
                                src="{{asset('src/assets/images/bedroom.png')}}" alt="bedroom image" />
                            <div class="ml-3 flex w-full flex-col justify-center">
                                <div class="flex items-center justify-between">
                                    <p class="text-xl font-bold">ITALIAN BED</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path
                                            d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-400">Size: XL</p>
                                <p class="py-3 text-xl font-bold text-violet-900">$320</p>
                                <div class="mt-2 flex w-full items-center justify-between">
                                    <div class="flex items-center justify-center">
                                        <div class="flex cursor-text items-center justify-center active:ring-gray-500">
                                            Quantity: 1
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2 -->

                        <div class="flex w-full border px-4 py-4">
                            <img class="self-start object-contain" width="90px"
                                src="{{asset('src/assets/images/product-chair.png')}}" alt="Chair image" />
                            <div class="ml-3 flex w-full flex-col justify-center">
                                <div class="flex items-center justify-between">
                                    <p class="text-xl font-bold">GUYER CHAIR</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path
                                            d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-400">Size: XL</p>
                                <p class="py-3 text-xl font-bold text-violet-900">$320</p>
                                <div class="mt-2 flex w-full items-center justify-between">
                                    <div class="flex items-center justify-center">
                                        <div class="flex cursor-text items-center justify-center active:ring-gray-500">
                                            Quantity: 1
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3 -->

                        <div class="flex w-full border px-4 py-4">
                            <img class="self-start object-contain" width="90px" src="./assets/images/outdoors.png"
                                alt="Outdoor chair image" />
                            <div class="ml-3 flex w-full flex-col justify-center">
                                <div class="flex items-center justify-between">
                                    <p class="text-xl font-bold">OUTDOOR CHAIR</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path
                                            d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-400">Size: XL</p>
                                <p class="py-3 text-xl font-bold text-violet-900">$320</p>
                                <div class="mt-2 flex w-full items-center justify-between">
                                    <div class="flex items-center justify-center">
                                        <div class="flex cursor-text items-center justify-center active:ring-gray-500">
                                            Quantity: 1
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4 -->

                        <div class="flex w-full border px-4 py-4">
                            <img class="self-start object-contain" width="90px" src="./assets/images/matrass.png"
                                alt="Matrass image" />
                            <div class="ml-3 flex w-full flex-col justify-center">
                                <div class="flex items-center justify-between">
                                    <p class="text-xl font-bold">MATRASS COMFORT &plus;</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="h-5 w-5">
                                        <path
                                            d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z" />
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-400">Size: XL</p>
                                <p class="py-3 text-xl font-bold text-violet-900">$320</p>
                                <div class="mt-2 flex w-full items-center justify-between">
                                    <div class="flex items-center justify-center">
                                        <div class="flex cursor-text items-center justify-center active:ring-gray-500">
                                            Quantity: 1
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /Mobile product table  -->

                    <!-- Product table  -->

                    <table class="mt-3 hidden w-full lg:table">
                        <thead class="h-16 bg-neutral-100">
                            <tr>
                                <th>ITEM</th>
                                <th>PRICE</th>
                                <th>QUANTITY</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 1 -->

                            <tr class="h-[100px] border-b">
                                <td class="align-middle">
                                    <div class="flex">
                                        <img class="w-[90px]" src="./assets/images/bedroom.png" alt="bedroom image" />
                                        <div class="ml-3 flex flex-col justify-center">
                                            <p class="text-xl font-bold">ITALIAN BED</p>
                                            <p class="text-sm text-gray-400">Size: XL</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="mx-auto text-center">&#36;320</td>
                                <td class="text-center align-middle">1</td>
                                <td class="mx-auto text-center">&#36;320</td>
                            </tr>

                            <!-- 2 -->

                            <tr class="h-[100px] border-b">
                                <td class="align-middle">
                                    <div class="flex">
                                        <img class="w-[90px]" src="./assets/images/product-chair.png"
                                            alt="Chair Image" />
                                        <div class="ml-3 flex flex-col justify-center">
                                            <p class="text-xl font-bold">GUYER CHAIR</p>
                                            <p class="text-sm text-gray-400">Size: XL</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="mx-auto text-center">&#36;320</td>
                                <td class="text-center align-middle">1</td>
                                <td class="mx-auto text-center">&#36;320</td>
                            </tr>

                            <!-- 3 -->

                            <tr class="h-[100px] border-b">
                                <td class="align-middle">
                                    <div class="flex">
                                        <img class="w-[90px]" src="./assets/images/outdoors.png"
                                            alt="Outdoor furniture" />
                                        <div class="ml-3 flex flex-col justify-center">
                                            <p class="text-xl font-bold">OUTDOOR CHAIR</p>
                                            <p class="text-sm text-gray-400">Size: XL</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="mx-auto text-center">&#36;320</td>
                                <td class="text-center align-middle">1</td>
                                <td class="mx-auto text-center">&#36;320</td>
                            </tr>

                            <!-- 4 -->

                            <tr class="h-[100px]">
                                <td class="align-middle">
                                    <div class="flex">
                                        <img class="w-[90px]" src="./assets/images/matrass.png" alt="Matrass Image" />
                                        <div class="ml-3 flex flex-col justify-center">
                                            <p class="text-xl font-bold">MATRASS COMFORT &plus;</p>
                                            <p class="text-sm text-gray-400">Size: XL</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="mx-auto text-center">&#36;320</td>
                                <td class="text-center align-middle">1</td>
                                <td class="mx-auto text-center">&#36;320</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- /Product table  -->

                    <div class="flex w-full items-center justify-between">
                        <a href="catalog.html" class="hidden text-sm text-violet-900 lg:block">&larr; Back to the
                            shop</a>

                        <div class="mx-auto flex justify-center gap-2 lg:mx-0">
                            <a href="/checkout-payment" class="bg-purple-900 px-4 py-2 text-white">Previous step</a>

                            <a href="/checkout-confirmation" class="bg-amber-400 px-4 py-2">Place Order</a>
                        </div>
                    </div>
                </section>
                <!-- /form  -->

                <!-- Summary  -->
                <x-order-summary :cart_total="session('cart_total', 0)" :cart_count="session('cart_count', 0)" />

            </section>

            @include('partials.footer')
</body>

</html>