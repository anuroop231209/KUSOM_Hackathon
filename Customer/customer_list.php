<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Accounts</title>
    <link rel="stylesheet" href="../Sidebar/styles.css">
<style>
    .contain{
        margin-left: 60px;
    }
</style>

</head>
<body id="body-pd">
<?php
include_once("../Sidebar/sidebar.html");
?>
<div class="contain">

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
                        <td class="p-2">'.htmlspecialchars($data['street'].', '.$data['city'].', '. $data['country']).'</td>
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
</div>


<script src="../Sidebar/main.js"></script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>
</html>
