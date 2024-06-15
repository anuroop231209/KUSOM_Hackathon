
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="add-product.css">
    <link rel="stylesheet" href="../Sidebar/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php
include_once("../Sidebar/sidebar.html");
?>
<div class="reg">
    <form id="registrationForm" action="../API/Insert/insert_product.php" method="post">
        <label for="product-registiration"><h2> Product Registration</h2></label>
        <label for="Name">Name</label>
        <input type="text" id="Name" name="Name" required placeholder="Enter product name"><br>

        <label for="Price">Price</label>
        <input type="number" id="Price" name="Price" placeholder="Enter amount" required><br>
        
        <label for="Description">Description</label>
        <input type="text" id="Description" name="Description" placeholder="Description"><br>
        
        <button type="submit">Register</button>
        <span id="serverError" class="error-message"></span>
        <span id="serverSuccess" class="success-message"></span>
    </form>
</div>

    <script>
            document.getElementById('registrationForm').addEventListener('submit', function(event) {
                event.preventDefault();
                let serverError = document.getElementById('serverError');
                let serverSuccess= document.getElementById('serverSuccess');

                serverError.textContent ='';
                serverSuccess.textContent='';
                const formData = new FormData(this);
                axios.post('../API/Insert/insert_product.php', formData)
                    .then(function(response){
                        if(response.data.success){
                            serverSuccess.textContent=response.data.message;
                        } else{
                            serverError.textContent=response.data.message;

                        }
                    })
                    .catch(error => {
                        console.error('Error submitting form:', error);
                        serverError.textContent = 'An error occurred. Please try again later.';
                    });
            });
    </script>

<script src="../Sidebar/main.js"></script>
<script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>
</html>
