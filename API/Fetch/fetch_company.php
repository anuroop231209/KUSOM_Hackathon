<?php
include_once '../../Config/config.php';
if(!isset($_SESSION['user_id'])){
    header('Location: ../Validation/signIn.html');
    exit();
}
try {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM Company where user_id= :user_id ORDER BY company_id DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $company = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($company);
} catch (PDOException $e) {
    echo json_encode([]);
}