<x-dashboard-layout>
    <x-slot:heading>Products</x-slot:heading>
    
    <!-- Main Content -->
    <div class="flex-grow p-8 space-y-6">
        <!-- Page Header -->
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-700">Products Management</h2>
            <button class="bg-blue-500 text-white px-5 py-2 rounded-md shadow-md hover:bg-blue-600 transition">
                Add Product
            </button>
        </div>

        <!-- Products Table -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-violet-200 text-left text-gray-700">
                        <th class="py-3 px-4 border border-gray-300">Product Name</th>
                        <th class="py-3 px-4 border border-gray-300">Category</th>
                        <th class="py-3 px-4 border border-gray-300">Price</th>
                        <th class="py-3 px-4 border border-gray-300">Stock</th>
                        <th class="py-3 px-4 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="even:bg-gray-100 text-gray-700">
                        <td class="py-3 px-4 border border-gray-300">Smartphone</td>
                        <td class="py-3 px-4 border border-gray-300">Electronics</td>
                        <td class="py-3 px-4 border border-gray-300">$699</td>
                        <td class="py-3 px-4 border border-gray-300">50</td>
                        <td class="py-3 px-4 border border-gray-300">
                            <button class="bg-green-500 text-white px-3 py-1 rounded-md shadow-md hover:bg-green-600 transition">
                                Edit
                            </button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded-md shadow-md ml-2 hover:bg-red-600 transition">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <!-- More Products Here -->
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-layout>
