@props(['cart_total', 'cart_count' ])

<section class="mx-auto w-full px-4 md:max-w-[400px]">
    <div class="border py-5 px-4 shadow-md">
        <p class="font-bold">ORDER SUMMARY</p>
        <div class="flex justify-between border-b py-5">
            <p>Subtotal</p>
            <p>&#36;{{ number_format($cart_total, 2) }}</p>
        </div>
        <div class="flex justify-between border-b py-5">
            <p>Shipping</p>
            <p>Free</p>
        </div>
        <div class="flex justify-between py-5">
            <p>Total</p>
            <p>&#36;{{ number_format($cart_total, 2) }}</p>
        </div>
        {{ $slot }}
        {{-- <a href="/checkout-address">
            <button class="w-full bg-violet-900 px-5 py-2 text-white">Proceed to checkout</button>
        </a> --}}
    </div>
</section>