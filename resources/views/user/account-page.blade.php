<!-- account-page.blade.php -->
<x-layout>
    <x-slot:heading>My Account</x-slot:heading>

    <div class="container mx-auto max-w-[1220px] px-4 py-12 lg:px-8 flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <aside class="w-full md:w-1/4 bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Hello, {{ auth()->guard('customer')->user()->name }}</h2>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('account.profile') }}" 
                       class="text-gray-700 hover:text-violet-600 transition-colors duration-200 flex items-center py-2 {{ request()->routeIs('account.profile') ? 'text-violet-600 font-semibold' : '' }}">
                        <span class="mr-3 text-lg">👤</span> Profile Information
                    </a>
                </li>
                <li>
                    <a href="{{ route('account.orders') }}" 
                       class="text-gray-700 hover:text-violet-600 transition-colors duration-200 flex items-center py-2 {{ request()->routeIs('account.orders') ? 'text-violet-600 font-semibold' : '' }}">
                        <span class="mr-3 text-lg">📦</span> Order History
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="w-full md:w-3/4 bg-white rounded-lg shadow-sm p-6">
            @yield('account-content')
        </div>
    </div>
</x-layout>