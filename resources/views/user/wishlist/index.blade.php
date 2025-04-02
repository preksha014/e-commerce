<x-layout>
    <x-slot:heading> Wishlist </x-slot:heading>

    <section class="min-h-screen bg-gray-50 py-8 lg:py-12">
        <div class="container mx-auto max-w-[1200px] px-4 lg:px-8">
            @if(session('success'))
                <script>
                    toastr.success('{{ session("success") }}');
                </script>
            @endif

            <!-- Clear Wishlist Button -->
            <div class="mb-8 flex justify-end">
                <button id="clear-wishlist"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white py-2.5 px-5 transition duration-200 shadow-sm">
                    Clear Wishlist
                </button>
            </div>

            <!-- Product Table -->
            <div class="overflow-x-auto border border-gray-200 shadow-sm">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Image</th>
                            <th scope="col"
                                class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Product</th>
                            <th scope="col"
                                class="px-8 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Price</th>
                            <th scope="col"
                                class="px-8 py-4 text-center text-sm font-semibold text-gray-600 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="h-16 w-16 overflow-hidden bg-gray-100">
                                        @if ($product->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $product->images->first()->image) }}"
                                                alt="{{ $product->name }}" class="h-full w-full object-cover object-center">
                                        @else
                                            <div class="flex h-full items-center justify-center bg-gray-100">
                                                <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">${{ $product->price }}</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-center">
                                    <button type="button" data-product-id="{{ $product->id }}"
                                        class="delete-wishlist-item text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                            <path fill-rule="evenodd"
                                                d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-5 text-center text-gray-500">
                                    Your wishlist is empty.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>                    
                </table>
            </div>
        </div>
    </section>
</x-layout>