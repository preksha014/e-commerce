<x-dashboard-layout>
    <x-slot:heading>Orders</x-slot:heading>

    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <h2 class="text-2xl font-bold text-gray-700">Orders Management</h2>

        <!-- Orders Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-200 text-left text-gray-700">
                        <th class="py-3 px-4 border border-gray-300">Order ID</th>
                        <th class="py-3 px-4 border border-gray-300">Customer Name</th>
                        <th class="py-3 px-4 border border-gray-300">Total Amount</th>
                        <th class="py-3 px-4 border border-gray-300">Status</th>
                        <th class="py-3 px-4 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="even:bg-gray-100 text-gray-700">
                        <td class="py-3 px-4 border border-gray-300">#1001</td>
                        <td class="py-3 px-4 border border-gray-300">John Doe</td>
                        <td class="py-3 px-4 border border-gray-300">$299</td>
                        <td class="py-3 px-4 border border-gray-300">
                            <span class="bg-yellow-500 text-white px-3 py-1 rounded-md shadow-md">
                                Pending
                            </span>
                        </td>
                        <td class="py-3 px-4 border border-gray-300">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md shadow-md hover:bg-green-600 transition">
                                View
                            </button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded-md ml-2 shadow-md hover:bg-red-600 transition">
                                Cancel
                            </button>
                        </td>
                    </tr>
                    <!-- More Orders Here -->
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>