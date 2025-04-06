// This code is for the product type search functionality in a form. used in PRODUCT-STORE
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('product_type_search');
    const dropdown = document.getElementById('product_type_dropdown');
    const hiddenSelect = document.getElementById('product_type');
    
    // Show dropdown on focus
    searchInput.addEventListener('focus', function() {
        dropdown.classList.remove('hidden');
    });
    
    // Filter items as user types
    searchInput.addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const items = dropdown.querySelectorAll('div');
        
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            if (text.includes(searchValue) || item.dataset.value === "") {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    });
    
    // Handle item selection
    dropdown.querySelectorAll('div').forEach(item => {
        item.addEventListener('click', function() {
            searchInput.value = this.textContent;
            hiddenSelect.value = this.dataset.value;
            dropdown.classList.add('hidden');
        });
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
});


// This code is for the product type search functionality in a form. used in PRODUCT-EDIT
document.addEventListener('DOMContentLoaded', function () {
    const productTypeInputs = document.querySelectorAll('[id^="product_type_search_"]');
    productTypeInputs.forEach(input => {
        const productId = input.id.split('_').pop(); // Extract product ID
        const dropdown = document.getElementById(`product_type_dropdown_${productId}`);
        const hiddenSelect = document.getElementById(`product_type_${productId}`);

        // Show dropdown on focus
        input.addEventListener('focus', function () {
            dropdown.classList.remove('hidden');
        });

        // Filter items as user types
        input.addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            const items = dropdown.querySelectorAll('div');

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(searchValue) || item.dataset.value === "") {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        });

        // Handle item selection
        dropdown.querySelectorAll('div').forEach(item => {
            item.addEventListener('click', function () {
                input.value = this.textContent;
                hiddenSelect.value = this.dataset.value;
                dropdown.classList.add('hidden');
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (!input.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    });
});