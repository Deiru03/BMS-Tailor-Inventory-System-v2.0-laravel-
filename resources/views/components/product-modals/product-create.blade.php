<!-- filepath: c:\xampp\htdocs\• Other-Projects •\bms_tailor\resources\views\components\product-modals\product-create.blade.php -->
@php
    // Include the modals for customer and supplier
    $suppliers = App\Models\SupplierInfo::all();
    $products = App\Models\Product::all();
    $categories = App\Models\CategoryProduct::all();
@endphp
<div id="productModal" class="fixed inset-0 bg-gray-800 bg-opacity-30 overflow-y-auto h-full w-full hidden transition-opacity duration-300 ease-in-out" style="z-index: 100;">
    <div class="relative top-20 mx-auto p-6 border border-gray-200 w-full max-w-3xl shadow-2xl rounded-lg bg-white max-h-[85vh] overflow-y-auto transform transition-all">
        <div class="mt-2">
            <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200 sticky top-0 bg-white z-10">
                <h3 class="text-xl font-semibold text-gray-800">Add New Material</h3>
                <button type="button" class="text-gray-400 hover:text-gray-600 transition-colors" onclick="closeModal('productModal')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div> 
            <form action="{{ route('product-action.store') }}" method="POST">
                @csrf
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Product Information</h4>
                    <div class="grid grid-cols-2 gap-4">

                        @php
                            // Fetch all products and their sizes
                            $products = \App\Models\Product::all();
                            $existingSizes = $products->pluck('size')->toArray(); // Get all existing sizes
                        @endphp

                        <!-- Product Code -->
                        <div class="form-group">
                            <label for="product_code" class="block text-sm font-medium text-gray-700 mb-1">Product Code</label>
                            <input type="text" name="product_code" id="product_code" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" id="name" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category_id" id="category_id" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select a Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Supplier -->
                        <div class="form-group">
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Supplier</label>
                            <select name="supplier_id" id="supplier_id" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select a Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="form-group col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-20 resize-none"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Inventory Details -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Inventory Details</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Stock Quantity -->
                        <div class="form-group">
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity</label>
                            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" min="0" step="0.01" required>
                        </div>

                        <!-- Unit -->
                        <div class="form-group">
                            <label for="unit" class="block text-sm font-medium text-gray-700 mb-1">Unit</label>
                            <input type="text" name="unit" id="unit" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="piece" required>
                        </div>

                        <!-- Unit Price -->
                        <div class="form-group">
                            <label for="unit_price" class="block text-sm font-medium text-gray-700 mb-1">Unit Price</label>
                            <input type="number" name="unit_price" id="unit_price" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" min="0" step="0.01" required>
                        </div>

                        <!-- Cost Price -->
                        <div class="form-group">
                            <label for="cost_price" class="block text-sm font-medium text-gray-700 mb-1">Cost Price</label>
                            <input type="number" name="cost_price" id="cost_price" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" min="0" step="0.01">
                        </div>
                    </div>
                </div>

                <!-- Product Attributes -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Product Attributes</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Color -->
                        <div class="form-group">
                            <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Color</label>
                            <input type="text" name="color" id="color" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Size -->
                        <div class="form-group">
                            <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Size</label>
                            <input type="text" name="size" id="size" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        {{-- <div class="form-group">
                            <label for="size" class="block text-sm font-medium text-gray-700 mb-1">Size</label>
                            <select name="size" id="size" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Select a Size</option>
                                @foreach(['Small', 'Medium', 'Large', 'Extra Large'] as $sizeOption)
                                    <option value="{{ $sizeOption }}" 
                                        @if(in_array($sizeOption, $existingSizes)) disabled @endif>
                                        {{ $sizeOption }}
                                    </option>
                                @endforeach
                            </select>
                        </div> --}}

                        <!-- Material -->
                        <div class="form-group">
                            <label for="material" class="block text-sm font-medium text-gray-700 mb-1">Material</label>
                            <input type="text" name="material" id="material" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Brand -->
                        <div class="form-group">
                            <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                            <input type="text" name="brand" id="brand" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <!-- Pattern -->
                        <div class="form-group">
                            <label for="pattern" class="block text-sm font-medium text-gray-700 mb-1">Pattern</label>
                            <input type="text" name="pattern" id="pattern" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Status and Active -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-lg font-medium text-gray-700 mb-3 border-b pb-2">Status</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Status -->
                        <div class="form-group">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="in_stock">In Stock</option>
                                <option value="low_stock">Low Stock</option>
                                <option value="out_of_stock">Out of Stock</option>
                                <option value="discontinued">Discontinued</option>
                            </select>
                        </div>

                        <!-- Is Active -->
                        <div class="form-group">
                            <label for="is_active" class="block text-sm font-medium text-gray-700 mb-1">Active</label>
                            <select name="is_active" id="is_active" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Create Product
                    </button>
                </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const productNameInput = document.getElementById('name');
                    const sizeDropdown = document.getElementById('size');
            
                    productNameInput.addEventListener('input', function () {
                        const productName = productNameInput.value.toLowerCase();
            
                        // Fetch existing products and sizes from PHP
                        const products = @json($products);
            
                        // Clear the size dropdown
                        sizeDropdown.innerHTML = '<option value="">Select a Size</option>';
            
                        // Check if the product name exists in the database
                        const matchingProduct = products.find(product => product.name.toLowerCase() === productName);
            
                        if (matchingProduct) {
                            // Disable sizes that are already used for this product
                            const usedSize = matchingProduct.size;
            
                            ['Small', 'Medium', 'Large', 'Extra Large'].forEach(sizeOption => {
                                const isDisabled = sizeOption === usedSize;
                                const option = document.createElement('option');
                                option.value = sizeOption;
                                option.textContent = sizeOption;
                                if (isDisabled) {
                                    option.disabled = true;
                                }
                                sizeDropdown.appendChild(option);
                            });
                        } else {
                            // If no matching product, enable all sizes
                            ['Small', 'Medium', 'Large', 'Extra Large'].forEach(sizeOption => {
                                const option = document.createElement('option');
                                option.value = sizeOption;
                                option.textContent = sizeOption;
                                sizeDropdown.appendChild(option);
                            });
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>