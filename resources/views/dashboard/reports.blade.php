<x-dashboard-layout>
    <x-slot:heading>Reports</x-slot:heading>

    <div class="flex-grow p-8 space-y-6">
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-violet-900 mb-4">Reports Overview</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-violet-50 to-violet-100 p-6 rounded-lg shadow-md border border-violet-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-violet-900">Total Products</h3>
                        <i class="fas fa-box text-2xl text-violet-600"></i>
                    </div>
                    <p class="text-3xl font-bold text-violet-700 mt-3">{{ $totalProducts }}</p>
                </div>
                <div class="bg-gradient-to-br from-violet-50 to-violet-100 p-6 rounded-lg shadow-md border border-violet-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-violet-900">Total Orders</h3>
                        <i class="fas fa-shopping-cart text-2xl text-violet-600"></i>
                    </div>
                    <p class="text-3xl font-bold text-violet-700 mt-3">{{ $totalOrders }}</p>
                </div>
                <div class="bg-gradient-to-br from-violet-50 to-violet-100 p-6 rounded-lg shadow-md border border-violet-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-violet-900">Total Customers</h3>
                        <i class="fas fa-users text-2xl text-violet-600"></i>
                    </div>
                    <p class="text-3xl font-bold text-violet-700 mt-3">{{ $totalCustomers }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-violet-900 mb-6">Sales Statistics</h3>
            <div class="h-[200px]">
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
                        backgroundColor: ["#7c3aed", "#8b5cf6", "#a78bfa"],
                        borderRadius: 8,
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f3f4f6'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-dashboard-layout>