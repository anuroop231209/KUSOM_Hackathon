<?php
//Include your existing database connection file
include '../../Backend/Config/config.php';

header('Content-Type: application/json');

try{
    //Handle form submission
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //Get data from POST request
        $account = $_POST['from'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];

        //Prepare and execute the SQL insert statement
        $stmt = $conn->prepare("INSERT INTO transactions (account, date, description, amount) VALUES (:account, :date, :description, :amount)");
        $stmt->execute([
            ':account'=> $account,
            ':date'=> $date,
            ':description'=> $description,
            ':amount'=> $amount
        ]);

        //Return success response
        echo json_encode(['status'=> 'success','message' => 'New credit added successfully' ]);
        } 
        //Handle fetch recent credits
        else if($_SERVER['REQUEST_METHOD'] == 'GET'){
            //Prepare and execute the SQL select statement
            $stmt = $conn->query("SELECT description, amount FROM credits ORDER BY id DESC LIMIT 10");
            $credits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Check if there are any credits
            if (empty($credits)) {
                echo json_encode(['status' => 'empty', 'message' => 'No transactions']);
            } else {
                echo json_encode(['status' => 'success', 'data' => $credits]);
            }
        }
    } catch (PDOException $e) {
        // Return error response
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
    ?>
