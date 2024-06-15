<?php
include_once '../../Config/config.php';
try {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT customer_id,firstname FROM Customer where user_id= :user_id ORDER BY customer_id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $customer = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($customer);
} catch (PDOException $e) {
    echo json_encode([]);
}
