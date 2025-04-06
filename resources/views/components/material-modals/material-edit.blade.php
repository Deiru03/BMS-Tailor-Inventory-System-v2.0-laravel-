<div id="materialEditModal-{{ $material->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-40 overflow-y-auto h-full w-full hidden transition-opacity duration-300 ease-in-out backdrop-blur-sm" style="z-index: 101;">
    <div class="relative top-20 mx-auto p-6 border border-gray-200 w-full max-w-3xl shadow-xl rounded-lg bg-gradient-to-b from-white to-gray-50 max-h-[85vh] overflow-y-auto transform transition-all">
        <form action="{{ route('material-action.update', $material->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mt-2">
                <div class="flex justify-between items-center pb-4 mb-4 border-b border-indigo-100 sticky top-0 bg-white z-10">
                    <h3 class="text-xl font-semibold text-indigo-800">Edit Material</h3>
                    <button type="button" class="text-gray-400 hover:text-red-500 transition-colors" onclick="closeModal('materialEditModal-{{ $material->id }}')">
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
                            <label for="material_code" class="block text-sm font-medium text-gray-600 mb-1">Material Code</label>
                            <input type="text" name="material_code" id="material_code" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->material_code }}" required>
                        </div>

                        <div class="form-group">
                            <label for="name" class="block text-sm font-medium text-gray-600 mb-1">Name</label>
                            <input type="text" name="name" id="name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->name }}" required>
                        </div>

                        <div class="form-group col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-600 mb-1">Description</label>
                            <textarea name="description" id="description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $material->description }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Supplier Information Section -->
                <div class="mb-6 p-5 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg shadow-sm border border-purple-100">
                    <h4 class="text-lg font-medium text-purple-700 mb-3 border-b border-purple-100 pb-2">Supplier Information</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="supplier_id" class="block text-sm font-medium text-gray-600 mb-1">Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers ?? [] as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $material->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="supplier_type_name" class="block text-sm font-medium text-gray-600 mb-1">Supplier Type</label>
                            <input type="text" name="supplier_type_name" id="supplier_type_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->supplier_type_name }}">
                        </div>
                        
                        {{-- <div class="form-group">
                            <label for="category_id" class="block text-sm font-medium text-gray-600 mb-1">Category</label>
                            <select name="category_id" id="category_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Category</option>
                                @foreach($categories ?? [] as $category)
                                    <option value="{{ $category->id }}" {{ $material->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                </div>

                <!-- Material Properties Section -->
                <div class="mb-6 p-5 bg-gradient-to-r from-teal-50 to-cyan-50 rounded-lg shadow-sm border border-teal-100">
                    <h4 class="text-lg font-medium text-teal-700 mb-3 border-b border-teal-100 pb-2">Material Properties</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="type" class="block text-sm font-medium text-gray-600 mb-1">Type</label>
                            <input type="text" name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->type }}">
                        </div>

                        <div class="form-group">
                            <label for="color" class="block text-sm font-medium text-gray-600 mb-1">Color</label>
                            <input type="text" name="color" id="color" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->color }}">
                        </div>

                        <div class="form-group">
                            <label for="pattern" class="block text-sm font-medium text-gray-600 mb-1">Pattern</label>
                            <input type="text" name="pattern" id="pattern" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->pattern }}">
                        </div>

                        <div class="form-group">
                            <label for="composition" class="block text-sm font-medium text-gray-600 mb-1">Composition</label>
                            <input type="text" name="composition" id="composition" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->composition }}">
                        </div>

                        <div class="form-group">
                            <label for="width" class="block text-sm font-medium text-gray-600 mb-1">Width</label>
                            <input type="text" name="width" id="width" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->width }}">
                        </div>

                        <div class="form-group">
                            <label for="weight" class="block text-sm font-medium text-gray-600 mb-1">Weight</label>
                            <input type="text" name="weight" id="weight" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->weight }}">
                        </div>

                        <div class="form-group">
                            <label for="quality_grade" class="block text-sm font-medium text-gray-600 mb-1">Quality Grade</label>
                            <input type="text" name="quality_grade" id="quality_grade" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->quality_grade }}">
                        </div>

                        <div class="form-group">
                            <label for="unit" class="block text-sm font-medium text-gray-600 mb-1">Unit</label>
                            <select name="unit" id="unit" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="meter" {{ $material->unit == 'meter' ? 'selected' : '' }}>Meter</option>
                                <option value="yard" {{ $material->unit == 'yard' ? 'selected' : '' }}>Yard</option>
                                <option value="piece" {{ $material->unit == 'piece' ? 'selected' : '' }}>Piece</option>
                                <option value="roll" {{ $material->unit == 'roll' ? 'selected' : '' }}>Roll</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Inventory & Pricing Section -->
                <div class="mb-6 p-5 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg shadow-sm border border-amber-100">
                    <h4 class="text-lg font-medium text-amber-700 mb-3 border-b border-amber-100 pb-2">Inventory & Pricing</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-600 mb-1">Stock Quantity</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" step="0.01" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->stock_quantity }}">
                        </div>

                        <div class="form-group">
                            <label for="unit_price" class="block text-sm font-medium text-gray-600 mb-1">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" step="0.01" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->unit_price }}" required>
                        </div>

                        <div class="form-group">
                            <label for="cost_price" class="block text-sm font-medium text-gray-600 mb-1">Cost Price</label>
                            <input type="number" name="cost_price" id="cost_price" step="0.01" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->cost_price }}" required>
                        </div>

                        <div class="form-group">
                            <label for="reorder_level" class="block text-sm font-medium text-gray-600 mb-1">Reorder Level</label>
                            <input type="number" name="reorder_level" id="reorder_level" step="0.01" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->reorder_level }}">
                        </div>
                    </div>
                </div>

                <!-- Status & Location Section -->
                <div class="mb-6 p-5 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg shadow-sm border border-green-100">
                    <h4 class="text-lg font-medium text-emerald-700 mb-3 border-b border-emerald-100 pb-2">Status & Location</h4>
                    <div class="grid grid-cols-2 gap-4">
                        {{-- <div class="form-group">
                            <label for="location" class="block text-sm font-medium text-gray-600 mb-1">Location</label>
                            <input type="text" name="location" id="location" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $material->location }}">
                        </div> --}}

                        <div class="form-group">
                            <label for="status" class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                            <select name="status" id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="in_stock" {{ $material->status == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="low_stock" {{ $material->status == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                                <option value="out_of_stock" {{ $material->status == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                <option value="discontinued" {{ $material->status == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_active" class="block text-sm font-medium text-gray-600 mb-1">Is Active</label>
                            <select name="is_active" id="is_active" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1" {{ $material->is_active ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$material->is_active ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-between">
                    <button type="button" onclick="closeModal('materialEditModal-{{ $material->id }}')" class="btn btn-secondary bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-md transition-colors duration-300 shadow-sm">Cancel</button>
                    <button type="submit" class="btn btn-primary bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition-colors duration-300 shadow-sm">Update Material</button>
                </div>
            </div>
        </form>
    </div>
</div>
