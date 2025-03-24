<div id="supplierEditModal-{{ $supplier->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 101;">
    <div class="relative top-20 mx-auto p-5 border w-[36rem] shadow-lg rounded-md bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-medium text-gray-900">Edit Supplier</h3><h3>Supplier_ID: <span class="text-blue-600">{{$supplier->supplier_id}}</span></h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal('supplierEditModal-{{ $supplier->id }}')">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="overflow-y-auto pr-1">
            <form action="{{ route('supplier-action.update', $supplier->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-x-4">
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Company Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $supplier->name) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                    </div>

                    <!-- Email (Optional) -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email', $supplier->email) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                        >
                    </div>

                    <!-- Contact_Person -->
                    <div class="mb-4">
                        <label for="contact_person" class="block text-gray-700 text-sm font-bold mb-2">Constact Person</label>
                        <input
                            type="text"
                            name="contact_person"
                            id="contact_person"
                            value="{{ old('contact_person', $supplier->contact_person) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number</label>
                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            value="{{ old('phone', $supplier->phone) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                    </div>

                    <!-- Address -->
                    <div class="mb-4 col-span-2">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                        <input
                            type="text"
                            name="address"
                            id="address"
                            value="{{ old('address', $supplier->address) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                    </div>
                    <!-- Province -->
                    <div class="mb-4">
                        <label for="province" class="block text-gray-700 text-sm font-bold mb-2">Province</label>
                        <input
                            type="text"
                            name="province"
                            id="province"
                            value="{{ old('province', $supplier->province) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                    </div>
                    <!-- City -->
                    <div class="mb-4">
                        <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                        <input
                            type="text"
                            name="city"
                            id="city"
                            value="{{ old('city', $supplier->city) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                    </div>

                    <!-- Supplier Type -->
                    <div class="mb-4">
                        <label for="supplier_type" class="block text-gray-700 text-sm font-bold mb-2">Supplier Type</label>
                        <select
                            name="supplier_type"
                            id="supplier_type"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                            <option value="fabric" {{ old('supplier_type', $supplier->supplier_type) === 'fabric' ? 'selected' : '' }}>Fabric</option>
                            <option value="accessories" {{ old('supplier_type', $supplier->supplier_type) === 'accessories' ? 'selected' : '' }}>Accessories</option>
                            <option value="thread" {{ old('supplier_type', $supplier->supplier_type) === 'thread' ? 'selected' : '' }}>Thread</option>
                            <option value="buttons" {{ old('supplier_type', $supplier->supplier_type) === 'buttons' ? 'selected' : '' }}>Buttons</option>
                            <option value="zippers" {{ old('supplier_type', $supplier->supplier_type) === 'zippers' ? 'selected' : '' }}>Zippers</option>
                            <option value="equipment" {{ old('supplier_type', $supplier->supplier_type) === 'equipment' ? 'selected' : '' }}>Equipment</option>
                            <option value="other" {{ old('supplier_type', $supplier->supplier_type) === 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                  <!-- TIN -->
                  <div class="mb-4">
                    <label for="tin" class="block text-gray-700 text-sm font-bold mb-2">tin</label>
                    <input
                        type="text"
                        name="tin"
                        id="tin"
                        value="{{ old('city', $supplier->tin) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                        required
                    >
                </div>

                    <!-- Notes (Optional) - Full width -->
                    <div class="mb-4 col-span-2">
                        <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
                        <textarea
                            name="notes"
                            id="notes"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                        >{{ old('notes', $supplier->notes) }}</textarea>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 mt-4">
                    <button
                        type="button"
                        onclick="closeModal('supplierEditModal-{{ $supplier->id }}')"
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
</div>