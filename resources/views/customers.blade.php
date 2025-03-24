<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">{{ __("Customers") }}</h3>
                        <button type="button" onclick="openModal('customerModal')" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            {{ __('Add New Customer') }}
                        </button>
                    </div>

                    <!-- Include Customer Modal Component -->
                    @include('components.customer-modals.customer-create')

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
                                        Customer ID
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Phone
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Sex
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $customer->customer_id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $customer->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $customer->phone }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ $customer->email ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            {{ ucfirst($customer->sex) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm">
                                            <button
                                                type="button"
                                                class="text-blue-600 hover:text-blue-900 mr-3"
                                                onclick="openModal('customerShowModal-{{ $customer->id }}')"
                                            >
                                                View
                                            </button>
                                            <button
                                                type="button"
                                                class="text-indigo-600 hover:text-indigo-900 mr-3"
                                                onclick="openModal('customerEditModal-{{ $customer->id }}')"
                                            >
                                                Edit
                                            </button>
                                            <form action="{{ route('customer-action.destroy', $customer->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    @include('components.customer-modals.customer-edit', ['customer' => $customer])
                                    @include('components.customer-modals.customer-show', ['customer' => $customer])

                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-center">
                                            No customers found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if(isset($customers) && method_exists($customers, 'links'))
                        <div class="mt-4">
                            {{ $customers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
