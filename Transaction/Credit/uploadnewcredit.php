<?php
// Include your existing database connection file
include '../../Backend/Config/config.php';

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $account = $_POST['from'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $response=[];

    if(empty($account) || empty($date) || empty($amount) || empty($description)){
        $response=[
            'success' => false,
            'message' => 'All fields are required'
        ];
    }
    else{

        try {

        // Prepare and execute the SQL insert statement
        $query ="INSERT INTO Credit (creditName, creditDate, creditDescription, creditAmount) VALUES (:account, :date, :description, :amount)";
        $stmt=$conn->prepare($query);
        $stmt->bindParam(':account', $account);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':amount', $amount);

        if($stmt->execute()){
            $response=[
                'success' => true,
                'message' => 'Credit added successfully'
            ];
        }else{
            $response=[
                'success' => false,
                'message' => 'Failed to add credit'
            ];
        }

        }catch (PDOException $e) {
            $response=[
                'success' => false,
                'message' =>"Error:" . $e->getMessage()
            ];

        }
    }
    echo json_encode($response);
}

?>
