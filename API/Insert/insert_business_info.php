<?php
include_once('../../Config/config.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Validation/signIn.html');
    exit();
}
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $user_id = $_SESSION['user_id'];
    $business_name = $_POST['business_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $logo_path = $_POST['logo_path'];
    
    $response =[];
    
    try {
        $query ="INSERT INTO BusinessInfo(user_id,business_name,address,contact_number,email,website,logo_path) VALUES(:user_id,:business_name,:address,:contact_number,:email,:website,:logo_path)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':business_id', $business_id);
        $stmt->bindParam(':business_name', $business_name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':contact_number', $contact_number);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':website', $website);
        $stmt->bindParam(':logo_path', $logo_path);
        if($stmt->execute()){
            $response =[
                "success"=> true,
                "message" => "Info Updated Successfully"
            ];
        } else {
            $response =[
                "success" => false,
                "message" => "Failed to Update Info"
            ];
        }
    } catch (PDOException $e) {
        $response =[
            "success" => false,
            "message" => "Failed to Update Info"
        ];
        echo "Error: " . $e->getMessage();
    }
    echo json_encode($response);
}