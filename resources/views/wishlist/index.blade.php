@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">My Wishlist</h1>

    @if($wishlistItems->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500">Your wishlist is empty. Start adding products you love!</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($wishlistItems as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $item->product->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ $item->product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold">${{ number_format($item->product->price, 2) }}</span>
                            <div class="flex space-x-2">
                                <a href="{{ route('products.show', $item->product) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    View Details
                                </a>
                                <button onclick="removeFromWishlist({{ $item->id }})" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@push('scripts')
<script>
function removeFromWishlist(wishlistId) {
    if (confirm('Are you sure you want to remove this item from your wishlist?')) {
        fetch(`/wishlist/${wishlistId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while removing the item from your wishlist.');
        });
    }
}
</script>
@endpush
@endsection 