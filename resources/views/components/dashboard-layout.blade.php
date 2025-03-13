    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $heading }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-100">
        <div class="flex h-screen">
            <!-- Sidebar -->
            <div class="bg-violet-900 text-white w-64 px-6 py-8 flex flex-col">
                <!-- Logo -->
                <a href="/dashboard" class="mb-8">
                    <img 
                        class="h-14 w-auto" 
                        src="{{ asset('src/assets/images/company-logo-inverted.svg') }}" 
                        alt="Company Logo"
                    />
                </a>              
                <!-- Navigation -->
                <nav class="flex flex-col space-y-4 w-full">
                    <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->is('admin/dashboard')">Dashboard</x-nav-link>
                    <x-nav-link href="/admin/products" :active="request()->is('admin/products')">Products</x-nav-link>
                    <x-nav-link href="/admin/category" :active="request()->is('admin/category')">Category</x-nav-link>
                    <x-nav-link href="/admin/orders" :active="request()->is('admin/orders')">Orders</x-nav-link>
                    <x-nav-link href="/admin/customers" :active="request()->is('admin/customers')">Customers</x-nav-link>
                    <x-nav-link href="/admin/reports" :active="request()->is('admin/reports')">Reports</x-nav-link>
                    <x-nav-link href="/logout" :active="request()->is('/logout')">Logout</x-nav-link>               
            </div>
            {{ $slot }}
        </div>
    </body>
    </html>
