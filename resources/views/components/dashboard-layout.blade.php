<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $heading }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/20f5d418fc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    @vite('resource/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="bg-violet-900 text-white w-64 h-full shadow-xl overflow-y-auto">
            <!-- Logo Section -->
            <div class="px-4 py-4 border-b border-violet-700/50">
                <a href="admin/dashboard" class="flex items-center space-x-3">
                    <img class="h-12 w-auto" src="{{ asset('src/assets/images/company-logo-inverted.svg') }}" alt="Company Logo" />
                </a>
            </div>
            <!-- Navigation -->
            <nav class="px-4 py-4 space-y-1.5">
                <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->is('admin/dashboard')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-home mr-3"></i>
                    <span>Dashboard</span>
                </x-nav-link>
                <x-nav-link href="{{ route('admin.product') }}" :active="request()->is('admin/product*')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-box mr-3"></i>
                    <span>Products</span>
                </x-nav-link>
                <x-nav-link href="{{ route('admin.category') }}" :active="request()->is('admin/category*')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-tags mr-3"></i>
                    <span>Category</span>
                </x-nav-link>
                <x-nav-link href="{{ route('admin.orders') }}" :active="request()->is('admin/order*')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-shopping-cart mr-3"></i>
                    <span>Orders</span>
                </x-nav-link>
                <x-nav-link href="{{ route('admin.customers') }}" :active="request()->is('admin/customers*')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-users mr-3"></i>
                    <span>Customers</span>
                </x-nav-link>
                <x-nav-link href="{{ route('admin.block') }}" :active="request()->is('admin/block*')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-th-large mr-3"></i>
                    <span>Static Blocks</span>
                </x-nav-link>
                <x-nav-link href="{{ route('admin.page') }}" :active="request()->is('admin/page*')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-file-alt mr-3"></i>
                    <span>Static Pages</span>
                </x-nav-link>
                <x-nav-link href="{{ route('admin.reports') }}" :active="request()->is('admin/reports')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-chart-bar mr-3"></i>
                    <span>Reports</span>
                </x-nav-link>
                <x-nav-link href="{{ route('admin.contacts') }}" :active="request()->is('admin/contacts')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-envelope mr-3"></i>
                    <span>Contacts</span>
                </x-nav-link>
            </nav>
            <!-- Logout Section -->
            <div class="px-4 mt-6 border-t border-violet-800 py-4">
                <x-nav-link href="{{ route('admin.logout') }}" :active="request()->is('admin/logout')"
                    class="flex items-center px-4 py-3 text-gray-100 hover:bg-violet-700/50 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Logout</span>
                </x-nav-link>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header Bar -->
            <header class="bg-white shadow-md sticky top-0 z-10">
                <div class="flex items-center justify-between px-8 py-4">
                    <h1 class="text-2xl font-semibold text-gray-800">{{ $heading }}</h1>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 hover:bg-violet-50 rounded-full transition-all duration-200">
                            <i class="fas fa-bell text-gray-600"></i>
                        </button>
                        <button class="p-2 hover:bg-violet-50 rounded-full transition-all duration-200">
                            <i class="fas fa-user text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden bg-gray-100 relative h-[calc(100vh-4rem)]">
                <div class="h-full overflow-y-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>