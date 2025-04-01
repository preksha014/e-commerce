<x-layout>
    <x-slot:heading>Checkout</x-slot:heading>
    <div class="flex-grow">
        <section class="container mx-auto max-w-[1200px] py-5 lg:flex lg:flex-row lg:py-10">
            <section class="grid w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10">
                <x-table activeColumn="address" />
                <div class="py-5">
                    <!-- Existing Addresses Section -->
                    @if($addresses->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Select an existing address</h3>
                        <form action="{{ route('checkout.address.store') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                @foreach($addresses as $address)
                                <div class="flex items-start p-4 border rounded-lg">
                                    <input type="radio" name="address_id" value="{{ $address->id }}"
                                        class="mt-1 mr-3" required />
                                    <div>
                                        <p class="font-medium">{{ $address->recipient_name }}</p>
                                        <p>{{ $address->street }}</p>
                                        <p>{{ $address->city }}, {{ $address->zipcode }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button type="submit" class="bg-amber-400 px-4 py-2 mt-4">Continue with selected address</button>
                        </form>
                    </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">Or add a new shipping address</h3>
                    </div>

                    <form class="flex w-full flex-col gap-3" action="{{ route('checkout.address.store') }}"
                        method="POST">
                        @csrf
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
                                <label for="zipcode">ZIP Code <span class="text-red-500">*</span></label>
                                <input class="w-full border px-4 py-2 outline-yellow-400" type="text" name="zipcode"
                                    placeholder="176356" />
                                @error('zipcode')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex w-1/2 flex-col">
                                <label for="recipient_name">Recipient <span class="text-red-500">*</span></label>
                                <input class="w-full border px-4 py-2 outline-yellow-400" type="text"
                                    name="recipient_name" placeholder="Andrew Johnson" />
                                @error('recipient_name')
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center mb-4">
                            <input type="checkbox" name="set_as_default" id="set_as_default" class="mr-2">
                            <label for="set_as_default">Save to my addresses</label>
                        </div>

                        <div class="flex w-full items-center justify-between">
                            <a href="/catalog" class="text-sm text-violet-900">← Back to the shop</a>
                            <button type="submit" class="bg-amber-400 px-4 py-2">Continue with new address</button>
                        </div>
                    </form>
                </div>
            </section>
            <x-order-summary :cart_total="session('cart_total', 0)" :cart_count="session('cart_count', 0)" />
        </section>
    </div>
</x-layout>