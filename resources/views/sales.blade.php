<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sales Management') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Centered New Sale Button with SVG -->
            <div class="flex justify-center mb-6">
                <button onclick="openSaleModal('newSaleModal'); return false;" 
                    class="flex items-center justify-center px-10 py-3.5 min-w-[220px] 
                    bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 
                    text-white text-lg font-semibold rounded-xl shadow-lg 
                    border border-blue-400 border-opacity-20
                    transition-all duration-200 ease-in-out transform hover:scale-102 hover:-translate-y-1
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    New Sale
                </button>
            </div>
            <!-- Filters Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-4 md:p-6">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Filter Sales</h3>
                    <form action="{{ route('ViewSale') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                        
                        <!-- Payment Status Filter -->
                        <div>
                            <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                            <select id="payment_status" name="payment_status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All Statuses</option>
                                <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="partial" {{ request('payment_status') == 'partial' ? 'selected' : '' }}>Partial</option>
                                <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            </select>
                        </div>
                        
                        <!-- Invoice Status Filter -->
                        <div>
                            <label for="invoice_status" class="block text-sm font-medium text-gray-700">Invoice Status</label>
                            <select id="invoice_status" name="invoice_status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">All</option>
                                <option value="has_invoice" {{ request('invoice_status') == 'has_invoice' ? 'selected' : '' }}>Has Invoice</option>
                                <option value="no_invoice" {{ request('invoice_status') == 'no_invoice' ? 'selected' : '' }}>No Invoice</option>
                            </select>
                        </div>
                        
                        <!-- Submit and Reset Buttons -->
                        <div class="md:col-span-4 flex justify-end space-x-3">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition duration-150 ease-in-out">
                                <i class="fas fa-filter mr-1"></i> Apply Filters
                            </button>
                            <a href="{{ route('ViewSale') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-md transition duration-150 ease-in-out">
                                <i class="fas fa-redo mr-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Sales Table Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 md:p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-700">Sales List</h3>
                        <p class="text-sm text-gray-600">Showing {{ $sales->count() }} {{ Str::plural('result', $sales->count()) }}</p>
                    </div>
                    
                    @if($sales->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Sale ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Customer
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Invoice No.
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Amount
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Payment Details
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($sales->sortByDesc('created_at') as $sale)
                                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }} hover:bg-gray-100">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                <a href="{{ route('invoice-action.showDetail', $sale->id) }}" class="hover:text-blue-600">
                                                    {{ $sale->custom_id }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($sale->customer)
                                                    <div>{{ $sale->customer->name }}</div>
                                                    <div class="text-xs text-gray-400">{{ $sale->customer->phone ?? 'No phone' }}</div>
                                                @else
                                                    <span class="text-gray-400">Walk-in customer</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($sale->invoiceSales)
                                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-md text-xs">
                                                        #{{ $sale->invoiceSales->invoice_number }}
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 bg-gray-100 text-gray-500 rounded-md text-xs">
                                                        Not invoiced
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span class="font-semibold">{{ number_format($sale->total_amount, 2) }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <div class="flex flex-col">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                        {{ $sale->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                                                           ($sale->payment_status === 'partial' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                        {{ ucfirst($sale->payment_status) }}
                                                    </span>
                                                    <div class="text-xs text-gray-500 mt-1">
                                                        <div>Paid: {{ number_format($sale->amount_paid, 2) }}</div>
                                                        @if($sale->balance > 0)
                                                            <div>Balance: {{ number_format($sale->balance, 2) }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div>{{ $sale->created_at->format('M d, Y') }}</div>
                                                <div class="text-xs text-gray-400">{{ $sale->created_at->format('h:i A') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('invoice-action.showDetail', $sale->invoiceSales->id) }}" 
                                                        class="text-blue-600 hover:text-blue-900" title="View Invoice">
                                                        <i class="fas fa-file-invoice">View Invoice</i>
                                                    </a>
                                                    {{-- <a href="{{ route('sales.edit', $sale->id) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit"> --}}
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    
                                                    <button onclick="confirmDelete('{{ $sale->id }}')" 
                                                            class="text-red-600 hover:text-red-900" title="Delete">
                                                        <i class="fas fa-trash-alt">Delete</i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                         <!-- Pagination -->
                         <div class="mt-4">
                            {{ $sales->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="py-6 text-center text-gray-500">
                            <p>No sales found matching your criteria.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Delete Sale
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this sale? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </form>
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        function confirmDelete(saleId) {
            document.getElementById('deleteForm').action = `/sale-action/${saleId}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
    @endpush
</x-app-layout>