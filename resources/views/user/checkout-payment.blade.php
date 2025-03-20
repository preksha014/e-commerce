<x-layout>
  <x-slot:heading>Checkout</x-slot:heading>
  <section class="flex-grow">
    <section class="container mx-auto max-w-[1200px] py-5 lg:flex lg:flex-row lg:py-10">
      <h2 class="mx-auto px-5 text-2xl font-bold md:hidden">
        Payment Method
      </h2>

      <!-- form  -->
      <section class="grid w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10">
        <x-table activeColumn="payment" />

        <div class="py-5">
          <form class="flex w-full flex-col gap-3" action="{{ route('checkout.payment.store') }}" method="POST">
            @csrf
            <h2 class="text-xl font-medium">Select Payment Method:</h2>
            <div class="flex flex-col gap-2">
              <label class="flex items-center gap-2">
                <input type="radio" name="payment_method" value="cod" />
                Cash on Delivery (COD)
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" name="payment_method" value="paypal" />
                PayPal
              </label>
              <label class="flex items-center gap-2">
                <input type="radio" name="payment_method" value="upi" />
                UPI
              </label>
              @error('payment_method')
          <p class="text-red-500">{{ $message }}</p>
        @enderror
            </div>
            <div class="flex w-full items-center justify-between">
              <a href="/catalog" class="hidden text-sm text-violet-900 lg:block">&larr; Back to the shop</a>
              <div class="mx-auto flex justify-center gap-2 lg:mx-0">
                <a href="/checkout-address" class="bg-purple-900 px-4 py-2 text-white">Previous step</a>
                <button type="submit" class="bg-amber-400 px-4 py-2">Checkout review</button>
              </div>
            </div>
          </form>
        </div>
      </section>
      <!-- /form  -->

      <!-- Summary  -->
      <x-order-summary :cart_total="session('cart_total', 0)" :cart_count="session('cart_count', 0)" />
    </section>
  </section>
</x-layout>


{{-- <x-layout>
  <x-slot:heading>Checkout</x-slot:heading>
  <section class="flex-grow">
    <section class="container mx-auto max-w-[1200px] py-5 lg:flex lg:flex-row lg:py-10">
      <h2 class="mx-auto px-5 text-2xl font-bold md:hidden">
        Payment Method
      </h2>
      <!-- form  -->
      <section class="grid w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10">
        <x-table activeColumn="payment" />


        <div class="py-5">
          <form class="flex w-full flex-col gap-3" action="">
            <div class="flex w-full flex-col">
              <label class="flex" for="name">Payment Card Number</label>
              <input x-mask="9999 9999 9999 9999" class="w-full border px-4 py-2 lg:w-1/2"
                placeholder="1223 4568 7644 4839" />
            </div>

            <div class="flex w-full flex-col">
              <label class="flex" for="name">Card Holder</label>
              <input class="w-full border px-4 py-2 lg:w-1/2" type="text" placeholder="SARAH JOHNSON" />
            </div>

            <div class="flex items-center gap-5 lg:w-1/2">
              <div class="flex flex-col">
                <label class="flex" for="name">Expiry Date</label>

                <div class="flex w-[150px] items-center gap-1">
                  <input x-mask="99" class="w-1/2 border px-4 py-2 text-center" name="" id="" placeholder="10" />

                  <span>&bsol;</span>

                  <input x-mask="99" class="w-1/2 border px-4 py-2 text-center" name="" id="" placeholder="36" />
                </div>
              </div>

              <div class="flex flex-col w-[60px] lg:w-[110px]">
                <label class="flex" for="">CVV/CVC</label>
                <input x-mask="999" class="w-full border py-2 text-center lg:w-1/2" type="password"
                  placeholder="&bull;&bull;&bull;" />
              </div>
            </div>

            <!-- another payment-methods -->

            <h2 class="mt-10 text-left text-xl font-medium">
              Another methods:
            </h2>
            <section class="my-4 grid w-fit grid-cols-3 gap-4 lg:grid-cols-5">
              <img class="w-[100px] cursor-pointer" src="{{ asset('src/assets/images/payment-method-paypal.svg')}}"
                alt="paypal icon" />
              <img class="w-[100px] cursor-pointer" src="{{ asset('src/assets/images/payment-method-visa.svg') }}"
                alt="visa icon" />
              <img class="w-[100px] cursor-pointer" src="{{ asset('src/assets/images/payment-method-mastercard.svg') }}"
                alt="mastercard icon" />
            </section>
            <!-- another payment-methods -->
          </form>
        </div>

        <div class="flex w-full items-center justify-between">
          <a href="/catalog" class="hidden text-sm text-violet-900 lg:block">&larr; Back to the shop</a>

          <div class="mx-auto flex justify-center gap-2 lg:mx-0">
            <a href="/checkout-address" class="bg-purple-900 px-4 py-2 text-white">Previous step</a>

            <a href="/checkout-review" class="bg-amber-400 px-4 py-2">Checkout review</a>
          </div>
        </div>
      </section>
      <!-- /form  -->

      <!-- Summary  -->
      <x-order-summary :cart_total="session('cart_total', 0)" :cart_count="session('cart_count', 0)" />

    </section>
  </section>
</x-layout> --}}