<?php
if(!isset($_SESSION['user_id'])){
    header('Location: ../Validation/signIn.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="add-product.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <form id="registrationForm" action="product-upload.php" method="post">
        <label for="Name">Name</label>
        <input type="text" id="Name" name="Name" required placeholder="Enter your name"><br>

        <label for="Price">Price</label>
        <input type="number" id="Price" name="Price" placeholder="Enter amount" required><br>
        
        <label for="Description">Description</label>
        <input type="text" id="Description" name="Description" placeholder="Description"><br>
        
        <button type="submit">Register</button>
        <span id="serverError" class="error-message"></span>
        <span id="serverSuccess" class="success-message"></span>
    </form>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
        event.preventDefault();
         const serverError = document.getElementById('serverError');
          const serverSuccess= document.getElementById('serverSuccess');

          serverError.textContent ="";
          serverSuccess.textContent="";

            document.getElementById('registrationForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                axios.post('product-upload.php', formData)
                    .then(function(response){
                        if(response.data.success){
                            serverSuccess.textcontent=response.data.message;
                        } else{
                            serverError.textContent=response.data.message;

                        }
                    })
                    .catch(error => {
                        console.error('Error submitting form:', error);
                        serverError.textContent = 'An error occurred. Please try again later.';
                    });
            });
        });
    </script>
</body>
</html>
