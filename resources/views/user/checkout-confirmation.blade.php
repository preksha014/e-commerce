    <x-layout>
        <x-slot:heading>Checkout</x-slot:heading>
            <div class="flex-grow">
                <section class="mt-20 px-4">
                    <div class="flex flex-col">
                        <p class="text-center text-3xl font-bold">
                            We Accepted your order!
                        </p>
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="mx-auto my-3 h-[60px] w-[60px] text-green-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                            </svg>
                            <p>Thank you, <span class="font-bold">{{ $customer->name }}</span></p>
                            <p>Your order is confirmed!</p>
                            {{-- @foreach ($orders as $order) --}}
                            <p>{{$order}}</p>
                            {{-- @endforeach --}}

                        </div>
                    </div>
                </section>
            </div>
    </x-layout>