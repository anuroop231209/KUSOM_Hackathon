<?php
include_once('../../Config/config.php');
include_once('../ftp_upload.php');
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $user_id = $_SESSION['user_id'];
    $business_id = $_POST['business_id'];
    $business_name = $_POST['business_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $website = $_POST['website'];
    $logo_path = $_POST['logo_path_up'];

    if (isset($_FILES['logo_path']) && $_FILES['logo_path']['error'] == 0) {
        $logo_path = uploadFileViaFTP($_FILES['logo_path'], 'website/project/file_upload');
    } else {
        // Handle case where no new file is uploaded
        $logo_path = $_POST['logo_path']; // Ensure this is set in your form as a hidden input
    }


    $response =[];
    
    try {
        $query = "UPDATE BusinessInfo SET business_name = :business_name, address = :address, contact_number = :contact_number, email = :email, website = :website, logo_path = :logo_path WHERE user_id = :user_id AND business_id = :business_id";
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