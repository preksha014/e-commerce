<a href="{{ route('product.show', $product->slug) }}" class="search-item flex items-center p-2 hover:bg-gray-100 border-b">
    <img src="{{ asset('storage/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover mr-2">
    <div class="flex-1">
        <p class="text-sm font-semibold">{{ $product->name }}</p>
        <p class="text-sm text-gray-600">${{ $product->price }}</p>
    </div>
</a>