<?php
include_once("../../Config/config.php");

if (isset($_GET['ProductID'])) {
    $id = htmlspecialchars($_GET['ProductID']);

    try {
        $query = "SELECT * FROM Products WHERE ProductID = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo '<h2>Account Details</h2>';
            echo '<p><strong>ID:</strong> ' . htmlspecialchars($data['ProductID']) . '</p>';
            echo '<p><strong>Name:</strong> ' . htmlspecialchars($data['Name']) . '</p>';
            echo '<p><strong>Email:</strong> ' . htmlspecialchars($data['Price']) . '</p>';
            echo '<p><strong>Phone:</strong> ' . htmlspecialchars($data['Description']) . '</p>';
        } else {
            echo '<p>No details found for this account.</p>';
        }
    } catch (PDOException $e) {
        echo '<p>Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
} else {
    echo '<p>Invalid request.</p>';
}