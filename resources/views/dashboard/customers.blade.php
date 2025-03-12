<x-dashboard-layout>
    <x-slot:heading>Customers</x-slot:heading>

    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <h2 class="text-2xl font-bold text-gray-700">Customers Management</h2>

        <!-- Customers Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-200 text-gray-700 uppercase text-sm tracking-wide">
                        <th class="py-3 px-4 border border-gray-300 text-left">Customer ID</th>
                        <th class="py-3 px-4 border border-gray-300 text-left">Name</th>
                        <th class="py-3 px-4 border border-gray-300 text-left">Email</th>
                        <th class="py-3 px-4 border border-gray-300 text-center">Total Orders</th>
                        <th class="py-3 px-4 border border-gray-300 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="even:bg-gray-100 hover:bg-gray-200 transition text-gray-700">
                        <td class="py-3 px-4 border border-gray-300">#C1001</td>
                        <td class="py-3 px-4 border border-gray-300">Alice Johnson</td>
                        <td class="py-3 px-4 border border-gray-300">alice@example.com</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">5</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">
                            <button class="bg-green-500 text-white px-4 py-1 rounded-md shadow-md hover:bg-green-600 transition">
                                View
                            </button>
                            <button class="bg-red-500 text-white px-4 py-1 rounded-md shadow-md ml-2 hover:bg-red-600 transition">
                                Remove
                            </button>
                        </td>
                    </tr>
                    <!-- More Customers Here -->
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
