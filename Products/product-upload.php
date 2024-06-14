<?php
include("../../Config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Name = $_POST['Name'];
    $Price = $_POST['Price'];
    $Description = $_POST['Description'];

    $response = [];

    // Client-side-like validation
    if (empty($Name) || empty($Price)) {
        $response = [
            'success' => false,
            'message' => "All fields are required"
        ];
    } else {
        try {
            $query = "INSERT INTO Products (Name, Price, Description) VALUES (:Name, :Price, :Description)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':Name', $Name);
            $stmt->bindParam(':Price', $Price);
            $stmt->bindParam(':Description', $Description);

            if ($stmt->execute()) {
                $response = [
                    'success' => true,
                    'message' => "Product registered successfully"
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => "Error registering Product"
                ];
            }
        } catch (PDOException $e) {
            $response = [
                'success' => false,
                'message' => "Error: " . $e->getMessage()
            ];
            // Log error or handle as necessary
        }
    }
    echo json_encode($response); // Send JSON response
}