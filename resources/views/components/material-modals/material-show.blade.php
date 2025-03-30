<div id="materialShowModal-{{ $material->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-40 overflow-y-auto h-full w-full hidden transition-opacity duration-300 ease-in-out backdrop-blur-sm" style="z-index: 100;">
    <div class="relative top-20 mx-auto p-6 border border-gray-200 w-full max-w-3xl shadow-xl rounded-lg bg-gradient-to-b from-white to-gray-50 max-h-[85vh] overflow-y-auto transform transition-all">
        <div class="mt-2">
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-indigo-100 sticky top-0 bg-white z-10">
                <h3 class="text-xl font-semibold text-indigo-800">Material Details</h3>
                <button type="button" class="text-gray-400 hover:text-red-500 transition-colors" onclick="closeModal('materialShowModal-{{ $material->id }}')">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> 
            
            <!-- Basic Information Section -->
            <div class="mb-6 p-5 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg shadow-sm border border-blue-100">
                <h4 class="text-lg font-medium text-indigo-700 mb-3 border-b border-indigo-100 pb-2">Basic Information</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Material Code</p>
                        <p class="text-indigo-800 font-medium">{{ $material->material_code }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Name</p>
                        <p class="text-indigo-800 font-medium">{{ $material->name }}</p>
                    </div>

                    <div class="form-group col-span-2">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Description</p>
                        <p class="text-gray-700">{{ $material->description ?: 'No description provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Supplier Information Section -->
            <div class="mb-6 p-5 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg shadow-sm border border-purple-100">
                <h4 class="text-lg font-medium text-purple-700 mb-3 border-b border-purple-100 pb-2">Supplier Information</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Supplier</p>
                        <p class="text-purple-800 font-medium">{{ $material->supplier ? $material->supplier->name : 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Supplier Type</p>
                        <p class="text-purple-800 font-medium">{{ $material->supplier_type_name ?: 'Not specified' }}</p>
                    </div>
                </div>
            </div>

            <!-- Material Properties Section -->
            <div class="mb-6 p-5 bg-gradient-to-r from-teal-50 to-cyan-50 rounded-lg shadow-sm border border-teal-100">
                <h4 class="text-lg font-medium text-teal-700 mb-3 border-b border-teal-100 pb-2">Material Properties</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Type</p>
                        <p class="text-teal-800">{{ $material->type ?: 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Color</p>
                        <p class="text-teal-800">{{ $material->color ?: 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Pattern</p>
                        <p class="text-teal-800">{{ $material->pattern ?: 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Composition</p>
                        <p class="text-teal-800">{{ $material->composition ?: 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Width</p>
                        <p class="text-teal-800">{{ $material->width ? $material->width . ' ' . $material->unit : 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Weight</p>
                        <p class="text-teal-800">{{ $material->weight ? $material->weight . ' ' . $material->unit : 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Quality Grade</p>
                        <p class="text-teal-800">{{ $material->quality_grade ?: 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Unit</p>
                        <p class="text-teal-800">{{ $material->unit ?: 'Not specified' }}</p>
                    </div>
                </div>
            </div>

            <!-- Inventory & Pricing Section -->
            <div class="mb-6 p-5 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg shadow-sm border border-amber-100">
                <h4 class="text-lg font-medium text-amber-700 mb-3 border-b border-amber-100 pb-2">Inventory & Pricing</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Stock Quantity</p>
                        <p class="text-amber-800 font-medium">{{ number_format($material->stock_quantity ?: 'Not set', 0) }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Unit Price</p>
                        <p class="text-amber-800 font-medium">{{ $material->unit_price ? '₱' . number_format($material->unit_price, 2) : 'Not set' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Cost Price</p>
                        <p class="text-amber-800 font-medium">{{ $material->cost_price ? '₱' . number_format($material->cost_price, 2) : 'Not set' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Reorder Level</p>
                        <p class="text-amber-800">{{ number_format($material->reorder_level ?: 'Not set', 0) }}</p>
                    </div>
                </div>
            </div>

            <!-- Status & Location Section -->
            <div class="mb-6 p-5 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg shadow-sm border border-green-100">
                <h4 class="text-lg font-medium text-emerald-700 mb-3 border-b border-emerald-100 pb-2">Status & Location</h4>
                <div class="grid grid-cols-3 gap-4">
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Location</p>
                        <p class="text-emerald-800">{{ $material->location ?: 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Status</p>
                        <span class="{{ $material->status == 'in_stock' ? 'bg-green-100 text-green-800 border border-green-200' : ($material->status == 'out_of_stock' ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-gray-100 text-gray-800 border border-gray-200') }} px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            {{ ucwords(str_replace('_', ' ', $material->status)) }}
                        </span>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Is Active</p>
                        <span class="{{ $material->is_active ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }} px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            {{ $material->is_active ? 'Yes' : 'No' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 p-4 border-t border-gray-100 flex justify-between items-center">
                <button 
                    type="button" 
                    onclick="openModal('materialEditModal-{{ $material->id }}')"
                    class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors"
                >
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        Edit material
                    </span>
                </button>
                <button 
                    type="button" 
                    onclick="closeModal('materialShowModal-{{ $material->id }}')" 
                    class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
