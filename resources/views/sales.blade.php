<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 hidden">ID</th>
                                <th class="px-4 py-2">Sale ID</th>
                                <th class="px-4 py-2">Customer</th>
                                <th class="px-4 py-2">Total Amount</th>
                                <th class="px-4 py-2">Payment Status</th>
                                <th class="px-4 py-2">Date</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales->sortByDesc('created_at') as $sale)
                                <tr>
                                    <td class="border px-4 py-2 hidden">{{ $sale->id }}</td>
                                    <td class="border px-4 py-2">{{ $sale->custom_id}}</td>
                                    <td class="border px-4 py-2">{{ $sale->customer->name ?? 'N/A' }}</td>
                                    <td class="border px-4 py-2">{{ number_format($sale->total_amount, 2) }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($sale->payment_status) }}</td>
                                    <td class="border px-4 py-2">{{ $sale->created_at->format('Y-m-d') }}</td>
                                    <td class="border px-4 py-2">
                                        <button onclick="openModal('saleShowModal-{{ $sale->id }}')" class="text-blue-600 hover:text-blue-900">View</button>
                                        <button onclick="openModal('saleEditModal-{{ $sale->id }}')" class="text-yellow-600 hover:text-yellow-900">Edit</button>
                                        <form action="{{ route('sale-action.destroy', $sale->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>