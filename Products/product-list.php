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
            <th class='p-2'>Price</th>
            <th class='p-2'>Description</th>
            <th class='p-2'>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include_once("../API/Fetch/fetch_product.php");
        try {
            if (count($product) > 0) {
                foreach ($product as $data) {
                    echo '
                    <tr>
                        <td class="p-2">'.htmlspecialchars($data['product_id']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['productName']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['productPrice']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['productDescription']).'</td>
                        <td class="p-2">
                            <a href="summary.php?product_id='.htmlspecialchars($data['product_id']).'" class="btn btn-info btn-sm">View</a>
                            <a href="delete.php?product_id='.htmlspecialchars($data['product_id']).'" class="btn btn-danger btn-sm">Delete</a>
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
