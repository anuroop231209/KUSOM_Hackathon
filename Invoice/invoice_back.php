<?php
include '../Config/config.php';
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $response =[];

        $customer_id = $_POST['customer_id'];
        $product_id = $_POST['ProductID'];
        $invoice_number = $_POST['invoiceNumber'];
        $invoice_date = $_POST['invoiceDate'];
        $invoice_due_date = $_POST['invoiceDueDate'];
        $terms = $_POST['terms'];
        $quantity = $_POST['quantityHours'];
        $rate = $_POST['rate'];
        $discount = $_POST['discount'];
        $notes = $_POST['notes'];

        $query2="SELECT company_id FROM Customer where customer_id = :customer_id";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bindParam(':customer_id', $customer_id);
        $stmt2->execute();
        $business_id = $stmt2->fetchColumn();

        // Calculations
        $subtotal = $quantity * $rate;
        $discountAmount = ($subtotal * $discount) / 100;
        $discountedSubtotal = $subtotal - $discountAmount;
        $tax = $discountedSubtotal * 0.13;
        $total_amount = $discountedSubtotal + $tax;

        $query = 'INSERT INTO Fetch (customer_id, product_id, business_id, invoice_number, invoice_date, invoice_due_date, terms, quantity, rate, discount, subtotal, tax, total_amount, notes) VALUES (:customer_id, :product_id, :business_id, :invoice_number, :invoice_date, :invoice_due_date, :terms, :quantity, :rate, :discount, :subtotal, :tax, :total_amount, :notes)';
        // Insert into Fetch table
     try {

         $stmt = $conn->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':business_id', $business_id);
        $stmt->bindParam(':invoice_number', $invoice_number);
        $stmt->bindParam(':invoice_date', $invoice_date);
        $stmt->bindParam(':invoice_due_date', $invoice_due_date);
        $stmt->bindParam(':terms', $terms);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':rate', $rate);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':subtotal', $subtotal);
        $stmt->bindParam(':tax', $tax);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->bindParam(':notes', $notes);
        if($stmt->execute())
        {
            $response=[
                'status' => 'Success',
                'message' => 'Fetch created successfully'
            ];
        } else{
            $response=[
                'status' => 'Error',
                'message' => 'Failed to create invoice'
            ];
        }
     }catch(PDOException $e){
            $response=[
                'status' => 'Error',
                'message' => 'Failed to create invoice' . $e->getMessage()
            ];
     }
        echo json_encode($response);
    }