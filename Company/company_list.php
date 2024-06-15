<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Accounts</title>
 <link rel="stylesheet" href="../Sidebar/styles.css">
    
 <style>
            body{
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
                color: #202557;
            }
            table {
                width: 80%;
                border-collapse: collapse;
                background-color: #F5F5F5;
            }
            th, td {
                padding: 10px;
                border: 1px solid lightgray;
                text-align: left;
            }

</style>
</head>
<body id="body-pd" >
<?php
include_once("../Sidebar/sidebar.html");
?>    
<h2>Company List</h2>
<div >
    <table class='table table-bordered table-sm'>
        <thead class='thead-light'>
        <tr>
            <th class="p-2">Id</th>
            <th class="p-2">Name</th>
            <th class="p-2">Contact Person</th>
            <th class="p-2">Email</th>
            <th class="p-2">Phone Number</th>
            <th class="p-2">Landline Number</th>
            <th class="p-2">Address</th>
            <th class="p-2">URL</th>
            <th class="p-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include_once("../Config/config.php");
        include_once("../API/Fetch/fetch_company.php");
        try {
            if (count($company) > 0) {
                foreach ($company as $data) {
                    echo '
                    <tr>
                        <td class="p-2">'.htmlspecialchars($data['company_id']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['companyName'] ).'</td>
                        <td class="p-2">'.htmlspecialchars($data['contactName'] ).'</td>
                        <td class="p-2">'.htmlspecialchars($data['companyEmail']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['phoneNumber']).'</td>
                        <td class="p-2">'.htmlspecialchars($data['landLineNumber']).'</td>
                         <td class="p-2">'.htmlspecialchars($data['companyAddress'].', '.$data['state'].', '.$data['country'] ).'</td>
                        <td class="p-2">'.htmlspecialchars($data['URL']).'</td>
                        <td class="p-2">
                            <a href="summary_company.php?company_id='.htmlspecialchars($data['company_id']).'" class="btn btn-info btn-sm">View</a>
                            <a href="delete_company.php?company_id='.htmlspecialchars($data['company_id']).'" class="btn btn-danger btn-sm">Delete</a>
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

<script src="../Sidebar/main.js"></script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>
</html>
