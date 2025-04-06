<!-- filepath: c:\xampp\htdocs\• Other-Projects •\bms_tailor\resources\views\components\product-modals\product-edit.blade.php -->
<div id="productEditModal-{{ $product->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 101;">
    <div class="relative top-20 mx-auto p-5 border w-[36rem] shadow-lg rounded-md bg-white max-h-[90vh] flex flex-col">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-medium text-gray-900">Edit Product</h3>
            <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal('productEditModal-{{ $product->id }}')">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="overflow-y-auto pr-1">
            <form action="{{ route('product-action.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-x-4">
                    <!-- Product Code -->
                    <div class="mb-4">
                        <label for="product_code" class="block text-gray-700 text-sm font-bold mb-2">Product Code</label>
                        <input
                            type="text"
                            name="product_code"
                            id="product_code"
                            value="{{ old('product_code', $product->product_code) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                    </div>

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name', $product->name) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                        <select
                            name="category_id"
                            id="category_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            {{-- required --}}
                        >
                            <option value="">Select a Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Supplier -->
                    <div class="mb-4">
                        <label for="supplier_id" class="block text-gray-700 text-sm font-bold mb-2">Supplier</label>
                        <select
                            name="supplier_id"
                            id="supplier_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
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
                    <div class="mb-4 col-span-2">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                        >{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="mb-4">
                        <label for="stock_quantity" class="block text-gray-700 text-sm font-bold mb-2">Stock Quantity</label>
                        <input
                            type="number"
                            name="stock_quantity"
                            id="stock_quantity"
                            value="{{ old('stock_quantity', $product->stock_quantity) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            step="0.01"
                            required
                        >
                    </div>

                    <!-- Unit -->
                    <div class="mb-4">
                        <label for="unit" class="block text-gray-700 text-sm font-bold mb-2">Unit</label>
                        <input
                            type="text"
                            name="unit"
                            id="unit"
                            value="{{ old('unit', $product->unit) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                    </div>

                    <!-- Unit Price -->
                    <div class="mb-4">
                        <label for="unit_price" class="block text-gray-700 text-sm font-bold mb-2">Unit Price</label>
                        <input
                            type="number"
                            name="unit_price"
                            id="unit_price"
                            value="{{ old('unit_price', $product->unit_price) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            step="0.01"
                            required
                        >
                    </div>

                    <!-- Cost Price -->
                    <div class="mb-4">
                        <label for="cost_price" class="block text-gray-700 text-sm font-bold mb-2">Cost Price</label>
                        <input
                            type="number"
                            name="cost_price"
                            id="cost_price"
                            value="{{ old('cost_price', $product->cost_price) }}"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            step="0.01"
                        >
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                        <select
                            name="status"
                            id="status"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                            <option value="in_stock" {{ old('status', $product->status) == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                            <option value="low_stock" {{ old('status', $product->status) == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                            <option value="out_of_stock" {{ old('status', $product->status) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            <option value="discontinued" {{ old('status', $product->status) == 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                        </select>
                    </div>

                    <!-- Is Active -->
                    <div class="mb-4">
                        <label for="is_active" class="block text-gray-700 text-sm font-bold mb-2">Is Active</label>
                        <select
                            name="is_active"
                            id="is_active"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none"
                            required
                        >
                            <option value="1" {{ old('is_active', $product->is_active) == 1 ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_active', $product->is_active) == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 mt-4">
                    <button
                        type="button"
                        onclick="closeModal('productEditModal-{{ $product->id }}')"
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