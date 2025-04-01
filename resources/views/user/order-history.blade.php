<!-- order-history.blade.php -->
@extends('user.account-page')

@section('account-content')
    <div class="space-y-6">
        <h2 class="text-xl font-semibold text-gray-800">Order History</h2>

        @if(auth()->guard('customer')->user()->orders->isNotEmpty())
            <div class="overflow-x-auto bg-gray-50 rounded-lg">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Date</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Status</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Shipping Address</th>
                            <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach(auth()->guard('customer')->user()->orders as $order)
                            <tr class="hover:bg-gray-100 transition-colors duration-200">
                                <td class="py-4 px-6 text-gray-700">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if(strtolower($order->status) === 'delivered')
                                            bg-green-200 text-green-800
                                        @elseif(strtolower($order->status) === 'cancelled')
                                            bg-red-200 text-red-800
                                        @else
                                            bg-yellow-200 text-yellow-800
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-700">
                                    @if($order->shippingAddress)
                                        {{ $order->shippingAddress->recipient_name }}<br>
                                        {{ $order->shippingAddress->street }}<br>
                                        {{ $order->shippingAddress->city }}, {{ $order->shippingAddress->zipcode }}
                                    @else
                                        <span class="text-gray-500">No shipping address</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-gray-900 font-medium">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <p class="text-gray-500">No orders found.</p>
            </div>
        @endif
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
@endsection