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

    <section class="container flex-grow mx-auto max-w-[1200px] border-b py-5 lg:grid lg:grid-cols-2 lg:py-10">
      <!-- image gallery -->

      <div class="container mx-auto px-4 flex items-middle">
        <img class="w-full" src="{{ asset('src/assets/images/product-bigsofa.png') }}" alt="Sofa image" />
      </div>
      <!-- /image gallery  -->
      </div>

      <!-- description  -->

      <div class="mx-auto px-5 lg:px-5">
        <h2 class="pt-3 text-2xl font-bold lg:pt-0">BIG ITALIAN SOFA</h2>

        <p class="mt-5 font-bold">
          Availability: <span class="text-green-600">In Stock</span>
        </p>

        <p class="font-bold">
          Category: <span class="font-normal">Sofa</span>
        </p>


        <p class="mt-4 text-xl font-bold text-violet-900">
          $450
        </p>

        <p class="pt-5 text-sm leading-5 text-gray-500">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem
          exercitationem voluptate sint eius ea assumenda provident eos
          repellendus qui neque! Velit ratione illo maiores voluptates commodi
          eaque illum, laudantium non!
        </p>

        <div class="mt-6">
          <p class="pb-2 text-xs text-gray-500">Size</p>

          <div class="flex gap-1">
            <div
              class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
              XS
            </div>
            <div
              class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
              S
            </div>
            <div
              class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
              M
            </div>

            <div
              class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
              L
            </div>

            <div
              class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
              XL
            </div>
          </div>
        </div>

        <div class="mt-6">
          <p class="pb-2 text-xs text-gray-500">Color</p>

          <div class="flex gap-1">
            <div
              class="h-8 w-8 cursor-pointer border border-white bg-gray-600 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
            </div>
            <div
              class="h-8 w-8 cursor-pointer border border-white bg-violet-900 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
            </div>
            <div
              class="h-8 w-8 cursor-pointer border border-white bg-red-900 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
            </div>
          </div>
        </div>

        <div class="mt-6">
          <p class="pb-2 text-xs text-gray-500">Quantity</p>

          <div class="flex">
            <button
              class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
              &minus;
            </button>
            <div class="flex h-8 w-8 cursor-text items-center justify-center border-t border-b active:ring-gray-500">
              1
            </div>
            <button
              class="flex h-8 w-8 cursor-pointer items-center justify-center border duration-100 hover:bg-neutral-100 focus:ring-2 focus:ring-gray-500 active:ring-2 active:ring-gray-500">
              &#43;
            </button>
          </div>
        </div>

        <div class="mt-7 flex flex-row items-center gap-6">
          <button
            class="flex h-12 w-1/3 items-center justify-center bg-violet-900 text-white duration-100 hover:bg-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="mr-3 h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>

            Add to cart
          </button>
          <button class="flex h-12 w-1/3 items-center justify-center bg-amber-400 duration-100 hover:bg-yellow-300">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="mr-3 h-4 w-4">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>

            Wishlist
          </button>
        </div>
      </div>
    </section>

    @include('partials.footer')
</body>

</html>