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

document.getElementById('amount_paid').addEventListener('input', function () {
    const totalAmount = parseFloat(document.getElementById('totalAmount').textContent || 0);
    const amountPaid = parseFloat(this.value || 0);

    const changeDue = amountPaid > totalAmount ? (amountPaid - totalAmount).toFixed(2) : '0.00';
    const balance = amountPaid < totalAmount ? (totalAmount - amountPaid).toFixed(2) : '0.00';

    document.getElementById('change_due').textContent = changeDue;
    document.getElementById('balance').textContent = balance;
});