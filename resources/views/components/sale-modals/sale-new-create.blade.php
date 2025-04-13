@php
    // Include the modals for customer and supplier
    $suppliers = App\Models\SupplierInfo::all();
    $products = App\Models\Product::all();
    $categories = App\Models\CategoryProduct::all();
    $productTypes = App\Models\ProductType::all();
    $customers = App\Models\CustomersInfo::all();
@endphp<!-- filepath: c:\xampp\htdocs\• Other-Projects •\bms_tailor\resources\views\components\sale-modals\sale-new-create.blade.php -->
<div id="newSaleModal"
    class="fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full hidden transition-opacity duration-300 ease-in-out"
    style="z-index: 100;">
    <div
        class="relative top-20 mx-auto p-0 border border-gray-200 w-full max-w-4xl shadow-2xl rounded-lg bg-white max-h-[85vh] overflow-hidden transform transition-all">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-white">Create New Sale</h3>
            <button type="button" onclick="closeModal('newSaleModal')" class="text-white hover:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6 overflow-y-auto max-h-[calc(85vh-80px)]">
            <form action="{{ route('sale-action.store') }}" method="POST" id="saleForm">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <!-- Customer Selection Card -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                        <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                            </svg>
                            Customer Information
                        </h4>
                        <div class="form-group">
                            <label for="customer_search"
                                class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                            <div class="relative">
                                <input type="text" id="customer_search"
                                    class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Search Customer..." autocomplete="off">
                                <select name="customer_id" id="customer_id" class="hidden">
                                    <option value="">Select a Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                <div id="customer_dropdown"
                                    class="absolute z-10 w-full mt-1 bg-white shadow-lg max-h-60 rounded-md py-1 text-base overflow-auto hidden">
                                    <div class="px-3 py-2 text-gray-400 cursor-default hover:bg-gray-100"
                                        data-value="">Select a Customer</div>
                                    @foreach ($customers as $customer)
                                        <div class="px-3 py-2 cursor-pointer hover:bg-gray-100"
                                            data-value="{{ $customer->id }}">{{ $customer->name }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Section Card -->
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                        <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                    clip-rule="evenodd" />
                            </svg>
                            Products
                        </h4>

                        <div id="products" class="space-y-4">
                            <div
                                class="product-row bg-gray-50 p-3 rounded-lg flex flex-wrap md:flex-nowrap md:items-center gap-4">
                                <div class="w-full md:w-2/5">
                                    <label for="product_id"
                                        class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                                    <select name="products[0][product_id]"
                                        class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 product-select"
                                        required>
                                        <option value="">Select a Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}"
                                                class="py-2 text-base">
                                                <span class="font-medium">{{ $product->name }}</span> -
                                                <span
                                                    class="text-blue-600 font-semibold">₱{{ number_format($product->unit_price, 2) }}</span>
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <div class="form-group">
                                        <label for="product_search" class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                                        <div class="relative">
                                            <input type="text" id="product_search" class="form-control w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search Product..." autocomplete="off">
                                            <select name="products[0][product_id]" id="product_id" class="hidden">
                                                <option value="">Select a Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}">{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                            <div id="product_dropdown" class="absolute z-10 w-full mt-1 bg-white shadow-lg max-h-60 rounded-md py-1 text-base overflow-auto hidden">
                                                <div class="px-3 py-2 text-gray-400 cursor-default hover:bg-gray-100" data-value="">Select a Product</div>
                                                @foreach ($products as $product)
                                                    <div class="px-3 py-2 cursor-pointer hover:bg-gray-100" data-value="{{ $product->id }}" data-price="{{ $product->unit_price }}">{{ $product->name }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="w-full md:w-1/5">
                                    <label for="quantity"
                                        class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                    <input type="number" name="products[0][quantity]"
                                        class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 quantity-input"
                                        min="1" value="1" required>
                                </div>
                                <div class="w-full md:w-1/5">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Subtotal</label>
                                    <p
                                        class="subtotal text-gray-900 font-semibold bg-white border border-gray-200 rounded-lg p-2.5">
                                        0.00</p>
                                </div>
                                <div class="w-full md:w-1/5 flex items-end">
                                    <button type="button"
                                        class="remove-product-row text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mt-auto w-full">Remove</button>
                                </div>
                            </div>
                        </div>

                        <!-- Add Product Button -->
                        <div class="mt-4">
                            <button type="button" onclick="addProductRow()"
                                class="flex items-center justify-center px-4 py-2.5 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors focus:ring-4 focus:ring-blue-300 w-full md:w-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Add Product
                            </button>
                        </div>
                    </div>

                    <!-- Total and Payment Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Total Section -->
                        <div
                            class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg border border-blue-200 shadow-sm p-4">
                            <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-14a3 3 0 00-3 3v2H7a1 1 0 000 2h1v1a1 1 0 01-1 1 1 1 0 100 2h6a1 1 0 100-2H9.83c.11-.313.17-.65.17-1v-1h1a1 1 0 100-2h-1V7a1 1 0 112 0 1 1 0 102 0 3 3 0 00-3-3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Sale Total
                            </h4>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <p class="text-gray-600 mb-2">Total Amount:</p>
                                <p id="totalAmount" class="text-3xl font-bold text-blue-700">0.00</p>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-4">
                            <h4 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                    <path fill-rule="evenodd"
                                        d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                Payment Details
                            </h4>

                            <div class="mt-3">
                                <label for="amount_paid" class="block text-sm font-medium text-gray-700 mb-1">Amount
                                    Paid</label>
                                <input type="number" name="amount_paid" id="amount_paid"
                                    class="w-full bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                                    step="0.01" min="0" required>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Change Due</label>
                                    <p id="change_due"
                                        class="bg-green-50 text-green-700 font-semibold border border-green-200 rounded-lg p-2.5">
                                        0.00</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Balance</label>
                                    <p id="balance"
                                        class="bg-orange-50 text-orange-700 font-semibold border border-orange-200 rounded-lg p-2.5">
                                        0.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end space-x-3 border-t border-gray-200 pt-6">
                    <button type="button" onclick="closeModal('newSaleModal')"
                        class="px-6 py-2.5 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 focus:ring-4 focus:ring-gray-200 font-medium transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium transition-colors">
                        Complete Sale
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let productIndex = 1;

    function addProductRow() {
        const productsDiv = document.getElementById('products');
        const newRow = document.createElement('div');
        newRow.classList.add('product-row', 'flex', 'items-center', 'space-x-4');
        newRow.classList.add('product-row', 'bg-gray-50', 'p-3', 'rounded-lg', 'flex', 'flex-wrap', 'md:flex-nowrap',
            'md:items-center', 'gap-4');
        newRow.innerHTML = `
            <div class="w-full md:w-2/5">
                <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">Product</label>
                <select name="products[${productIndex}][product_id]" class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 product-select" required>
                    <option value="">Select a Product</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}" class="py-2 text-base">
                        <span class="font-medium">{{ $product->name }}</span> - 
                        <span class="text-blue-600 font-semibold">₱{{ number_format($product->unit_price, 2) }}</span>
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/5">
                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                <input type="number" name="products[${productIndex}][quantity]" class="w-full bg-white border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 quantity-input" min="1" value="1" required>
            </div>
            <div class="w-full md:w-1/5">
                <label class="block text-sm font-medium text-gray-700 mb-1">Subtotal</label>
                <p class="subtotal text-gray-900 font-semibold bg-white border border-gray-200 rounded-lg p-2.5">0.00</p>
            </div>
            <div class="w-full md:w-1/5 flex items-end">
                <button type="button" class="remove-product-row text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 mt-auto w-full">Remove</button>
            </div>
        `;
        productsDiv.appendChild(newRow);
        productIndex++;
    }

    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('product-select') || event.target.classList.contains(
                'quantity-input')) {
            updateSubtotals();
        }
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-product-row')) {
            event.target.closest('.product-row').remove();
            updateSubtotals();
        }
    });

    function updateSubtotals() {
        let totalAmount = 0;
        document.querySelectorAll('.product-row').forEach(row => {
            const productSelect = row.querySelector('.product-select');
            const quantityInput = row.querySelector('.quantity-input');
            const subtotalElement = row.querySelector('.subtotal');

            const price = parseFloat(productSelect.options[productSelect.selectedIndex]?.dataset?.price || 0);
            const quantity = parseInt(quantityInput.value || 0);

            const subtotal = price * quantity;
            subtotalElement.textContent = subtotal.toFixed(2);

            totalAmount += subtotal;
        });

        document.getElementById('totalAmount').textContent = totalAmount.toFixed(2);
    }

    document.getElementById('amount_paid').addEventListener('input', function() {
        const totalAmount = parseFloat(document.getElementById('totalAmount').textContent || 0);
        const amountPaid = parseFloat(this.value || 0);

        const changeDue = amountPaid > totalAmount ? (amountPaid - totalAmount).toFixed(2) : '0.00';
        const balance = amountPaid < totalAmount ? (totalAmount - amountPaid).toFixed(2) : '0.00';

        document.getElementById('change_due').textContent = changeDue;
        document.getElementById('balance').textContent = balance;
    });
</script>
