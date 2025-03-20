@props(['cart_total', 'cart_count' ])

<section class="mx-auto w-full px-4 md:max-w-[400px]">
    <div class="border py-5 px-4 shadow-md">
        <p class="font-bold">ORDER SUMMARY</p>
        <div class="flex justify-between border-b py-5">
            <p>Subtotal</p>
            <p>{{ number_format($cart_total) }} ₹</p>
        </div>
        <div class="flex justify-between border-b py-5">
            <p>Shipping</p>
            <p>Free</p>
        </div>
        <div class="flex justify-between py-5">
            <p>Total</p>
            <p>{{ number_format($cart_total) }} ₹</p>
        </div>
        {{ $slot }}
    </div>
</section>