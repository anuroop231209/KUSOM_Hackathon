<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Credit and Debit Information</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .totals {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h1>Credit and Debit Information</h1>
<div id="credit-section">
    <h2>Credits</h2>
    <table id="credit-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Credit Date</th>
            <th>Amount</th>


        </tr>
        </thead>
        <tbody>
        <!-- Credit rows will be inserted here -->
        </tbody>
    </table>
</div>

<div id="debit-section">
    <h2>Debits</h2>
    <table id="debit-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Debit Date</th>
            <th>Amount</th>

        </tr>
        </thead>
        <tbody>
        <!-- Debit rows will be inserted here -->
        </tbody>
    </table>
</div>

<div class="totals">
    <h2>Totals</h2>
    <p>Total Credit: <span id="total-credit"></span></p>
    <p>Total Debit: <span id="total-debit"></span></p>
    <p>Net Amount: <span id="net-amount"></span></p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '../../API/Fetch/fetch_balance_sheet.php', // Adjust the path to your PHP script
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response) {
                    // Populate Credit Table
                    var creditRows = '';
                    response.credits.forEach(function(credit) {
                        creditRows += '<tr>';
                        if(credit.customer_name == null) {
                            creditRows += '<td>' + (credit.company_name ? credit.company_name : '') + '</td>';
                        }else {
                            creditRows += '<td>' + (credit.customer_name ? credit.customer_name : '') + '</td>';
                        }
                        creditRows += '<td>' + credit.credit_Date + '</td>'; // Adjust field names as necessary
                        creditRows += '<td>' + credit.credit_Amount + '</td>';

                        creditRows += '</tr>';
                    });
                    $('#credit-table tbody').html(creditRows);

                    // Populate Debit Table
                    var debitRows = '';
                    response.debits.forEach(function(debit) {
                        debitRows += '<tr>';
                        if(debit.customer_name == null){
                            debitRows += '<td>' + (debit.company_name ? debit.company_name : '') + '</td>';
                        }else {
                            debitRows += '<td>' + (debit.customer_name ? debit.customer_name : '') + '</td>';
                        }
                        debitRows += '<td>' + debit.debit_Date + '</td>'; // Adjust field names as necessary
                        debitRows += '<td>' + debit.debit_Amount + '</td>';

                        debitRows += '</tr>';
                    });
                    $('#debit-table tbody').html(debitRows);

                    // Display Totals
                    $('#total-credit').text(response.totalCredit);
                    $('#total-debit').text(response.totalDebit);
                    $('#net-amount').text(response.netAmount);
                }
            },
            error: function() {
                console.log('Error fetching data.');
            }
        });
    });
</script>
</body>
</html>
