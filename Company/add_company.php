<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company</title>
    <link rel="stylesheet" href="company.css">
    <link rel="stylesheet" href="../Sidebar/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Karla&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.0.2/css/countrySelect.min.css">
    <style>
        /* Add your custom styles here if needed */
    </style>
</head>
<body id="body-pd">
<?php
include_once("../Sidebar/sidebar.html");
?>

    <div class="sidebar">
        <h2>Probook</h2>
        <ul>
          
        </ul>
    </div>
    <div class="main-content">
        <h1 class="heading">Add Company</h1>
        <div class="container">
            <form id="customerForm">
                <div class="name">
                    <label for="companyName" class="companyName">Company Name:</label><br>
                    <input type="text" id="companyName" name="companyName" required>
                </div>
                
                <div class="name">
                    <label for="companyAddress" class="address">Company Address:</label><br>
                    <input type="text" id="companyAddress" name="companyAddress" placeholder="Enter address of company" required>
                </div>

                <div class="name">
                    <label for="contactName" class="name">Primary Contact Person:</label><br>
                    <input type="text" id="contactName" name="contactName" placeholder="Enter nme of contact person">
                </div><br>

                <div>
                    <h2>Contact Information</h2>

                    <div class="name">
                        <label for="companyEmail" class="email">Email:</label><br>
                        <input type="email" id="companyEmail" name="companyEmail" placeholder="Enter email" required>
                        <span id="emailError" class="error-message"></span><br>
                    </div>

                    <div class="name">
                        <label for="phoneNumber">Phone Number:</label><br>
                        <input type="text" id="phoneNumber" name="phoneNumber" placeholder="98XXXXXXXX">
                        <p id="message"></p>
                    </div>

                    <div class="name">
                        <label for="landlineNumber">Landline Number:</label><br>
                        <input type="text" id="landlineNumber" name="landlineNumber" placeholder="025-XXXXXXX">
                    </div>
                    
                    <div class="name">
                        <label for="state" class="stateRegion">State/Region:</label><br>
                        <input type="text" id="state" name="state" required>
                    </div>
                    
                    <div class="name">
                        <label for="country">Country:</label><br>
                        <input type="text" id="country" name="country" required>
                        <span id="countryError" class="error-message"></span>
                    </div><br>
                    <div class="name">
                        <div class="url">
                            <br>
                            <br>
                        <label for="URL">URL</label><br>
                        <input type="url" id="URL" name="URL">
                    </div>
                </div><br>

                    <button type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/country-select-js/2.0.2/js/countrySelect.min.js"></script>
    <script src="company.js"></script>
    <script>
        $(document).ready(function() {
            $("#country").countrySelect();
        });
    </script>
    <script src="../Sidebar/main.js"></script>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>
</html>


                