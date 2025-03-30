<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suppliers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">{{ __("Materials") }}</h3>
                        <button type="button" onclick="openModal('materialModal')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            {{ __('Add New Material') }}
                        </button>
                    </div>

                    <!-- Include Supplier Modal Component -->
                    @include('components.material-modals.material-create')

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
                                        Material ID
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Type <small class="text-gray-500">(of material)</small>
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
                                @forelse($materials as $material)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $material->material_code }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $material->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $material->type ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $material->supplier->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $material->stock_quantity }} {{ $material->unit }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ number_format($material->unit_price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $material->reorder_level ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $material->status === 'in_stock' ? 'bg-green-100 text-green-800' : 
                                               ($material->status === 'low_stock' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($material->status === 'out_of_stock' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                                {{ ucfirst(str_replace('_', ' ', $material->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <button
                                                type="button"
                                                class="text-blue-600 hover:text-blue-900 mr-3"
                                                onclick="openModal('materialShowModal-{{ $material->id }}')"
                                            >
                                                View
                                            </button>
                                            <button
                                                type="button"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3"
                                                onclick="openModal('materialEditModal-{{ $material->id }}')"
                                            >
                                                Edit
                                            </button>
                                            <form action="{{ route('material-action.destroy', $material->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this material?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    @include('components.material-modals.material-edit', ['material' => $material])
                                    @include('components.material-modals.material-show', ['material' => $material])

                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                            No material found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if(isset($materials) && method_exists($materials, 'links'))
                        <div class="mt-4">
                            {{ $materials->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
