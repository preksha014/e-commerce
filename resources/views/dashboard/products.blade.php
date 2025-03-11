<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-violet-900 text-white w-64 p-5">
            <h1 class="text-3xl font-bold mb-6">MayBell</h1>
            <nav>
                <a href="/dashboard" class="block py-2 px-4">Dashboard</a>
                <a href="/dashboard/products" class="block py-2 px-4  bg-violet-800 rounded-md mt-2">Products</a>
                <a href="#" class="block py-2 px-4 mt-2">Orders</a>
                <a href="#" class="block py-2 px-4 mt-2">Customers</a>
                <a href="#" class="block py-2 px-4 mt-2">Reports</a>
                <a href="#" class="block py-2 px-4 mt-2">Settings</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-grow p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Products</h2>
                <button class="bg-green-500 text-white px-4 py-2 rounded-md">Add Product</button>
            </div>

            <!-- Products Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <table class="w-full table-auto">
                    <thead>
                        <tr class=" bg-violet-200">
                            <th class="py-2 px-4">Product Name</th>
                            <th class="py-2 px-4">Category</th>
                            <th class="py-2 px-4">Price</th>
                            <th class="py-2 px-4">Stock</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">Decorative Vase</td>
                            <td class="py-2 px-4">Home Decor</td>
                            <td class="py-2 px-4">$45</td>
                            <td class="py-2 px-4">In Stock</td>
                            <td class="py-2 px-4">
                                <button class="bg-green-500 text-white px-3 py-1 rounded-md">Edit</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md ml-2">Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4">Wall Painting</td>
                            <td class="py-2 px-4">Art & Decor</td>
                            <td class="py-2 px-4">$120</td>
                            <td class="py-2 px-4">Out of Stock</td>
                            <td class="py-2 px-4">
                                <button class="bg-green-500 text-white px-3 py-1 rounded-md">Edit</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md ml-2">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
