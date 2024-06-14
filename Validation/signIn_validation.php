<?php
session_start();
include("../Config/config.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $response = [];

    $email = $_POST["inputEmail"];
    $password = $_POST["inputPassword"];
    try{
        $query = "SELECT user_id,password from users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(":email",$email);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        $response = [
            'success' => false,
            'message' => "Error: ".$e->getMessage()
        ];
    }
    if($result) {
        if(password_verify($password,$result['password'])){
            $_SESSION['user_id'] = $result['user_id'];
            $response = [
                'success' => true,
                'message' => "User logged in successfully"
            ];
        }else{
            $response = [
                'success' => false,
                'message' => "Invalid email or password"
            ];
            exit();
        }
    } else {
        $response = [
            'success' => false,
            'message' => "Invalid email or password"
        ];
        exit();
    }
    echo json_encode($response);
}