<?php
include_once '../../Config/config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Validation/signIn.html');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postalcode = $_POST['postalcode'];
    $country = $_POST['country'];

    $response = [];

    try {
        $query = "INSERT INTO Customer(user_id,firstname,lastname,email,phone,street,city,state,postalcode,country) VALUES (:user_id,:firstname,:lastname,:email,:phone,:street,:city,:state,:postalcode,:country) ";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':street', $street);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':postalcode', $postalcode);
        $stmt->bindParam(':country', $country);

        if ($stmt->execute()) {
            $response = [
                "success" => true,
                "message" => "Customer Info Updated Successfully"
            ];
        } else {
            $response = [
                "success" => false,
                "message" => "Failed to Update Customer Info"
            ];
        }
    } catch (PDOException $e) {
        $response = [
            "success" => false,
            "message" => "Failed to Update Customer Info"
        ];
        echo "Error: " . $e->getMessage();
    }
    echo json_encode($response);
}
