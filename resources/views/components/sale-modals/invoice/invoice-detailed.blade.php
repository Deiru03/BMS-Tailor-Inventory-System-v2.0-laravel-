<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold">Invoice #{{ $invoice->invoice_number }}</h3>
                    <p><strong>Customer:</strong> {{ $invoice->sale->customer->name }}</p>
                    <p><strong>Total Amount:</strong> {{ number_format($invoice->total_amount, 2) }}</p>
                    <p><strong>Issued At:</strong> {{ $invoice->issued_at }}</p>

                    <h4 class="mt-4 font-bold">Products</h4>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Product</th>
                                <th class="px-4 py-2">Quantity</th>
                                <th class="px-4 py-2">Unit Price</th>
                                <th class="px-4 py-2">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->sale->saleItems as $item)
                                <tr>
                                    <td class="border px-4 py-2">{{ $item->product->name }}</td>
                                    <td class="border px-4 py-2">{{ $item->quantity }}</td>
                                    <td class="border px-4 py-2">{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="border px-4 py-2">{{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>