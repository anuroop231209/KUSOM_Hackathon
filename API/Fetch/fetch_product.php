<?php
include_once '../../Config/config.php';

if(!isset($_SESSION['user_id'])){
    header('Location: ../Validation/signIn.html');
    exit();
}
try {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM Product where user_id= :user_id ORDER BY product_id DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $product = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($product);
} catch (PDOException $e) {
    echo json_encode([]);
}