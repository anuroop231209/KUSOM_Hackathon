<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probook</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="h-full bg-light">
<h2>Customer Lists</h2>
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
        include_once("../../../Config/config.php");

        try {
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM Invoice_company WHERE user_id=:user_id ORDER BY invoice_id DESC";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
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
                            <a href="generate_invoice.php?invoice_id='.htmlspecialchars($data['invoice_id']).'" class="btn btn-info btn-sm">Generate Invoice</a>
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

<button type="button" class="hidden-button"><a href="../add_invoice_customer.php" class="styled-button"> Back to add Invoice</a></button>

        <style>
            /* Reset default button styles */
/* Button Link Styles */
a.styled-button {
  display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  text-decoration: none;
  cursor: pointer;
  border-radius: 4px;
  background-color: #202557;
  color: #ffffff;
  border: 1px solid #2980b9; /* Optional: Add border for a more button-like appearance */
  transition: background-color 0.3s ease;
}

/* Hover state */
a.styled-button:hover {
  background-color: lightgray2980b9;
}

/* Active state */
a.styled-button:active {
  background-color: #1f618d;
}

/* Visited state */
a.styled-button:visited {
  color: #ffffff; /* Ensure visited links maintain the text color */
}

/* Disabled state */
a.styled-button:disabled {
  background-color: #bdc3c7;
  cursor: not-allowed;
  pointer-events: none; /* Disable pointer events on disabled links */
}

        </style>

<!-- Bootstrap JavaScript (optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
