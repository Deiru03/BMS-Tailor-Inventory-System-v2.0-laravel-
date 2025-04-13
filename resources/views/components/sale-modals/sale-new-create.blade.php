@php
    // Include the modals for customer and supplier
    $suppliers = App\Models\SupplierInfo::all();
    $products = App\Models\Product::all();
    $categories = App\Models\CategoryProduct::all();
    $productTypes = App\Models\ProductType::all();
    $customers = App\Models\CustomersInfo::all();
@endphp<!-- filepath: c:\xampp\htdocs\• Other-Projects •\bms_tailor\resources\views\components\sale-modals\sale-new-create.blade.php -->
<div id="newSaleModal" class="fixed inset-0 bg-gray-800 bg-opacity-30 overflow-y-auto h-full w-full hidden transition-opacity duration-300 ease-in-out" style="z-index: 100;">
    <div class="relative top-20 mx-auto p-6 border border-gray-200 w-full max-w-3xl shadow-2xl rounded-lg bg-white max-h-[85vh] overflow-y-auto transform transition-all">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Create New Sale</h3>

        <form action="{{ route('sale-action.store') }}" method="POST" id="saleForm">
            @csrf

            <!-- Customer Selection -->
            <div class="mb-4">
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
                <select name="customer_id" id="customer_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">Select a Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Products Section -->
            <div id="products" class="space-y-4">
                <div class="product-row flex items-center space-x-4">
                    <div class="flex-1">
                        <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                        <select name="products[0][product_id]" class="w-full border-gray-300 rounded-md shadow-sm product-select" required>
                            <option value="">Select a Product</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}">
                                    {{ $product->name }} ({{ number_format($product->unit_price, 2) }} per unit)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="products[0][quantity]" class="w-full border-gray-300 rounded-md shadow-sm quantity-input" min="1" value="1" required>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700">Subtotal</label>
                        <p class="subtotal text-gray-900 font-semibold">0.00</p>
                    </div>
                    <button type="button" class="remove-product-row text-red-600 hover:text-red-800">Remove</button>
                </div>
            </div>

            <!-- Add Product Button -->
            <div class="mt-4">
                <button type="button" onclick="addProductRow()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add Product</button>
            </div>

            <!-- Total Amount -->
            <div class="mt-6">
                <label class="block text-lg font-medium text-gray-700">Total Amount</label>
                <p id="totalAmount" class="text-2xl font-bold text-gray-900">0.00</p>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('newSaleModal')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Create Sale</button>
            </div>
        </form>
    </div>
</div>

<script>
    let productIndex = 1;

    function addProductRow() {
        const productsDiv = document.getElementById('products');
        const newRow = document.createElement('div');
        newRow.classList.add('product-row', 'flex', 'items-center', 'space-x-4');
        newRow.innerHTML = `
            <div class="flex-1">
                <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                <select name="products[${productIndex}][product_id]" class="w-full border-gray-300 rounded-md shadow-sm product-select" required>
                    <option value="">Select a Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->unit_price }}">
                            {{ $product->name }} ({{ number_format($product->unit_price, 2) }} per unit)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="products[${productIndex}][quantity]" class="w-full border-gray-300 rounded-md shadow-sm quantity-input" min="1" value="1" required>
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700">Subtotal</label>
                <p class="subtotal text-gray-900 font-semibold">0.00</p>
            </div>
            <button type="button" class="remove-product-row text-red-600 hover:text-red-800">Remove</button>
        `;
        productsDiv.appendChild(newRow);
        productIndex++;
    }

    document.addEventListener('input', function (event) {
        if (event.target.classList.contains('product-select') || event.target.classList.contains('quantity-input')) {
            updateSubtotals();
        }
    });

    document.addEventListener('click', function (event) {
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
</script>