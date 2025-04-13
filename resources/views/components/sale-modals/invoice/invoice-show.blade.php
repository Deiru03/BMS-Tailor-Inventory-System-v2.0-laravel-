<div id="invoiceShowModal-{{ $invoice->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 101;">
    <div class="relative top-20 mx-auto p-5 border w-[36rem] shadow-lg rounded-md bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-medium text-gray-900">Invoice Details</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal('invoiceShowModal-{{ $invoice->id }}')">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="overflow-y-auto pr-1">
            <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
            <p><strong>Sale ID:</strong> {{ $invoice->sale_id }}</p>
            <p><strong>Total Amount:</strong> {{ number_format($invoice->total_amount, 2) }}</p>
            <p><strong>Issued At:</strong> {{ $invoice->issued_at }}</p>
            <p><strong>Notes:</strong> {{ $invoice->notes }}</p>
        </div>

        <div class="flex justify-end space-x-3 mt-4">
            <button type="button" onclick="closeModal('invoiceShowModal-{{ $invoice->id }}')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Close</button>
        </div>
    </div>
</div>