<x-layout>
  <x-slot:heading>Cart</x-slot:heading>

  <section class="container mx-auto flex-grow max-w-[1200px] border-b py-5 lg:flex lg:py-10">
      <section class="w-full max-w-[1200px] grid-cols-1 gap-3 px-5 pb-10 md:grid">
          @if($cart && count($cart) > 0)
              <table class="w-full border table-fixed">
                  <thead class="h-16 bg-neutral-100">
                      <tr>
                          <th>ITEM</th>
                          <th>PRICE</th>
                          <th>QUANTITY</th>
                          <th>TOTAL</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($cart as $id => $item)
                          <tr class="h-[100px] border-b">
                              <td class="align-middle">
                                  <div class="flex">
                                      <img class="w-[90px]" src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" />
                                      <div class="ml-3 flex flex-col justify-center">
                                          <p class="text-xl font-bold">{{ $item['name'] }}</p>
                                      </div>
                                  </div>
                              </td>
                              <td class="text-center">&#36;{{ number_format($item['price'], 2) }}</td>
                              <td class="text-center">{{ $item['quantity'] }}</td>
                              <td class="text-center">&#36;{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                              <td class="align-middle">
                                  <form action="{{ route('cart.remove', ['slug' => $item['slug']]) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="h-5 w-5 text-red-500 hover:text-red-700">
                                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="m-0">
                                              <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                          </svg>
                                      </button>
                                  </form>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          @else
              <p class="text-center py-10 text-xl">Your cart is empty.</p>
          @endif
      </section>
      <x-order-summary :cart_total="$cart_total" :cart_count="$cart_count">
        <a href="/checkout-address">
            <button class="w-full bg-violet-900 px-5 py-2 text-white">Proceed to checkout</button>
        </a>
      </x-order-summary>

  </section>
</x-layout>