<?php
include_once(ROOT_DIR."/Config/config.php");


try {
    $user_id= $_SESSION['user_id'];
    $query = "SELECT * FROM Credit WHERE user_id = :user_id ORDER BY credit_Date DESC LIMIT 5";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $credit = $stmt->fetchAll();
    echo json_encode($credit);
}catch (PDOException $e) {
    $response=[
        'success' => false,
        'message' =>"Error:" . $e->getMessage()
    ];
    echo json_encode($response);
}