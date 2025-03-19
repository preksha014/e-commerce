@props(['products'])

@foreach ($products as $product)
    <div class="flex flex-col">
        <div class="relative flex">
            @if ($product->images->isNotEmpty())
                <img class="" src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" />
            @endif
            <div
                class="absolute flex h-full w-full items-center justify-center gap-3 opacity-0 duration-150 hover:opacity-100">
                <a href="{{ route('product.show', ['slug' => $product->slug]) }}">
                    <span class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>
                </a>
                <span class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full bg-amber-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                        <path
                            d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                    </svg>
                </span>
            </div>
        </div>

        <div>
            <p class="mt-2">{{ $product->name }}</p>
            <p class="font-medium text-violet-900">${{ $product->price }}</p>

            <div>
                <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="add-to-cart-form" data-product-id="{{ $product->id }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->slug }}">
                    <button type="submit" class="my-5 h-10 w-full bg-violet-900 text-white">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach