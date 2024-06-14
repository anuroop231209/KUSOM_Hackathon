<!DOCTYPE html>
<html ln="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewpiont"content="width=device-width,initial-scale=1,0">
        <title>Invoice Form</title>
        <link rel="stylesheet" href="invoice.css">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <!-- Client Info Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Client Info</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="customerSelect">Client Name</label>
                                <select id="customerSelect" name="customer_id" class="form-control" required>
                                    <option value="">Select a customer</option>
                                    <option value="1">Customer A</option>
                                    <option value="2">Customer B</option>
                                    <option value="3">Customer C</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="billTo">Bill to</label>
                                <input type="text" name="billTo" class="form-control" id="billTo" placeholder="Bill to">
                            </div>
                            <div class="form-group">
                                <label for="invoiceNumber">Invoice Number</label>
                                <input type="text" name="invoiceNumber" class="form-control" id="invoiceNumber" placeholder="Invoice Number">
                            </div>
                            <div class="form-group">
                                <label for="invoiceDate">Invoice Date</label>
                                <input type="date" name="invoiceDate" class="form-control" id="invoiceDate">
                            </div>
                            <div class="form-group">
                                <label for="invoiceDueDate">Invoice Due Date</label>
                                <input type="date" name="invoiceDueDate" class="form-control" id="invoiceDueDate">
                            </div>
                            <div class="form-group">
                                <label for="terms">Terms</label>
                                <select name="terms" class="form-control" id="terms">
                                    <option value="1">Net 30 Days</option>
                                    <option value="2">Net 60 Days</option>
                                    <option value="3">Net 90 Days</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Invoice Details Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Invoice Details</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="productSelect">Product/Service</label>
                                <select id="productSelect" name="ProductID" class="form-control" required>
                                    <option value="">Select a product</option>
                                    <option value="1">Product X</option>
                                    <option value="2">Product Y</option>
                                    <option value="3">Product Z</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="rate">Rate</label>
                                <input type="number" name="rate" class="form-control" id="rate" placeholder="Rate" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="quantityHours">Qty/Hrs</label>
                                <input type="number" name="quantityHours" class="form-control" id="quantityHours" placeholder="Quantity/Hours" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="discount">Discount (%)</label>
                                <input type="number" id="discount" name="discount" class="form-control" oninput="calculateAmount()" placeholder="Discount" step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="subtotal">Subtotal</label>
                                <input type="number" id="subtotal" name="subtotal" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tax">Tax (13%)</label>
                                <input type="number" id="tax" name="tax" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="amount">Total Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" class="form-control" id="notes" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">Generate Invoice</button>
            </div>
        </div>
    </div>

    <script src="fetch_data.js"></script>
    <script>
        // Simulated data for customers and products
        var customers = [
            { id: 1, name: 'Customer A' },
            { id: 2, name: 'Customer B' },
            { id: 3, name: 'Customer C' }
        ];

        var products = [
            { id: 1, name: 'Product X' },
            { id: 2, name: 'Product Y' },
            { id: 3, name: 'Product Z' }
        ];

        // Populate customer select dropdown
        var customerSelect = document.getElementById('customerSelect');
        customers.forEach(function(customer) {
            var option = document.createElement('option');
            option.value = customer.id;
            option.textContent = customer.name;
            customerSelect.appendChild(option);
        });

        // Populate product select dropdown
        var productSelect = document.getElementById('productSelect');
        products.forEach(function(product) {
            var option = document.createElement('option');
            option.value = product.id;
            option.textContent = product.name;
            productSelect.appendChild(option);
        });

        // Function to calculate subtotal, tax, and total amount
        function calculateAmount() {
            var qty = parseFloat(document.getElementById('quantityHours').value) || 0;
            var rate = parseFloat(document.getElementById('rate').value) || 0;
            var discount = parseFloat(document.getElementById('discount').value) || 0;

            var subtotal = qty * rate;
            var discountAmount = (subtotal * discount) / 100;
            var discountedSubtotal = subtotal - discountAmount;
            var tax = discountedSubtotal * 0.13;
            var totalAmount = discountedSubtotal + tax;

            document.getElementById('subtotal').value = discountedSubtotal.toFixed(2);
            document.getElementById('tax').value = tax.toFixed(2);
            document.getElementById('amount').value = totalAmount.toFixed(2);
        }
    </script>
    </body>
</html>
