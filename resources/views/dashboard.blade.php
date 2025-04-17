<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Sales -->
                <div class="bg-blue-500 text-white rounded-lg shadow-md p-6 relative">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Total Sales</h3>
                        <!-- Dropdown for selecting time period -->
                        <div class="relative">
                            <select id="salesFilter" onchange="filterSales()" class="bg-blue-400 text-white text-sm rounded-md px-3 py-1.5 focus:outline-none">
                                <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Today</option>
                                <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>This Week</option>
                                <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>This Month</option>
                                <option value="year" {{ $filter == 'year' ? 'selected' : '' }}>This Year</option>
                            </select>
                        </div>
                    </div>
                    <p class="text-3xl font-bold mt-2">₱{{ number_format($totalSales, 2) }}</p>
                </div>

                <script>
                    function filterSales() {
                        const filter = document.getElementById('salesFilter').value;
                        window.location.href = `?filter=${filter}`;
                    }
                </script>

                <!-- Total Customers -->
                <div class="bg-green-500 text-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold">Total Customers</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalCustomers }}</p>
                </div>

                <!-- Total Products -->
                <div class="bg-yellow-500 text-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold">Total Products</h3>
                    <p class="text-3xl font-bold mt-2">{{ $totalProducts }}</p>
                </div>

                <!-- Pending Payments -->
                <div class="bg-red-500 text-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold">Pending Payments</h3>
                    <p class="text-3xl font-bold mt-2">₱{{ number_format($pendingPayments, 2) }}</p>
                </div>
            </div>

            <!-- Dashboard Tables Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Sales - Compact Version -->
                <div class="bg-white rounded-lg shadow-md p-4 overflow-hidden border border-blue-200">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-semibold text-gray-700">Recent Sales</h3>
                        <div class="flex space-x-3">
                            <a onclick="openSaleModal('newSaleModal'); return false;" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                New Sale
                            </a>
                            <a href="{{ route('ViewSale') }}" class="text-blue-500 text-sm hover:text-blue-700 flex items-center">View All</a>
                        </div>
                    </div>
                    <div class="overflow-x-auto thin-scrollbar">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 text-xs text-gray-500 uppercase border-b">
                                    <th class="px-3 py-2 text-left">ID</th>
                                    <th class="px-3 py-2 text-left">Customer</th>
                                    <th class="px-3 py-2 text-left">Total</th>
                                    <th class="px-3 py-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                    <tr class="hover:bg-gray-50 border-b border-gray-100">
                                        <td class="px-3 py-2 text-sm font-medium text-gray-900">{{ $sale->custom_id }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-500">{{ $sale->customer->name ?? 'Walk-in' }}</td>
                                        <td class="px-3 py-2 text-sm text-gray-700 font-medium">₱{{ number_format($sale->total_amount, 2) }}</td>
                                        <td class="px-3 py-2">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $sale->payment_status === 'paid' ? 'bg-green-100 text-green-800' : ($sale->payment_status === 'partial' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                {{ ucfirst($sale->payment_status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Product Stocks - Improved Design -->
                <div class="bg-white rounded-lg shadow-md p-4 overflow-hidden border border-blue-200">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-lg font-semibold text-gray-700">Product Stocks</h3>
                        <a href="{{ route('ViewProduct') }}" class="text-blue-500 text-sm hover:text-blue-700">Manage Inventory</a>
                    </div>
                    <div class="overflow-x-auto thin-scrollbar">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 text-xs text-gray-500 uppercase border-b">
                                    <th class="px-3 py-2 text-left">Product</th>
                                    <th class="px-3 py-2 text-center">Stock</th>
                                    <th class="px-3 py-2 text-right">Unit Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productStocks as $product)
                                    <tr class="hover:bg-gray-50 border-b border-gray-100">
                                        <td class="px-3 py-2 text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                        <td class="px-3 py-2 text-sm text-center">
                                            <div class="flex items-center justify-center">
                                                <span class="{{ $product->stock_quantity <= 5 ? 'text-red-600 font-medium' : 'text-gray-600' }}">
                                                    {{ number_format($product->stock_quantity, 0) }}
                                                </span>
                                                @if($product->stock_quantity == 0)
                                                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-800 font-medium">Out of Stock</span>
                                                @elseif($product->stock_quantity <= 5)
                                                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-800 font-medium">Low Stock</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-3 py-2 text-sm text-gray-700 font-medium text-right">₱{{ number_format($product->unit_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-blue-200">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Sales Overview</h3>
                <canvas id="salesChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($salesDates), // Array of dates
                datasets: [{
                    label: 'Sales',
                    data: @json($salesAmounts), // Array of sales amounts
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Sales Amount (₱)'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>