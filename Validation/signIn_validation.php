<?php
session_start();
include("../Config/config.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $response = [];

    $email = $_POST["inputEmail"];
    $password = $_POST["inputPassword"];
    try{
        $query = "SELECT user_id,firstName,lastName,password from users WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(":email",$email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result) {
            if(password_verify($password,$result['password'])){
                $_SESSION['user_id'] = $result['user_id'];
                $_SESSION['firstName'] = $result['firstName'];
                $_SESSION['lastName'] = $result['lastName'];
                $response = [
                    'success' => true,
                    'message' => "Logged in successfully. Redirecting to Dashboard in 3 Seconds."
                ];
            }else{
                $response = [
                    'success' => false,
                    'message' => "Invalid email or password"
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => "Invalid email or password"
            ];
        }
    }catch(PDOException $e){
        $response = [
            'success' => false,
            'message' => "Error: ".$e->getMessage()
        ];
    }

    echo json_encode($response);
}