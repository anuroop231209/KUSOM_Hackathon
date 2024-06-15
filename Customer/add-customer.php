<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Karla&display=swap">
    <link rel="stylesheet" href="customer.css">
    <link rel="stylesheet" href="../Sidebar/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="script.js"></script>
</head>
<body id="body-pd">
<?php
include_once("../Sidebar/sidebar.html");
?> 
    <div class="container">
        <form id="registrationForm" action="../API/Insert/insert_customer.php" method="post">
            <h2>Add Customer</h2>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="street">Street:</label>
            <input type="text" id="street" name="street" >

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="state">State/Region:</label>
            <input type="text" id="state" name="state" required >

            <label for="postalcode">Postal Code:</label>
            <input type="text" id="postalcode" name="postalcode" >

            <label for="companySelect">Company:</label>
            <select id="companySelect" name="company_id" required>
                <option value="">Select a company</option>
            </select>

            <button type="submit">Register</button>
        </form>
    </div>
    <script src="../Sidebar/main.js"></script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>
</body>
</html>
