<!-- filepath: c:\xampp\htdocs\• Other-Projects •\bms_tailor\resources\views\components\sale-modals\invoice\invoice-detailed.blade.php -->

@php
    $isPrinting = request()->query('print') === 'true';
    $companyInfo = json_decode(Storage::disk('local')->get('company_info.json'), true);
@endphp
<style>
    @media print {
        /* Hide everything by default */
        body > * {
            display: none;
        }

        /* Only show the invoice content */
        #invoice-content {
            display: block !important;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }

        /* Hide the sidebar and header */
        .sidebar, .header {
            display: none !important;
        }

        /* Hide the print button */
        .print-button-container {
            display: none !important;
        }

        /* Remove styling constraints for printing */
        #invoice-content .max-w-md {
            max-width: 100% !important;
            margin: 0 !important;
            box-shadow: none !important;
            border-width: 1px !important;
        }

        /* Ensure page breaks don't occur within items */
        tbody tr {
            page-break-inside: avoid;
        }
    }
</style>

@if ($isPrinting)
    <x-minimal-layout>
        <!-- Invoice content -->
        <div id="invoice-content" class="py-12 flex justify-center">
            <div class="max-w-md w-full bg-white shadow-md border-2 border-gray-200">
                <!-- Receipt Header -->
                <div class="text-center pt-6 pb-4 border-b border-dashed border-gray-300">
                    <h1 class="text-xl font-bold">{{ $companyInfo['company_name'] ?? 'COMPANY NAME' }}</h1>
                    <p class="text-sm text-gray-600">{{ $companyInfo['address'] ?? '123 Business Street' }}</p>
                    <p class="text-sm text-gray-600">Tel: {{ $companyInfo['phone'] ?? '(123) 456-7890' }}</p>
                </div>

                <!-- Invoice Info -->
                <div class="px-6 py-4 border-b border-dashed border-gray-300">
                    <div class="text-center mb-2">
                        <h2 class="font-bold text-lg">RECEIPT</h2>
                        <p class="text-sm">Invoice #{{ $invoice->invoice_number }}</p>
                        <p class="text-sm">{{ $invoice->issued_at }}</p>
                    </div>
                    <div class="text-sm">
                        <p class="mb-1"><span class="font-semibold">Customer:</span>
                            {{ $invoice->sale->customer->name }}</p>
                    </div>
                </div>

                <!-- Items -->
                <div class="px-6 py-4 border-b border-dashed border-gray-300">
                    <table class="w-full text-sm">
                        <thead class="border-b border-dashed border-gray-300">
                            <tr>
                                <th class="py-2 text-left">Item</th>
                                <th class="py-2 text-center">Qty</th>
                                <th class="py-2 text-right">Price</th>
                                <th class="py-2 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->sale->saleItems as $item)
                                <tr>
                                    <td class="py-2 text-left">{{ $item->product->name }}</td>
                                    <td class="py-2 text-center">{{ $item->quantity }}</td>
                                    <td class="py-2 text-right">{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="py-2 text-right">{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="px-6 py-4 border-b border-dashed border-gray-300">
                    <div class="flex justify-between text-sm">
                        <span>Subtotal:</span>
                        <span>{{ number_format($invoice->sale->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-bold">
                        <span>Total:</span>
                        <span>{{ number_format($invoice->sale->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm mt-2">
                        <span>Amount Paid:</span>
                        <span>{{ number_format($invoice->sale->amount_paid, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Change Due:</span>
                        <span>{{ number_format($invoice->sale->change_due, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Balance:</span>
                        <span>{{ number_format($invoice->sale->balance, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Payment Status:</span>
                        <span>{{ ucfirst($invoice->sale->payment_status) }}</span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 text-center text-sm">
                    <p>Thank you for your business!</p>
                    <p class="text-xs text-gray-500 mt-2">Powered by BMS Tailor</p>
                </div>
            </div>
        </div>

        <!-- Print and Back buttons -->
        <div class="print-button-container flex justify-center gap-4 mt-6 mb-8">
            <button onclick="window.history.back()"
                class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 shadow-md transition duration-200 flex items-center font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Go Back
            </button>
            <button onclick="window.print()" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-200 flex items-center font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Invoice
            </button>
        </div>
    </x-minimal-layout>
@else
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Invoice Details') }}
            </h2>
        </x-slot>

        <!-- Invoice content -->
        <div id="invoice-content" class="py-12 flex justify-center">
            <div class="max-w-md w-full bg-white shadow-md border-2 border-gray-200">
                <!-- Receipt Header -->
                <div class="text-center pt-6 pb-4 border-b border-dashed border-gray-300">
                    <h1 class="text-xl font-bold">{{ $companyInfo['company_name'] ?? 'COMPANY NAME' }}</h1>
                    <p class="text-sm text-gray-600">{{ $companyInfo['address'] ?? '123 Business Street' }}</p>
                    <p class="text-sm text-gray-600">Tel: {{ $companyInfo['phone'] ?? '(123) 456-7890' }}</p>
                </div>

                <!-- Invoice Info -->
                <div class="px-6 py-4 border-b border-dashed border-gray-300">
                    <div class="text-center mb-2">
                        <h2 class="font-bold text-lg">RECEIPT</h2>
                        <p class="text-sm">Invoice #{{ $invoice->invoice_number }}</p>
                        <p class="text-sm">{{ $invoice->issued_at }}</p>
                    </div>
                    <div class="text-sm">
                        <p class="mb-1"><span class="font-semibold">Customer:</span>
                            {{ $invoice->sale->customer->name }}</p>
                    </div>
                </div>

                <!-- Items -->
                <div class="px-6 py-4 border-b border-dashed border-gray-300">
                    <table class="w-full text-sm">
                        <thead class="border-b border-dashed border-gray-300">
                            <tr>
                                <th class="py-2 text-left">Item</th>
                                <th class="py-2 text-center">Qty</th>
                                <th class="py-2 text-right">Price</th>
                                <th class="py-2 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->sale->saleItems as $item)
                                <tr>
                                    <td class="py-2 text-left">{{ $item->product->name }}</td>
                                    <td class="py-2 text-center">{{ $item->quantity }}</td>
                                    <td class="py-2 text-right">{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="py-2 text-right">{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="px-6 py-4 border-b border-dashed border-gray-300">
                    <div class="flex justify-between text-sm">
                        <span>Subtotal:</span>
                        <span>{{ number_format($invoice->sale->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-bold">
                        <span>Total:</span>
                        <span>{{ number_format($invoice->sale->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm mt-2">
                        <span>Amount Paid:</span>
                        <span>{{ number_format($invoice->sale->amount_paid, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Change Due:</span>
                        <span>{{ number_format($invoice->sale->change_due, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Balance:</span>
                        <span>{{ number_format($invoice->sale->balance, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Payment Status:</span>
                        <span>{{ ucfirst($invoice->sale->payment_status) }}</span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 text-center text-sm">
                    <p>Thank you for your business!</p>
                    <p class="text-xs text-gray-500 mt-2">Powered by BMS Tailor</p>
                </div>
            </div>
        </div>

        <!-- Print button -->
        <div class="print-button-container flex justify-center mt-6 mb-8">
            <button onclick="window.history.back()"
                class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 shadow-md transition duration-200 flex items-center font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Go Back
            </button>
            <button onclick="printInvoice()"
                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-200 flex items-center font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Invoice
            </button>

            <script>
                function printInvoice() {
                    // Navigate to print page
                    const printUrl = '{{ request()->fullUrlWithQuery(['print' => 'true']) }}';
                    const printWindow = window.open(printUrl, '_blank', 'width=800,height=600');
                    
                    // Set timeout to trigger print after 2 seconds
                    setTimeout(function() {
                        if (printWindow && !printWindow.closed) {
                            printWindow.print();
                        }
                    }, 500);
                    
                    // Set up event listener to close window after printing
                    if (printWindow) {
                        printWindow.addEventListener('afterprint', function() {
                            this.close(); // Close the print window after printing
                        });
                    }
                }
            </script>
        </div>
    </x-app-layout>
@endif
