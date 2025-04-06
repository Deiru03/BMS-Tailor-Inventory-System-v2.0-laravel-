<div id="productEditModal-{{ $product->id }}" class="fixed inset-0 bg-gray-800 bg-opacity-75 overflow-y-auto h-full w-full hidden transition-opacity duration-300" style="z-index: 101;">
    <div class="relative top-20 mx-auto p-0 border-0 w-[40rem] shadow-2xl rounded-lg bg-white max-h-[90vh] flex flex-col transition-transform duration-300 ease-out transform">
        @php
            $productTypes = \App\Models\ProductType::all();
            $suppliers = \App\Models\SupplierInfo::all();
        @endphp
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-lg px-6 py-4">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold text-white">Edit Product</h3>
                <button type="button" class="text-white hover:text-gray-200 transition-colors" 
                        onclick="closeModal('productEditModal-{{ $product->id }}')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="overflow-y-auto p-6">
            <form action="{{ route('product-action.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Basic Information Section -->
                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b border-gray-200">Basic Information</h4>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                        <!-- Product Code -->
                        <div>
                            <label for="product_code" class="block text-gray-700 text-sm font-medium mb-1">Product Code</label>
                            <input
                                type="text"
                                name="product_code"
                                id="product_code"
                                value="{{ old('product_code', $product->product_code) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required
                            >
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-gray-700 text-sm font-medium mb-1">Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $product->name) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required
                            >
                        </div>

                        <!-- Product Type -->
                        <div>
                            <label for="product_type" class="block text-gray-700 text-sm font-medium mb-1">Product Type</label>
                            <div class="relative">
                                <input
                                    type="text"
                                    id="product_type_search_{{ $product->id }}"
                                    class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Search Product Type..."
                                    autocomplete="off"
                                    value="{{ old('product_type', $product->product_type) }}"
                                >
                                <select name="product_type" id="product_type_{{ $product->id }}" class="hidden">
                                    <option value="">Select a Product Type</option>
                                    @foreach($productTypes as $productType)
                                        <option value="{{ $productType->name }}" {{ old('product_type', $product->product_type) == $productType->name ? 'selected' : '' }}>
                                            {{ $productType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div id="product_type_dropdown_{{ $product->id }}" class="absolute z-10 w-full mt-1 bg-white shadow-lg max-h-60 rounded-md py-1 text-base overflow-auto hidden">
                                    <div class="px-3 py-2 text-gray-400 cursor-default hover:bg-gray-100" data-value="">Select a Product Type</div>
                                    @foreach($productTypes as $productType)
                                        <div class="px-3 py-2 cursor-pointer hover:bg-gray-100" data-value="{{ $productType->name }}">
                                            {{ $productType->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Supplier -->
                        <div>
                            <label for="supplier_id" class="block text-gray-700 text-sm font-medium mb-1">Supplier</label>
                            <select
                                name="supplier_id"
                                id="supplier_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors"
                            >
                                <option value="">Select a Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label for="description" class="block text-gray-700 text-sm font-medium mb-1">Description</label>
                            <textarea
                                name="description"
                                id="description"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                rows="3"
                            >{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Product Attributes -->
                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b border-gray-200">Product Attributes</h4>
                    <div class="grid grid-cols-3 gap-x-4 gap-y-4 p-4 rounded-lg">
                        <!-- Color -->
                        <div>
                            <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                            <input type="text" name="color" id="color" value="{{ old('color', $product->color ?? '') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- Size -->
                        <div>
                            <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Size</label>
                            <input type="text" name="size" id="size" value="{{ old('size', $product->size ?? '') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- Material -->
                        <div>
                            <label for="material" class="block text-sm font-medium text-gray-700 mb-1">Material</label>
                            <input type="text" name="material" id="material" value="{{ old('material', $product->material ?? '') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- Brand -->
                        <div>
                            <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                            <input type="text" name="brand" id="brand" value="{{ old('brand', $product->brand ?? '') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <!-- Pattern -->
                        <div>
                            <label for="pattern" class="block text-sm font-medium text-gray-700 mb-1">Pattern</label>
                            <input type="text" name="pattern" id="pattern" value="{{ old('pattern', $product->pattern ?? '') }}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Inventory & Pricing -->
                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b border-gray-200">Inventory & Pricing</h4>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                        <!-- Stock Quantity -->
                        <div>
                            <label for="stock_quantity" class="block text-gray-700 text-sm font-medium mb-1">Stock Quantity</label>
                            <input
                                type="number"
                                name="stock_quantity"
                                id="stock_quantity"
                                value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                step="0.01"
                                required
                            >
                        </div>

                        <!-- Unit -->
                        <div>
                            <label for="unit" class="block text-gray-700 text-sm font-medium mb-1">Unit</label>
                            <input
                                type="text"
                                name="unit"
                                id="unit"
                                value="{{ old('unit', $product->unit) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                required
                            >
                        </div>

                        <!-- Unit Price -->
                        <div>
                            <label for="unit_price" class="block text-gray-700 text-sm font-medium mb-1">Unit Price</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">₱</span>
                                </div>
                                <input
                                    type="number"
                                    name="unit_price"
                                    id="unit_price"
                                    value="{{ old('unit_price', $product->unit_price) }}"
                                    class="w-full pl-7 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    step="0.01"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Cost Price -->
                        <div>
                            <label for="cost_price" class="block text-gray-700 text-sm font-medium mb-1">Cost Price</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">₱</span>
                                </div>
                                <input
                                    type="number"
                                    name="cost_price"
                                    id="cost_price"
                                    value="{{ old('cost_price', $product->cost_price) }}"
                                    class="w-full pl-7 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    step="0.01"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3 pb-2 border-b border-gray-200">Status</h4>
                    <div class="grid grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <label for="status" class="block text-gray-700 text-sm font-medium mb-1">Inventory Status</label>
                            <select
                                name="status"
                                id="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white transition-colors"
                                required
                            >
                                <option value="in_stock" {{ old('status', $product->status) == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="low_stock" {{ old('status', $product->status) == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                                <option value="out_of_stock" {{ old('status', $product->status) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                                <option value="discontinued" {{ old('status', $product->status) == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                            </select>
                        </div>

                        <!-- Is Active -->
                        <div>
                            <label for="is_active" class="block text-gray-700 text-sm font-medium mb-1">Is Active</label>
                            <div class="flex items-center space-x-4 mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="is_active" value="1" {{ old('is_active', $product->is_active) == 1 ? 'checked' : '' }} class="form-radio h-5 w-5 text-blue-600">
                                    <span class="ml-2 text-gray-700">Yes</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="is_active" value="0" {{ old('is_active', $product->is_active) == 0 ? 'checked' : '' }} class="form-radio h-5 w-5 text-red-600">
                                    <span class="ml-2 text-gray-700">No</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-4 mt-6 pt-4 border-t border-gray-200">
                    <button
                        type="button"
                        onclick="closeModal('productEditModal-{{ $product->id }}')"
                        class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                    >
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>