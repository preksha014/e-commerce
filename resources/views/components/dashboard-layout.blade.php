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
                    <x-nav-link href="/dashboard" :active="request()->is('dashboard')">Dashboard</x-nav-link>
                    <x-nav-link href="/dashboard/products" :active="request()->is('dashboard/products')">Products</x-nav-link>
                    <x-nav-link href="/dashboard/orders" :active="request()->is('dashboard/orders')">Orders</x-nav-link>
                    <x-nav-link href="/dashboard/customers" :active="request()->is('dashboard/customers')">Customers</x-nav-link>
                    <x-nav-link href="/dashboard/reports" :active="request()->is('dashboard/reports')">Reports</x-nav-link>
                    <x-nav-link href="/admin/logout" :active="request()->is('/admin/logout')">Logout</x-nav-link>
                </nav>                
            </div>
            {{ $slot }}
        </div>
    </body>
    </html>
