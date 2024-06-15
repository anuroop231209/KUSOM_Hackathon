<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Debit</title>
    <link rel="stylesheet" href="Debit.css">
    <link rel="stylesheet" href="../Sidebar/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body id="body-pd">
<?php
include_once("../Sidebar/sidebar.html");
?>
    <div class="container">
        <div class="new-deposits">
         <h2>New Debit</h2>
            <form id="deposit-form" method="post" action="Debit.php">
            <div class="form group">
            <label for="accountSelect">Account</label>
            <select id="accountSelect" name="debitAccount">
                <option value="">Choose an Account</option>
                <!-- Populate with your account options-->
             </select>
         </div>
        <div class="form group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" value="2024-06-09">
        </div>
        <div class="form group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description">
        </div>
        <div class="form group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" name="amount">
        </div>
        <button type="submit">Submit</button>

    </form>
    </div>
    <div class="recent-deposits">
        <h2>Recent Debits</h2>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody id="recent-deposits-body">
           
            </tbody>
        </table>
     </div>
 </div>
 <script>

    document.addEventListener("DOMContentLoaded", function() {
    axios.get('../API/Fetch/fetch_customer.php')
        .then(response => {
            const customers = response.data;
            const customerSelect = document.getElementById('accountSelect');
            if (customers.length === 0) {
                window.location.href = '../Contacts/contacts/addCon/add_contact.html';
            } else {
                customers.forEach(customer => {
                    const option = document.createElement('option');
                    option.value = customer.customer_id;
                    option.textContent = customer.firstname;
                    customerSelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching customer:', error);
        });

</script>
 <script src="../Sidebar/main.js"></script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>
</html>