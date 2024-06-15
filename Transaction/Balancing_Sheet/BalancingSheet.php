<?php
// Include your existing database connection file
include '../../Backend/Config/config.php';

header('Content-Type: application/json');

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from POST request
    $account = $_POST['from'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $type = $_POST['type']; // 'credit' or 'deposit'

    if (empty($account) || empty($date) || empty($amount) || empty($description) || empty($type)) {
        $response = [
            'success' => false,
            'message' => 'All fields are required'
        ];
    } else {
        try {
            if ($type === 'credit') {
                // Prepare and execute the SQL insert statement for credits
                $query = "INSERT INTO Credit (creditAccount, creditDate, creditDescription, creditAmount) VALUES (:account, :date, :description, :amount)";
            } else if ($type === 'deposit') {
                // Prepare and execute the SQL insert statement for deposits
                $query = "INSERT INTO Deposit (depositAccount, depositDate, depositDescription, depositAmount) VALUES (:account, :date, :description, :amount)";
            } else {
                throw new Exception("Invalid type");
            }

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':account', $account);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':amount', $amount);

            if ($stmt->execute()) {
                $response = [
                    'success' => true,
                    'message' => ucfirst($type) . ' added successfully'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to add ' . $type
                ];
            }
        } catch (PDOException $e) {
            $response = [
                'success' => false,
                'message' => "Error: " . $e->getMessage()
            ];
        }
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch balance sheet data
    try {
        // Fetch total credits
        $query = "SELECT SUM(creditAmount) AS totalCredits FROM Credit";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $totalCredits = $stmt->fetch(PDO::FETCH_ASSOC)['totalCredits'];

        // Fetch total deposits
        $query = "SELECT SUM(depositAmount) AS totalDeposits FROM Deposit";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $totalDeposits = $stmt->fetch(PDO::FETCH_ASSOC)['totalDeposits'];

        // Calculate net profit or loss
        $netProfitLoss = $totalCredits - $totalDeposits;

        $response = [
            'totalCredits' => $totalCredits,
            'totalDeposits' => $totalDeposits,
            'netProfitLoss' => $netProfitLoss
        ];
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => "Error: " . $e->getMessage()
        ];
    }
}

echo json_encode($response);
?>
