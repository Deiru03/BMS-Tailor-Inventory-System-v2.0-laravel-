<!-- filepath: c:\xampp\htdocs\• Other-Projects •\bms_tailor\resources\views\components\product-modals\product-show.blade.php -->
<div id="productShowModal-{{ $product->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-40 overflow-y-auto h-full w-full hidden transition-opacity duration-300 ease-in-out backdrop-blur-sm" style="z-index: 100;">
    <div class="relative top-20 mx-auto p-0 border-0 w-full max-w-2xl shadow-2xl rounded-xl bg-white max-h-[85vh] flex flex-col overflow-hidden transform transition-all">
        <!-- Header with gradient -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Product Details</h3>
                <button type="button" class="text-white/80 hover:text-white transition-colors focus:outline-none" onclick="closeModal('productShowModal-{{ $product->id }}')">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="text-indigo-100 mt-1 text-sm">Code: {{ $product->product_code }}</p>
        </div>
        
        <div class="p-6 overflow-y-auto">
            <!-- Basic Information Section -->
            <div class="mb-6 p-5 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg shadow-sm border border-blue-100">
                <h4 class="text-lg font-medium text-indigo-700 mb-3 border-b border-indigo-100 pb-2">Basic Information</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Name</p>
                        <p class="text-indigo-800 font-medium">{{ $product->name }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Category</p>
                        <p class="text-indigo-800 font-medium">{{ $product->category->name ?? 'Not specified' }}</p>
                    </div>

                    <div class="form-group col-span-2">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Description</p>
                        <p class="text-gray-700">{{ $product->description ?: 'No description provided' }}</p>
                    </div>
                </div>
            </div>

            <!-- Supplier Information Section -->
            <div class="mb-6 p-5 bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg shadow-sm border border-purple-100">
                <h4 class="text-lg font-medium text-purple-700 mb-3 border-b border-purple-100 pb-2">Supplier Information</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Supplier</p>
                        <p class="text-purple-800 font-medium">{{ $product->supplier ? $product->supplier->name : 'Not specified' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Supplier Contact</p>
                        <p class="text-purple-800 font-medium">{{ $product->supplier ? $product->supplier->phone : 'Not specified' }}</p>
                    </div>
                </div>
            </div>

            <!-- Inventory & Pricing Section -->
            <div class="mb-6 p-5 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-lg shadow-sm border border-amber-100">
                <h4 class="text-lg font-medium text-amber-700 mb-3 border-b border-amber-100 pb-2">Inventory & Pricing</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Stock Quantity</p>
                        <p class="text-amber-800 font-medium">{{ $product->stock_quantity }} {{ $product->unit }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Unit</p>
                        <p class="text-amber-800 font-medium">{{ $product->unit ?: 'Not set' }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Unit Price</p>
                        <p class="text-amber-800 font-medium">₱{{ number_format($product->unit_price, 2) }}</p>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Cost Price</p>
                        <p class="text-amber-800 font-medium">₱{{ number_format($product->cost_price, 2) }}</p>
                    </div>
                </div>
            </div>

            <!-- Status & Location Section -->
            <div class="mb-6 p-5 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg shadow-sm border border-green-100">
                <h4 class="text-lg font-medium text-emerald-700 mb-3 border-b border-emerald-100 pb-2">Status Information</h4>
                <div class="grid grid-cols-3 gap-4">
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Status</p>
                        <span class="{{ $product->status == 'in_stock' ? 'bg-green-100 text-green-800 border border-green-200' : ($product->status == 'out_of_stock' ? 'bg-red-100 text-red-800 border border-red-200' : 'bg-gray-100 text-gray-800 border border-gray-200') }} px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            {{ ucwords(str_replace('_', ' ', $product->status)) }}
                        </span>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Is Active</p>
                        <span class="{{ $product->is_active ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200' }} px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                            {{ $product->is_active ? 'Yes' : 'No' }}
                        </span>
                    </div>

                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">Reorder Level</p>
                        <p class="text-emerald-800">{{ $product->reorder_level ?? 'Not set' }}</p>
                    </div>
                </div>
            </div>

            <!-- Product Attributes (if any) -->
            @if($product->attributes && count(json_decode($product->attributes, true)) > 0)
            <div class="mb-6 p-5 bg-gradient-to-r from-gray-50 to-slate-50 rounded-lg shadow-sm border border-gray-100">
                <h4 class="text-lg font-medium text-gray-700 mb-3 border-b border-gray-100 pb-2">Product Attributes</h4>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(json_decode($product->attributes, true) as $key => $value)
                    <div class="form-group">
                        <p class="block text-sm font-medium text-gray-600 mb-1">{{ ucfirst(str_replace('_', ' ', $key)) }}</p>
                        <p class="text-gray-800">{{ $value }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 p-4 border-t border-gray-100 flex justify-between items-center">
            <button 
                type="button" 
                onclick="openModal('productEditModal-{{ $product->id }}')"
                class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors"
            >
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Edit product
                </span>
            </button>
            <button 
                type="button" 
                onclick="closeModal('productShowModal-{{ $product->id }}')" 
                class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors"
            >
                Close
            </button>
        </div>
    </div>
</div>
