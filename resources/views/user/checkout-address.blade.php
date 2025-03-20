<x-layout>
    <x-slot:heading>Checkout</x-slot:heading>
    <div class="flex-grow">
        <section class="container mx-auto max-w-[1200px] py-5 lg:flex lg:flex-row lg:py-10">
            <!-- form  -->
            <section class="grid w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10">
                <x-table activeColumn="address" />
                <div class="py-5">
                    <form class="flex w-full flex-col gap-3" action="{{ route('checkout.address.store') }}"
                        method="POST">
                        @csrf
                        <div class="flex w-full justify-between gap-2">
                            <div class="flex w-1/2 flex-col">
                                <label for="name">Full Name <span class="text-red-500">*</span></label>
                                <input class="w-full border px-4 py-2 outline-yellow-400" type="text" name="name"
                                    value="{{ old('name', $customer->name) }}" />
                                @error('name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="flex w-1/2 flex-col">
                                <label for="email">Email Address <span class="text-red-500">*</span></label>
                                <input class="w-full border px-4 py-2 outline-yellow-400" type="email" name="email"
                                    value="{{ old('email', $customer->email) }}" />
                                @error('email')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="flex w-full justify-between gap-2">
                            <div class="flex w-1/2 flex-col">
                                <label for="street">Street <span class="text-red-500">*</span></label>
                                <input class="w-full border px-4 py-2 outline-yellow-400" type="text" name="street"
                                    placeholder="Big Serbian avenue, 18" />
                                @error('street')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="flex w-1/2 flex-col">
                                <label for="city">City <span class="text-red-500">*</span></label>
                                <input class="w-full border px-4 py-2 outline-yellow-400" type="text" name="city"
                                    placeholder="Belgrade" />
                                @error('city')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                        </div>

                        <div class="flex w-full justify-between gap-2">
                            <div class="flex w-1/2 flex-col">
                                <label for="zip_code">ZIP Code <span class="text-red-500">*</span></label>
                                <input class="w-full border px-4 py-2 outline-yellow-400" type="text" name="zipcode"
                                    placeholder="176356" />
                                @error('zipcode')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="flex w-1/2 flex-col">
                                <label for="recipient">Recipient <span class="text-red-500">*</span></label>
                                <input class="w-full border px-4 py-2 outline-yellow-400" type="text"
                                    name="recipient_name" placeholder="Andrew Johnson" />
                                @error('recipient_name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div class="flex w-full items-center justify-between">
                            <a href="/catalog" class="text-sm text-violet-900">&larr; Back to the shop</a>
                            <button type="submit" class="bg-amber-400 px-4 py-2">Place an order</button>
                        </div>
                    </form>
                </div>
            </section>
            <!-- /form  -->

            <!-- Summary  -->
            <x-order-summary :cart_total="session('cart_total', 0)" :cart_count="session('cart_count', 0)" />

    </div>
</x-layout>