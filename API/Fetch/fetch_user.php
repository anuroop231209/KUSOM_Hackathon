<?php
include_once '../../Config/config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Validation/signIn.html');
    exit();
}

try{
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users where user_id=:user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":user_id",$user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($user);
}catch(PDOException $e){
    echo json_encode([]);
}
