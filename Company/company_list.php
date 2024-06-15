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
