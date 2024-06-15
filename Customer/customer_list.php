<!DOCTYPE html>
<html lang="en">
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
            <th class='p-2'>Name</th>
            <th class='p-2'>Email</th>
            <th class='p-2'>Phone</th>
            <th class='p-2'>Address</th>
            <th class='p-2'>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include_once("../Config/config.php");
        include_once("../API/Fetch/fetch_customer.php");
        try {
            $result = $customer;
            if (count($result) > 0) {
                foreach ($result as $data) {
                    echo '
                    <tr>
                        <td class="p-2">'.htmlspecialchars($data['customer_id']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['firstname'] .' '. $data['lastname']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['email']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['phone']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['street'].', '.$data['city']).'</td>
                        <td class="p-2">
                            <a href="summary.php?customer_id='.htmlspecialchars($data['customer_id']).'" class="btn btn-info btn-sm">View</a>
                            <a href="delete.php?customer_id='.htmlspecialchars($data['customer_id']).'" class="btn btn-danger btn-sm">Delete</a>
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
