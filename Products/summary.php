<?php
include_once("../Config/config.php");

if(!isset($_SESSION['user_id'])){
    header('Location: ../Validation/signIn.html');
    exit();
}

if (isset($_GET['ProductID'])) {
    $id = htmlspecialchars($_GET['product_id']);

    try {
        $query = "SELECT * FROM Products WHERE product_id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo '<h2>Account Details</h2>';
            echo '<p><strong>ID:</strong> ' . htmlspecialchars($data['product_id']) . '</p>';
            echo '<p><strong>Name:</strong> ' . htmlspecialchars($data['productName']) . '</p>';
            echo '<p><strong>Email:</strong> ' . htmlspecialchars($data['productPrice']) . '</p>';
            echo '<p><strong>Phone:</strong> ' . htmlspecialchars($data['productDescription']) . '</p>';
        } else {
            echo '<p>No details found for this account.</p>';
        }
    } catch (PDOException $e) {
        echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
} else {
    echo '<p>Invalid request.</p>';
}