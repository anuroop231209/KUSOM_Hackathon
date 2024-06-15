<?php
include_once '../../Config/config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Validation/signIn.html');
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $response = [];
    try {
                $password = password_hash($pass, PASSWORD_DEFAULT);

                $query = "INSERT INTO users(firstName,lastName,email,password) VALUES (:firstName,:lastName,:email,:password)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':firstName', $firstName);
                $stmt->bindParam(':lastName', $lastName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                if ($stmt->execute()) {
                    $response = [
                        "success" => true,
                        "message" => "User Added Successfully"
                    ];
                } else {
                    $response = [
                        "success" => false,
                        "message" => "Failed to add User "
                    ];
                }
            } catch (PDOException $e) {
                $response = [
                    "success" => false,
                    "message" => "Failed to add User"
                ];
                echo "Error: " . $e->getMessage();
            }

    echo json_encode($response);
}


