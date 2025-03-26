<x-dashboard-layout>
    <x-slot:heading>Orders</x-slot:heading>

    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <h2 class="text-2xl font-bold text-gray-700">Orders Management</h2>

        @if(session('success'))
            <script>
                $(document).ready(function () {
                    toastr.success("{{ session('success') }}");
                });
            </script>
        @endif

        <!-- Orders Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-300 text-left text-gray-700">
                        <th class="py-3 px-4 border border-gray-300">Customer Name</th>
                        <th class="py-3 px-4 border border-gray-300">Total Amount</th>
                        <th class="py-3 px-4 border border-gray-300">Status</th>
                        <th class="py-3 px-4 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="even:bg-gray-100 text-gray-700">
                            <td class="py-3 px-4 border border-gray-300">{{$order->customer->name}}</td>
                            <td class="py-3 px-4 border border-gray-300">{{number_format($order->total_amount)}} ₹</td>
                            <td class="py-3 px-4 border border-gray-300">
                                <span class="px-3 py-1 rounded-md shadow-md text-white
                                    @if($order->status == 'pending') bg-yellow-500 
                                    @elseif($order->status == 'delivered') bg-green-500 
                                    @elseif($order->status == 'cancelled') bg-red-500 
                                    @else bg-gray-500 @endif">
                                    {{ $order->status }}
                                </span>
                            </td>

                            <td class="py-3 px-4 border border-gray-300">
                                <a href="{{ route('admin.order.show', $order->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded-md shadow-md hover:bg-blued-600 transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-dashboard-layout>