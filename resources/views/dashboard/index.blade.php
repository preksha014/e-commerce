<x-dashboard-layout>
    <x-slot:heading>Admin Dashboard</x-slot:heading>
    <!-- Main Content -->
    <div class="flex-grow p-8">
        <!-- Summary Cards -->
        <div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold text-gray-700">Total Products</h3>
                <p class="text-2xl text-gray-600">120</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold text-gray-700">Total Orders</h3>
                <p class="text-2xl text-gray-600">350</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold text-gray-700">Total Customers</h3>
                <p class="text-2xl text-gray-600">1,200</p>
            </div>
        </div>

        <!-- All Products Table -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-700 mb-4">All Products</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-200 text-left">
                        <th class="py-3 px-4 border border-gray-300">Product Name</th>
                        <th class="py-3 px-4 border border-gray-300">Category</th>
                        <th class="py-3 px-4 border border-gray-300">Price</th>
                        <th class="py-3 px-4 border border-gray-300">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="even:bg-gray-100">
                        <td class="py-3 px-4 border border-gray-300">Smartphone</td>
                        <td class="py-3 px-4 border border-gray-300">Electronics</td>
                        <td class="py-3 px-4 border border-gray-300">$699</td>
                        <td class="py-3 px-4 border border-gray-300">50</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Order Status Table -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-700 mb-4">Order Status</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-200 text-left">
                        <th class="py-3 px-4 border border-gray-300">Order ID</th>
                        <th class="py-3 px-4 border border-gray-300">Customer</th>
                        <th class="py-3 px-4 border border-gray-300">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="even:bg-gray-100">
                        <td class="py-3 px-4 border border-gray-300">#1001</td>
                        <td class="py-3 px-4 border border-gray-300">John Doe</td>
                        <td class="py-3 px-4 border border-gray-300">Shipped</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>