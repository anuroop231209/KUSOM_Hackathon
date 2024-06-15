document.addEventListener("DOMContentLoaded", function() {

    axios.get('../../API/Fetch/fetch_company.php')
        .then(response => {
            const company = response.data;
            console.log(company);
            const companySelect = document.getElementById('companySelect');
            if (company.length === 0) {
                alert('No Company found. Add company .');
            } else {
                company.forEach(company => {
                    const option = document.createElement('option');
                    option.value = company.company_id;
                    option.textContent = company.companyName;
                    companySelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching company:', error);
        });


    axios.get('../../API/Fetch/fetch_product.php')
        .then(response => {
            const products = response.data;
            const productSelect = document.getElementById('productSelect');
            if (products.length === 0) {
                alert('No products found. Add product .');
            } else {
                products.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.product_id;
                    option.textContent = product.productName;
                    option.dataset.price = product.productPrice; // Assuming the price is part of the response
                    productSelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching products:', error);
        });

    document.getElementById('productSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.dataset.price;
        document.getElementById('rate').value = price || '';
    });
});

function calculateAmount() {
    const quantity = parseFloat(document.getElementById('quantityHours').value) || 0;
    const rate = parseFloat(document.getElementById('rate').value) || 0;
    const discountRate = parseFloat(document.getElementById('discount').value) || 0;

    const subtotal = quantity * rate;
    const discountAmount = (subtotal * discountRate) / 100;
    const discountedSubtotal = subtotal - discountAmount;
    const tax = discountedSubtotal * 0.13;
    const totalAmount = discountedSubtotal + tax;

    document.getElementById('subtotal').value = discountedSubtotal.toFixed(2);
    document.getElementById('tax').value = tax.toFixed(2);
    document.getElementById('amount').value = totalAmount.toFixed(2);
}
