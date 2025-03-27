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

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- jQuery (Required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    @vite('resource/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-violet-900 text-white w-64 px-6 py-8 flex flex-col">
            <!-- Logo -->
            <a href="admin/dashboard" class="mb-8">
                <img class="h-14 w-auto" src="{{ asset('src/assets/images/company-logo-inverted.svg') }}"
                    alt="Company Logo" />
            </a>
            <!-- Navigation -->
            <nav class="flex flex-col space-y-4 w-full">
                <x-nav-link href="{{ route('admin.dashboard') }}"
                    :active="request()->is('admin/dashboard')">Dashboard</x-nav-link>
                <x-nav-link href="{{ route('admin.product') }}"
                    :active="request()->is('admin/product*')">Products</x-nav-link>
                <x-nav-link href="{{ route('admin.category') }}"
                    :active="request()->is('admin/category*')">Category</x-nav-link>
                <x-nav-link href="{{ route('admin.orders') }}"
                    :active="request()->is('admin/order*')">Orders</x-nav-link>
                <x-nav-link href="{{ route('admin.customers') }}"
                    :active="request()->is('admin/customers*')">Customers</x-nav-link>
                <x-nav-link href="{{ route('admin.block') }}"
                    :active="request()->is('admin/block*')">Static Blocks</x-nav-link>
                <x-nav-link href="{{ route('admin.page') }}"
                    :active="request()->is('admin/page*')">Static Pages</x-nav-link>
                <x-nav-link href="{{ route('admin.reports') }}"
                    :active="request()->is('admin/reports')">Reports</x-nav-link>
                <x-nav-link href="{{ route('admin.contacts') }}"
                    :active="request()->is('admin/contacts')">Contacts</x-nav-link>
                <x-nav-link href="{{ route('admin.logout') }}"
                    :active="request()->is('admin/logout')">Logout</x-nav-link>
        </div>
        {{ $slot }}
    </div>
</body>

</html>