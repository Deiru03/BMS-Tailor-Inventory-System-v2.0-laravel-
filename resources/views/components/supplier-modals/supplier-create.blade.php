<div id="supplierModal" class="fixed inset-0 bg-gray-800 bg-opacity-30 overflow-y-auto h-full w-full hidden transition-opacity duration-300 ease-in-out" style="z-index: 100;">
    <div class="relative top-20 mx-auto p-6 border border-gray-200 w-full max-w-md shadow-2xl rounded-lg bg-white max-h-[85vh] overflow-y-auto transform transition-all">
        <div class="mt-2">
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200 sticky top-0 bg-white z-10">
                <h3 class="text-xl font-semibold text-gray-800">Add New Supplier</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors" onclick="closeModal('supplierModal')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <form action="{{ route('supplier-action.store') }}" method="POST" class="space-y-5">
                @csrf
                <!-- Name -->
                <div>
                    <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Company Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        required
                    >
                </div>
                <!-- Contact Person -->
                <div>
                    <label for="contact_person" class="block text-gray-700 text-sm font-medium mb-2">Contact Person</label>
                    <input 
                        type="text" 
                        name="contact_person" 
                        id="contact_person" 
                        class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        required
                    >
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Email (Optional) -->
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            placeholder="Optional"
                        >
                    </div>
                    
                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-gray-700 text-sm font-medium mb-2">Phone</label>
                        <input 
                            type="text" 
                            name="phone"
                            id="phone" 
                            class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                            required
                        >
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-gray-700 text-sm font-medium mb-2">Address</label>
                    <input 
                        type="text" 
                        name="address"
                        id="address" 
                        class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        required
                    >
                </div>

                <!-- City -->
                <div>
                    <label for="city" class="block text-gray-700 text-sm font-medium mb-2">City</label>
                    <input 
                        type="text" 
                        name="city"
                        id="city" 
                        class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        required
                    >
                </div>

                <!-- Province -->
                <div>
                    <label for="province" class="block text-gray-700 text-sm font-medium mb-2">Province</label>
                    <input 
                        type="text" 
                        name="province"
                        id="province" 
                        class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        required
                    >
                </div>

                <!-- TIN -->
                <div>
                    <label for="tin" class="block text-gray-700 text-sm font-medium mb-2">TIN</label>
                    <input 
                        type="text" 
                        name="tin"
                        id="tin" 
                        class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        required
                    >
                </div>
                
                {{-- <!-- Supplier Type -->
                <div>
                    <label for="supplier_type" class="block text-gray-700 text-sm font-medium mb-2">Supplier Type</label>
                    <select 
                        name="supplier_type" 
                        id="supplier_type" 
                        class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        required
                    >
                        <option value="">Select Supplier Type</option>
                        <option value="fabric">fabric</option>
                        <option value="accessories">accessories</option>
                        <option value="thread">thread</option>
                        <option value="buttons">buttons</option>
                        <option value="zippers">zippers</option>
                        <option value="equipment">equipment</option>
                        <option value="other">other</option>
                    </select>
                </div> --}}

                <!-- Supplier Type -->
                <div>
                    <label for="supplier_type" class="block text-gray-700 text-sm font-medium mb-2">Supplier Type</label>
                    <select 
                        name="supplier_types[]" 
                        id="supplier_type" 
                        class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        multiple
                        required
                    >
                        @foreach($supplierTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Notes (Optional) -->
                <div>
                    <label for="notes" class="block text-gray-700 text-sm font-medium mb-2">Notes</label>
                    <textarea 
                        name="notes" 
                        id="notes" 
                        rows="3"
                        placeholder="Optional"
                        class="shadow-sm border border-gray-300 rounded-md w-full py-2.5 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    ></textarea>
                </div>
                
                <!-- Actions -->
                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                    <button 
                        type="button" 
                        onclick="closeModal('supplierModal')" 
                        class="px-4 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                    >
                        Save Supplier
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>