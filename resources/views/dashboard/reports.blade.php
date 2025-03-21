<x-dashboard-layout>
    <x-slot:heading>Reports</x-slot:heading>

    <div class="flex-grow p-8 space-y-6">
        <h2 class="text-2xl font-bold text-gray-700">Reports Overview</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold text-gray-700">Total Products</h3>
                <p class="text-3xl font-semibold text-blue-600 mt-2">{{ $totalProducts }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold text-gray-700">Total Orders</h3>
                <p class="text-3xl font-semibold text-green-600 mt-2">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h3 class="text-xl font-bold text-gray-700">Total Customers</h3>
                <p class="text-3xl font-semibold text-red-600 mt-2">{{ $totalCustomers }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold text-gray-700 mb-4">Sales Chart</h3>
            <div style="height: 470px;">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById("salesChart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Total Products", "Total Orders", "Total Customers"],
                    datasets: [{
                        label: "Statistics",
                        data: [{{ $totalProducts }}, {{ $totalOrders }}, {{ $totalCustomers }}],
                        backgroundColor: ["#3B82F6", "#10B981", "#EF4444"],
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-dashboard-layout>