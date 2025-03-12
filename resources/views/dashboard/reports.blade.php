<x-dashboard-layout>
    <x-slot:heading>Reports</x-slot:heading>

    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <h2 class="text-2xl font-bold text-gray-700">Reports Overview</h2>

        <!-- Report Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-gray-700">Total Products</h3>
                <p class="text-3xl font-semibold text-blue-600 mt-2">150</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-gray-700">Total Orders</h3>
                <p class="text-3xl font-semibold text-green-600 mt-2">450</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center hover:shadow-lg transition">
                <h3 class="text-xl font-bold text-gray-700">Total Sales</h3>
                <p class="text-3xl font-semibold text-red-600 mt-2">$50,000</p>
            </div>
        </div>

        <!-- Sales Report Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-700 mb-4">Sales Report</h3>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-200 text-gray-700 uppercase text-sm tracking-wide">
                        <th class="py-3 px-4 border border-gray-300 text-left">Product Name</th>
                        <th class="py-3 px-4 border border-gray-300 text-center">Orders</th>
                        <th class="py-3 px-4 border border-gray-300 text-center">Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="even:bg-gray-100 hover:bg-gray-200 transition text-gray-700">
                        <td class="py-3 px-4 border border-gray-300">Smartphone</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">120</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">$35,000</td>
                    </tr>
                    <tr class="even:bg-gray-100 hover:bg-gray-200 transition text-gray-700">
                        <td class="py-3 px-4 border border-gray-300">Laptop</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">80</td>
                        <td class="py-3 px-4 border border-gray-300 text-center">$40,000</td>
                    </tr>
                    <!-- More Sales Data Here -->
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
