<x-layout>
  @props(['product'])

  <x-slot:heading>Product Details</x-slot:heading>

  <body class="bg-gray-50">
    <main class="container mx-auto max-w-6xl py-10 px-6">
      <section class="grid md:grid-cols-2 gap-8">
        <!-- Left Section: Images -->
        <div>
          <!-- Main Image -->
          <div class="mb-4">
            <img class="w-full h-[330px] object-cover shadow"
              src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" />
          </div>

          <!-- Thumbnails -->
          <div class="grid grid-cols-4 gap-4">
            @foreach ($product->images->slice(1, 4) as $image)
        <img class="w-full h-18 object-cover shadow cursor-pointer hover:opacity-75 transition"
          src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" />
      @endforeach
          </div>
        </div>

        <!-- Right Section: Product Details -->
        <div class="space-y-4">
          <h2 class="text-3xl font-bold">{{ $product->name }}</h2>

          <!-- Product Info -->
          <p><span class="font-semibold">Category:</span> {{ $product->categories->pluck('name')->join(', ') }}</p>

          <!-- Price -->
          <p class="text-3xl font-bold text-violet-900">
            ${{ $product->price }}

          </p>

          <!-- Description -->
          <p class="text-gray-500">{{ $product->description }}</p>

          <!-- Size Options -->
          <div>
            <p class="text-sm font-semibold text-gray-600">Size</p>
            <div class="flex gap-2 mt-2">
              <div class="h-10 w-10 flex items-center justify-center border rounded-md text-gray-700">
                {{ $product->size }}
              </div>
            </div>
          </div>

          <!-- Color Options -->
          <div>
            <p class="text-sm font-semibold text-gray-600">Color</p>
            <div class="flex gap-2 mt-2">
              <div class="h-10 w-10 rounded-full border" style="background-color: {{ $product->color }};"></div>
            </div>
          </div>
          <!-- Action Buttons -->
          <div class="flex gap-4 mt-6">
            <div class="flex-1">
                <form action="{{ route('cart.add', $product->slug) }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->slug }}">
                    <button 
                        type="submit" 
                        class="w-full h-12 bg-violet-800 text-white font-semibold rounded-lg hover:bg-violet-600 transition">
                        Add to Cart
                    </button>
                </form>
            </div>
        
            <div class="flex-1">
                <button 
                    class="w-full h-12 bg-amber-400 text-gray-900 font-semibold rounded-lg hover:bg-amber-500 transition">
                    Wishlist
                </button>
            </div>
        </div>        
      </section>
    </main>

</x-layout>