<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">{{ __("Products") }}</h3>
                        <button type="button" onclick="openModal('productModal')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            {{ __('Add New Material') }}
                        </button>
                    </div>

                    <!-- Include Supplier Modal Component -->
                    @include('components.product-modals.product-create')

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            window.openModal = function(id) {
                                const modal = document.getElementById(id);
                                if (modal) {
                                    modal.classList.remove('hidden');
                                } else {
                                    console.error(`Modal with id ${id} not found`);
                                }
                            }
                            
                            window.closeModal = function(id) {
                                const modal = document.getElementById(id);
                                if (modal) {
                                    modal.classList.add('hidden');
                                } else {
                                    console.error(`Modal with id ${id} not found`);
                                }
                            }
                        });
                    </script>

                    <div class="overflow-x-auto w-full">
                        <table class="w-full bg-white border border-gray-200 text-sm">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        product ID
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Type <small class="text-gray-500">(of product)</small>
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Supplier
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Stock <small class="text-gray-500">(quantity)</small>
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Reorder Level
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-xs">
                                @forelse($products as $product)
                                    <tr>
                                        @php
                                            $supplier = App\Models\SupplierInfo::find($product->supplier_id);
                                            $product->supplier = $supplier;
                                        @endphp
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $product->product_code }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $product->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $product->type ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $product->supplier->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ number_format($product->stock_quantity, 0) }} - {{ $product->unit }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ number_format($product->unit_price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $product->reorder_level ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $product->status === 'in_stock' ? 'bg-green-100 text-green-800' : 
                                               ($product->status === 'low_stock' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($product->status === 'out_of_stock' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                                {{ ucfirst(str_replace('_', ' ', $product->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <button
                                                type="button"
                                                class="text-blue-600 hover:text-blue-900 mr-3"
                                                onclick="openModal('productShowModal-{{ $product->id }}')"
                                            >
                                                View
                                            </button>
                                            <button
                                                type="button"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3"
                                                onclick="openModal('productEditModal-{{ $product->id }}')"
                                            >
                                                Edit
                                            </button>
                                            <form action="{{ route('product-action.destroy', $product->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    @include('components.product-modals.product-edit', ['product' => $product])
                                    @include('components.product-modals.product-show', ['product' => $product])

                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                            No product found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if(isset($products) && method_exists($products, 'links'))
                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
