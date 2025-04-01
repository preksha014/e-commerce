<x-layout>
    <x-slot:heading>
        Wishlist
    </x-slot:heading>
    <div class="container mx-auto px-4 py-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Clear Wishlist Button -->
        <div class="mb-6 flex justify-end">
            <form action="{{ route('wishlist.clear') }}" method="POST">
                @csrf
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                    Clear Wishlist
                </button>
            </form>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($products as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">{{ $product->name }}</h5>
                        <p class="text-lg text-gray-700 mb-4">${{ $product->price }}</p>
                        <form action="{{ route('wishlist.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg w-full transition duration-200">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 text-lg col-span-full py-10">Your wishlist is empty</p>
            @endforelse
        </div>
    </div>
</x-layout>