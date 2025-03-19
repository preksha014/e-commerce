<!doctype html>
<html lang="en">

<head>
  @include('partials.meta')
  <title>Big Italian Sofa</title>
</head>

<body x-data="{ desktopMenuOpen: false, mobileMenuOpen: false}">
  @include('partials.head')
  <main class="flex flex-col h-screen justify-between">

    @include('partials.nav')

    <div class="flex-grow">
      <section class="container mx-auto max-w-[1200px] py-5 lg:flex lg:flex-row lg:py-10">
        <!-- form  -->
        <section class="grid w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10">
          <x-table activeColumn="address" />
          <div class="py-5">
            <form class="flex w-full flex-col gap-3" action="">
              <div class="flex w-full justify-between gap-2">
                <div class="flex w-1/2 flex-col">
                  <label class="flex" for="name">Full Name<span
                      class="block text-sm font-medium text-slate-700 after:ml-0.5 after:text-red-500 after:content-['*']"></span></label>
                  <input class="w-full border px-4 py-2 outline-yellow-400" type="text" placeholder="Sarah Johnson" />
                </div>

                <div class="flex w-1/2 flex-col">
                  <label class="flex" for="name">Email Address<span
                      class="block text-sm font-medium text-slate-700 after:ml-0.5 after:text-red-500 after:content-['*']"></span></label>
                  <input class="w-full border px-4 py-2 outline-yellow-400" type="text" placeholder="sarahj@maybell.com"
                    name="" id="" />
                </div>
              </div>

              <div class="flex w-full justify-between gap-2">
                <div class="flex w-1/2 flex-col">
                  <label class="flex" for="name">Street<span
                      class="block text-sm font-medium text-slate-700 after:ml-0.5 after:text-red-500 after:content-['*']"></span></label>
                  <input class="w-full border px-4 py-2 outline-yellow-400" type="text"
                    placeholder="Big Serbian avenue, 18" />
                </div>

                <div class="flex w-1/2 flex-col">
                  <label class="flex" for="name">City<span
                      class="block text-sm font-medium text-slate-700 after:ml-0.5 after:text-red-500 after:content-['*']"></span></label>
                  <input class="w-full border px-4 py-2 outline-yellow-400" type="text" placeholder="Belgrade" name=""
                    id="" />
                </div>
              </div>

              <div class="flex w-full justify-between gap-2">
                <div class="flex w-1/2 flex-col">
                  <label class="flex" for="name">ZIP code<span
                      class="block text-sm font-medium text-slate-700 after:ml-0.5 after:text-red-500 after:content-['*']"></span></label>
                  <input x-mask="999999" class="w-full border px-4 py-2 outline-yellow-400" placeholder="176356" />
                </div>

                <div class="flex w-1/2 flex-col">
                  <label class="flex" for="name">Recipient<span
                      class="block text-sm font-medium text-slate-700 after:ml-0.5 after:text-red-500 after:content-['*']"></span></label>
                  <input class="w-full border px-4 py-2 outline-yellow-400" type="text" placeholder="Andrew Johnson"
                    name="" id="" />
                </div>
              </div>

              <div class="flex flex-col">
                <label for="">Commentary</label>
                <textarea class="border px-4 py-2 outline-yellow-400" type="text"></textarea>
              </div>
            </form>
          </div>

          <div class="flex w-full items-center justify-between">
            <a href="/catalog" class="text-sm text-violet-900">&larr; Back to the shop</a>

            <a href="/checkout-payment" class="bg-amber-400 px-4 py-2">Place an order</a>
          </div>
        </section>
        <!-- /form  -->

        <!-- Summary  -->
        <x-order-summary :cart_total="session('cart_total', 0)" :cart_count="session('cart_count', 0)" />

    </div>
    @include('partials.footer')
</body>

</html>