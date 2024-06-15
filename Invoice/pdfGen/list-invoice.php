<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Accounts</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="h-full bg-light">
<h2>CRM Accounts</h2>
<div class='table-responsive'>
    <table class='table table-bordered table-sm'>
        <thead class='thead-light'>
        <tr>
            <th class='p-2'>Id</th>
            <th class='p-2'>Invoice Number</th>
            <th class='p-2'>Invoice Date</th>
            <th class='p-2'>Invoice Due Date</th>
            <th class='p-2'>Quantity</th>
            <th class='p-2'>Rate</th>
            <th class='p-2'>Total Amount</th>
            <th class='p-2'>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include_once("../../Config/config.php");

        try {
            $query = "SELECT * FROM Invoice ORDER BY invoice_id DESC";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                foreach ($result as $data) {
                    echo '
                    <tr>
                        <td class="p-2">'.htmlspecialchars($data['invoice_id']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['invoice_number']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['invoice_date']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['invoice_due_date']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['quantity']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['rate']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['total_amount']).'</td>
                        <td class="p-2">
                            <a href="generate_invoice.php?invoice_id='.htmlspecialchars($data['invoice_id']).'" class="btn btn-info btn-sm">Generate Fetch</a>
                            <a href="delete.php?invoice_id='.htmlspecialchars($data['invoice_id']).'" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>';
                }
            } else {
                echo '<tr><td colspan="6" class="text-center">No records found.</td></tr>';
            }
        } catch (PDOException $e) {
            echo '<tr><td colspan="6" class="text-center">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JavaScript (optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
