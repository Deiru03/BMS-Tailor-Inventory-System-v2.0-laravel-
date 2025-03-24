{{-- filepath: c:\xampp\htdocs\• Other-Projects •\bms_tailor\resources\views\components\customer-modals\customer-edit.blade.php --}}
<div id="customerEditModal-{{ $customer->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-30 overflow-y-auto h-full w-full hidden" style="z-index: 101;">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-medium text-gray-900">Edit Customer</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal('customerEditModal-{{ $customer->id }}')">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="max-h-[70vh] overflow-y-auto pr-1">
            <form action="{{ route('customer-action.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Personal Information -->
                <div class="mb-5">
                    <h4 class="text-md font-semibold text-gray-800 mb-3 border-b pb-1">Personal Information</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $customer->name) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                                required
                            >
                        </div>

                        <!-- Sex -->
                        <div>
                            <label for="sex" class="block text-gray-700 text-sm font-bold mb-2">Sex</label>
                            <select
                                name="sex"
                                id="sex"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                                required
                            >
                                <option value="male" {{ old('sex', $customer->sex) === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex', $customer->sex) === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="mb-5">
                    <h4 class="text-md font-semibold text-gray-800 mb-3 border-b pb-1">Contact Information</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Email (Optional) -->
                        <div>
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email', $customer->email) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            >
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                value="{{ old('phone', $customer->phone) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                                required    
                            >
                        </div>

                        <!-- Address - Full Width -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                            <input
                                type="text"
                                name="address"
                                id="address"
                                value="{{ old('address', $customer->address) }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                                required
                            >
                        </div>
                    </div>
                </div>
                
                <!-- Financial Information -->
                <div class="mb-5">
                    <h4 class="text-md font-semibold text-gray-800 mb-3 border-b pb-1">Financial Information</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Purchased Amount -->
                        <div>
                            <label for="purchased_amount" class="block text-gray-700 text-sm font-bold mb-2">Purchased Amount</label>
                            <input
                                type="number"
                                name="purchased_amount"
                                id="purchased_amount"
                                value="{{ old('purchased_amount', $customer->purchased_amount) }}"
                                step="0.01"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            >
                        </div>

                        <!-- Amount Paid -->
                        <div>
                            <label for="amount_paid" class="block text-gray-700 text-sm font-bold mb-2">Amount Paid</label>
                            <input
                                type="number"
                                name="amount_paid"
                                id="amount_paid"
                                value="{{ old('amount_paid', $customer->amount_paid) }}"
                                step="0.01"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            >
                        </div>

                        <!-- Balance -->
                        <div>
                            <label for="balance" class="block text-gray-700 text-sm font-bold mb-2">Balance</label>
                            <input
                                type="number"
                                name="balance"
                                id="balance"
                                value="{{ old('balance', $customer->balance) }}"
                                step="0.01"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            >
                        </div>
                    </div>
                </div>
                
                <!-- Additional Information -->
                <div class="mb-5">
                    <h4 class="text-md font-semibold text-gray-800 mb-3 border-b pb-1">Additional Information</h4>
                    
                    <!-- Notes (Optional) -->
                    <div>
                        <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
                        <textarea
                            name="notes"
                            id="notes"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                        >{{ old('notes', $customer->notes) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-3 mt-4 pt-3 border-t">
                <button
                    type="button"
                    onclick="closeModal('customerEditModal-{{ $customer->id }}')"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400"
                >
                    Cancel
                </button>
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                >
                    Update
                </button>
            </div>
        </form>
    </div>
</div>