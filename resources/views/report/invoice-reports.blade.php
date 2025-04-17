<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice Reports') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Filters Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 md:p-6">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Filter Invoices</h3>
                    <form action="{{ route('ViewInvoiceReport') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Date Range Filter -->
                        <div>
                            <label for="date_from" class="block text-sm font-medium text-gray-700">From Date</label>
                            <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label for="date_to" class="block text-sm font-medium text-gray-700">To Date</label>
                            <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        
                        <!-- Status Filter -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select id="status" name="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Statuses</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        
                        <!-- Submit and Reset Buttons -->
                        <div class="md:col-span-4 flex justify-end space-x-3">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition duration-150 ease-in-out">
                                Apply Filters
                            </button>
                            <button onclick="printTable()" type="button" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-150 ease-in-out">
                                Print
                            </button>
                            <a href="{{ route('ViewInvoiceReport') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition duration-150 ease-in-out">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Invoices Table Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 md:p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Invoices List</h3>
                        <p class="text-sm text-gray-600">Showing {{ $invoices->count() }} {{ Str::plural('result', $invoices->count()) }}</p>
                    </div>
                    
                    @if($invoices->count() > 0)
                        <div class="overflow-x-auto mx-auto" style="width: 1050px;">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice #</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sale ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount Paid</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Balance</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issue Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($invoices as $invoice)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-900">{{ $invoice->invoice_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">{{ $invoice->sale_id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">{{ $invoice->customer_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">₱{{ number_format($invoice->total_amount, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">₱{{ number_format($invoice->amount_paid, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">₱{{ number_format($invoice->balance, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500">{{ $invoice->issued_at ? date('M d, Y', strtotime($invoice->issued_at)) : 'N/A' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' : 
                                                      ($invoice->status === 'partial' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                    {{ ucfirst($invoice->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="px-6 py-4 text-center text-xs text-gray-500">No invoices found matching your criteria.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $invoices->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="py-6 text-center text-gray-500">
                            <p>No invoices found matching your criteria.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Invoice Summary Section -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 md:p-6">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Invoice Summary</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        @php
                            $totalAmount = $invoices->sum('total_amount');
                            $paidAmount = $invoices->sum('amount_paid'); 
                            $pendingAmount = $invoices->sum('balance'); 
                        @endphp
                        <div class="p-4 border rounded-md bg-gray-50">
                            <p class="text-sm text-gray-500">Total Invoices</p>
                            <p class="text-xl font-semibold">{{ $invoices->total() }}</p>
                        </div>
                        <div class="p-4 border rounded-md bg-gray-50">
                            <p class="text-sm text-gray-500">Total Amount</p>
                            <p class="text-xl font-semibold">₱{{ number_format($totalAmount, 2) }}</p>
                        </div>
                        <div class="p-4 border rounded-md bg-gray-50">
                            <p class="text-sm text-gray-500">Paid Amount</p>
                            <p class="text-xl font-semibold text-green-600">₱{{ number_format($paidAmount, 2) }}</p>
                        </div>
                        <div class="p-4 border rounded-md bg-gray-50">
                            <p class="text-sm text-gray-500">Pending Amount</p>
                            <p class="text-xl font-semibold text-yellow-600">₱{{ number_format($pendingAmount, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printTable() {
            // Get the table content
            const tableContent = document.querySelector('.overflow-x-auto').innerHTML;
    
            // Create a new window for printing
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Print Invoice Report</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            margin: 20px;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-bottom: 20px;
                        }
                        th, td {
                            border: 1px solid #ddd;
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #f4f4f4;
                            font-weight: bold;
                        }
                        tr:nth-child(even) {
                            background-color: #f9f9f9;
                        }
                        .status-paid {
                            color: green;
                            font-weight: bold;
                        }
                        .status-pending {
                            color: orange;
                            font-weight: bold;
                        }
                        .status-cancelled {
                            color: red;
                            font-weight: bold;
                        }
                    </style>
                </head>
                <body>
                    <h2>Invoice Report</h2>
                    ${tableContent}
                </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            // View invoice details
            document.querySelectorAll('.view-invoice').forEach(button => {
                button.addEventListener('click', function() {
                    const invoiceId = this.getAttribute('data-id');
                    // Implement view functionality
                    alert(`View invoice details for ID: ${invoiceId}`);
                });
            });
            
            // Print invoice
            document.querySelectorAll('.print-invoice').forEach(button => {
                button.addEventListener('click', function() {
                    const invoiceId = this.getAttribute('data-id');
                    // Implement print functionality
                    alert(`Print invoice for ID: ${invoiceId}`);
                });
            });
        });
    </script>
</x-app-layout>