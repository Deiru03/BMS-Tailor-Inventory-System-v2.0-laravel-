<div id="materialModal" class="fixed inset-0 bg-gray-800 bg-opacity-30 overflow-y-auto h-full w-full hidden transition-opacity duration-300 ease-in-out" style="z-index: 100;">
    <div class="relative top-20 mx-auto p-6 border border-gray-200 w-full max-w-3xl shadow-2xl rounded-lg bg-white max-h-[85vh] overflow-y-auto transform transition-all">
        <div class="mt-2">
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200 sticky top-0 bg-white z-10">
                <h3 class="text-xl font-semibold text-gray-800">Add New Material</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors" onclick="closeModal('materialModal')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> 
            <form action="{{ route('material-action.store') }}" method="POST">
                @csrf
                
                <!-- Basic Information Section -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Basic Information</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="material_code" class="block text-sm font-medium text-gray-700 mb-1">Material Code</label>
                            <input type="text" name="material_code" id="material_code" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div class="form-group">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" id="name" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <div class="form-group col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-20 resize-none"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Supplier Information Section -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Supplier Information</h4>
                    <div class="grid grid-cols-2 gap-4">
                        @php
                            $suppliers = \App\Models\SupplierInfo::all();
                        @endphp
                        <div class="form-group">
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select a Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="supplier_types" class="block text-sm font-medium text-gray-700 mb-1">Supplier Types</label>
                            <select name="supplier_type_name" id="supplier_types" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select a supplier type</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Material Properties Section -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Material Properties</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <input type="text" name="type" id="type" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="form-group">
                            <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                            <input type="text" name="color" id="color" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="form-group">
                            <label for="pattern" class="block text-sm font-medium text-gray-700 mb-1">Pattern</label>
                            <input type="text" name="pattern" id="pattern" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="form-group">
                            <label for="composition" class="block text-sm font-medium text-gray-700 mb-1">Composition</label>
                            <input type="text" name="composition" id="composition" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="form-group">
                            <label for="width" class="block text-sm font-medium text-gray-700 mb-1">Width</label>
                            <input type="number" name="width" id="width" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01">
                        </div>

                        <div class="form-group">
                            <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                            <input type="number" name="weight" id="weight" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01">
                        </div>

                        <div class="form-group">
                            <label for="quality_grade" class="block text-sm font-medium text-gray-700 mb-1">Quality Grade</label>
                            <input type="text" name="quality_grade" id="quality_grade" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="form-group">
                            <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Unit</label>
                            <input type="text" name="unit" id="unit" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Inventory & Pricing Section -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Inventory & Pricing</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                            <input 
                                type="number" 
                                name="stock_quantity" 
                                id="stock_quantity" 
                                class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                value="{{ old('stock_quantity', 0) }}" 
                                min="0" 
                                step="0.01" 
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="unit_price" class="block text-sm font-medium text-gray-700 mb-1">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01">
                        </div>

                        <div class="form-group">
                            <label for="cost_price" class="block text-sm font-medium text-gray-700 mb-1">Cost Price</label>
                            <input type="number" name="cost_price" id="cost_price" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" step="0.01">
                        </div>

                        <div class="form-group">
                            <label for="reorder_level" class="block text-sm font-medium text-gray-700 mb-1">Reorder Level</label>
                            <input type="number" name="reorder_level" id="reorder_level" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Status & Location Section -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Status & Location</h4>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="form-group">
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" name="location" id="location" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="form-group">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="in_stock" {{ old('status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                <option value="discontinued" {{ old('status') == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_active" class="block text-sm font-medium text-gray-700 mb-1">Is Active</label>
                            <select name="is_active" id="is_active" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-right">
                    <button type="submit" class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-colors duration-300">Create Material</button>
                </div>

                {{-- Script section remains unchanged --}}
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const supplierDropdown = document.getElementById('supplier_id');
                        const supplierTypesDiv = document.getElementById('supplier_types');
                
                        supplierDropdown.addEventListener('change', function () {
                            const supplierId = this.value;
                
                            // Clear the supplier types div
                            supplierTypesDiv.innerHTML = '<p class="text-sm text-gray-500">Loading...</p>';
                
                            if (supplierId) {
                                // Fetch supplier types via AJAX
                                fetch(`/supplier-types/${supplierId}`)
                                    .then(response => response.json())
                                    .then(types => {
                                        if (types.length > 0) {
                                            supplierTypesDiv.innerHTML = types.map(type => `
                                                <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded-full mr-1">
                                                    ${type.name}
                                                </span>
                                            `).join('');
                                        } else {
                                            supplierTypesDiv.innerHTML = '<p class="text-sm text-gray-500">No types available for this supplier.</p>';
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching supplier types:', error);
                                        supplierTypesDiv.innerHTML = '<p class="text-sm text-red-500">Error loading supplier types.</p>';
                                    });
                            } else {
                                supplierTypesDiv.innerHTML = '<p class="text-sm text-gray-500">Select a supplier to view types.</p>';
                            }
                        });
                    });
                </script>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const supplierDropdown = document.getElementById('supplier_id');
                        const supplierTypesDropdown = document.getElementById('supplier_types');
                
                        supplierDropdown.addEventListener('change', function () {
                            const supplierId = this.value;
                
                            // Clear the supplier types dropdown
                            supplierTypesDropdown.innerHTML = '<option value="">Loading...</option>';
                
                            if (supplierId) {
                                // Fetch supplier types via AJAX
                                fetch(`/supplier-types/${supplierId}`)
                                    .then(response => response.json())
                                    .then(types => {
                                        if (types.length > 0) {
                                            supplierTypesDropdown.innerHTML = '<option value="">Select a supplier type</option>' + 
                                                types.map(type => `
                                                    <option value="${type.name}">${type.name}</option>
                                                `).join('');
                                        } else {
                                            supplierTypesDropdown.innerHTML = '<option value="">No types available for this supplier</option>';
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error fetching supplier types:', error);
                                        supplierTypesDropdown.innerHTML = '<option value="">Error loading supplier types</option>';
                                    });
                            } else {
                                supplierTypesDropdown.innerHTML = '<option value="">Select a supplier to view types</option>';
                            }
                        });
                    });
                </script>
            </form>
        </div>
    </div>
</div>