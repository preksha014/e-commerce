<x-dashboard-layout>
    <x-slot:heading>
        Admin Dashboard
    </x-slot:heading>

    <div class="flex-grow p-8 space-y-8">
        <!-- Summary Cards -->
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
            @foreach ([
                ['title' => 'Total Products', 'icon' => 'box', 'count' => $totalProducts],
                ['title' => 'Total Orders', 'icon' => 'shopping-cart', 'count' => $totalOrders],
                ['title' => 'Total Customers', 'icon' => 'users', 'count' => $totalCustomers],
            ] as $card)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $card['title'] }}</h3>
                            <p class="mt-2 text-3xl font-bold text-violet-600">{{ number_format($card['count']) }}</p>
                        </div>
                        <div class="p-3 bg-violet-50 rounded-lg">
                            <i class="fas fa-{{ $card['icon'] }} text-2xl text-violet-500"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Order Status Table -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Order Status</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50">
                            @foreach (['Order ID', 'Customer', 'Status'] as $header)
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ $header }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $order->customer->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm rounded-full {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $orders->links() }}</div>
        </div>
    </div>
</x-dashboard-layout>
