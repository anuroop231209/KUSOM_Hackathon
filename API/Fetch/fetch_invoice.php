<?php
include_once("../../Config/config.php");
try {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM Invoice_customer WHERE user_id = :user_id ORDER BY invoice_id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}catch(PDOException $e){
    echo json_encode(['error' => $e->getMessage()]);
}