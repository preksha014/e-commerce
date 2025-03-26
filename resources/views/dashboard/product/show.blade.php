<x-dashboard-layout>
    <x-slot:heading>Product Details</x-slot:heading>

    <div class="p-8 w-full bg-gray-100 max-w-7xl mx-auto">    
        <!-- Product Summary -->
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">{{ $product->name }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
            <div class="p-6 bg-gray-50 rounded-xl shadow-md text-center">
                <strong class="text-gray-800 text-lg font-semibold">Description</strong>
                <p class="text-gray-600 mt-3">{{ $product->description ?? 'No description available' }}</p>
            </div>

            <div class="p-6 bg-gray-50 rounded-xl shadow-md text-center">
                <strong class="text-gray-800 text-lg font-semibold">Categories</strong>
                <p class="text-gray-600 mt-3">{{ $product->categories->pluck('name')->join(', ') }}</p>
            </div>

            <div class="p-6 bg-gray-50 rounded-xl shadow-md text-center">
                <strong class="text-gray-800 text-lg font-semibold">Size</strong>
                <p class="text-gray-600 mt-3">{{ $product->size }}</p>
            </div>

            <div class="p-6 bg-gray-50 rounded-xl shadow-md text-center">
                <strong class="text-gray-800 text-lg font-semibold">Color</strong>
                <p class="text-gray-600 mt-3">{{ ucfirst($product->color) }}</p>
            </div>

            <div class="p-6 bg-gray-50 rounded-xl shadow-md text-center">
                <strong class="text-gray-800 text-lg font-semibold">Price</strong>
                <p class="text-2xl font-bold text-green-600 mt-3">{{ number_format($product->price) }} ₹</p>
            </div>

            <div class="p-6 bg-gray-50 rounded-xl shadow-md text-center">
                <strong class="text-gray-800 text-lg font-semibold">Quantity</strong>
                <p class="text-2xl font-bold mt-3">{{ $product->quantity }}</p>
            </div>
        </div>

        <div class="p-6 bg-gray-50 rounded-xl shadow-md text-center">
        <!-- Product Images -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Product Images</h3>
        <div class="flex flex-wrap justify-center gap-6">
            @foreach ($product->images as $image)
                <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}" 
                    class="w-40 h-40 object-cover border rounded-lg shadow-md">
            @endforeach
        </div>
        </div>

        <!-- Product Status -->
        <div class="mt-10 p-6 bg-gray-50 rounded-xl shadow-md text-center">
            <strong class="text-gray-800 text-lg font-semibold">Status:</strong>
            <span class="px-4 py-2 rounded-full text-white font-semibold text-lg {{ $product->status ? 'bg-green-500' : 'bg-red-500' }}">
                {{ $product->status ? 'Active' : 'Inactive' }}
            </span>
        </div>
    </div>
</x-dashboard-layout>
