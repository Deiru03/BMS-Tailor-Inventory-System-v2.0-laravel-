<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suppliers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">{{ __("Suppliers") }}</h3>
                        <button type="button" onclick="openModal('supplierModal')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            {{ __('Add New Supplier') }}
                        </button>
                    </div>

                    <!-- Include Supplier Modal Component -->
                    @include('components.supplier-modals.supplier-create')

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

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Supplier ID
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Contact Person
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Phone
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Address
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        tin
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Supplier Type
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suppliers as $supplier)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $supplier->supplier_id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $supplier->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $supplier->contact_person }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $supplier->email ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ ucfirst($supplier->phone) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ ucfirst($supplier->address) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ ucfirst($supplier->tin) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ ucfirst($supplier->supplier_type) }} 
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm">
                                            <button
                                                type="button"
                                                class="text-blue-600 hover:text-blue-900 mr-3"
                                                onclick="openModal('supplierShowModal-{{ $supplier->id }}')"
                                            >
                                                View
                                            </button>
                                            <button
                                                type="button"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3"
                                                onclick="openModal('supplierEditModal-{{ $supplier->id }}')"
                                            >
                                                Edit
                                            </button>
                                            <form action="{{ route('supplier-action.destroy', $supplier->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this supplier?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    @include('components.supplier-modals.supplier-edit', ['supplier' => $supplier])
                                    @include('components.supplier-modals.supplier-show', ['supplier' => $supplier])

                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                            No Supplier found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if(isset($suppliers) && method_exists($suppliers, 'links'))
                        <div class="mt-4">
                            {{ $suppliers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
