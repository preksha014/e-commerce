<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-violet-900 text-white w-64 p-5">
            <h1 class="text-3xl font-bold mb-6">MayBell</h1>
            <nav>
                <a href="/dashboard" class="block py-2 px-4 bg-violet-800 rounded-md">Dashboard</a>
                <a href="/dashboard/products" class="block py-2 px-4 mt-2">Products</a>
                <a href="#" class="block py-2 px-4 mt-2">Orders</a>
                <a href="#" class="block py-2 px-4 mt-2">Customers</a>
                <a href="#" class="block py-2 px-4 mt-2">Reports</a>
                <a href="#" class="block py-2 px-4 mt-2">Settings</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-grow p-8">

            <!-- Stats Section -->
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold">Clients</h3>
                    <p class="text-2xl">512</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold">Sales</h3>
                    <p class="text-2xl">$7,770</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold">Performance</h3>
                    <p class="text-2xl">256%</p>
                </div>
            </div>

            <!-- Clients Table -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-4">Clients</h3>
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-violet-200">
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">Company</th>
                            <th class="py-2 px-4">City</th>
                            <th class="py-2 px-4">Progress</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4">Rebecca Bauch</td>
                            <td class="py-2 px-4">Daugherty-Daniel</td>
                            <td class="py-2 px-4">South Cory</td>
                            <td class="py-2 px-4">
                                <div class="bg-gray-200 w-full h-2 rounded">
                                    <div class="bg-green-500 w-3/4 h-2 rounded"></div>
                                </div>
                            </td>
                            <td class="py-2 px-4">
                                <button class="bg-green-500 text-white px-3 py-1 rounded-md">View</button>
                                <button class="bg-red-500 text-white px-3 py-1 rounded-md ml-2">Delete</button>
                            </td>
                        </tr>
                        <!-- More Rows Here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
