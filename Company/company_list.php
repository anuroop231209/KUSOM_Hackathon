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
            
.sidebar {
    height: 100%;
    width: 250px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #202557;
    padding-top: 20px;
    color: white;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    padding: 8px;
    text-align: center;
}

.sidebar ul li a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 10px 0;
}

.sidebar ul li a.active,
.sidebar ul li a:hover {
    background-color: #1c2689 ;
    color: white;
}

.main{
    margin-left: 300px;
}
</style>
</head>
<body id="body-pd" >
<?php
include_once("../Sidebar/sidebar.html");
?>    
<h2>CRM Accounts</h2>
<div class='main'>
    <table class='table table-bordered table-sm'>
        <thead class='thead-light'>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Landline Number</th>
            <th>Address</th>
            <th>URL</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="databody">
        <?php
        include_once("../Config/config.php");
        include_once("../API/Fetch/fetch_company.php");
        try {
            $result = $company;
            if (count($result) > 0) {
                foreach ($result as $data) {
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
                            <a href="summary.php?company_id='.htmlspecialchars($data['company_id']).'" class="btn btn-info btn-sm">View</a>
                            <a href="delete.php?company_id='.htmlspecialchars($data['company_id']).'" class="btn btn-danger btn-sm">Delete</a>
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
