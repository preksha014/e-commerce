<x-dashboard-layout>
    <x-slot:heading>
        Admin Dashboard
    </x-slot:heading>

    <div class="flex-grow p-8 space-y-8">
        <!-- Summary Cards -->
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
            @foreach ([
                ['title' => 'Total Products', 'count' => $totalProducts],
                ['title' => 'Total Orders', 'count' => $totalOrders],
                ['title' => 'Total Customers', 'count' => $totalCustomers],
            ] as $card)
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-xl font-bold text-gray-700">{{ $card['title'] }}</h3>
                    <p class="text-2xl text-gray-600">{{ number_format($card['count']) }}</p>
                </div>
            @endforeach
        </div>
        <!-- Order Status Table -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Order Status</h2>
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300">
                    <thead>
                        <tr class="bg-violet-300 text-gray-700 text-left">
                            @foreach (['Order ID', 'Customer', 'Status'] as $header)
                                <th class="py-3 px-4 border border-gray-300">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="even:bg-gray-100">
                                <td class="py-3 px-4 border border-gray-300">{{ $order->id }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $order->customer->name }}</td>
                                <td class="py-3 px-4 border border-gray-300">{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $orders->links() }}</div>
        </div>
    </div>
</x-dashboard-layout>
