<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Additional styles specific to this page if needed */
        #serverError {
            color: red;
            font-weight: bold;
        }

        #serverSuccess {
            color: green;
            font-weight: bold;
        }

        .required {
            color: red;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="container mx-auto p-4">
    <?php
    // Assuming PHP code remains the same for fetching business info
    include_once("../../Config/config.php");

    $query = "SELECT * FROM BusinessInfo  ORDER BY business_id DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $business = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($business) {
        echo '
        <h2 class="text-2xl font-bold mb-4">Business</h2>
        <form id="updateCompanyForm" action="../API/Update/update_business_info.php" method="POST" class="bg-white p-6 rounded-lg shadow-lg" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="companyName">Business Name <span class="required">*</span></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="companyName" type="text" name="business_name" value="' . htmlspecialchars($business['business_name']) . '" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="companyAddress">Address <span class="required">*</span></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="companyAddress" type="text" name="address" value="' . htmlspecialchars($business['address']) . '" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="companyEmail">Email <span class="required">*</span></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="companyEmail" type="email" name="email" value="' . htmlspecialchars($business['email']) . '" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="companyPhone">Phone <span class="required">*</span></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="companyPhone" type="text" name="contact_number" value="' . htmlspecialchars($business['contact_number']) . '" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="companyWebsite">Website</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="companyWebsite" type="text" name="website" value="' . htmlspecialchars($business['website']) . '">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="companyLogo">Logo</label>
                <img  src="' .'http://localhost/'. htmlspecialchars($business['logo_path']) . '" alt="Logo" class="rounded-lg shadow-lg" style="max-width: 200px; max-height: 200px;">
                 <input type="hidden" name="logo_path" value='.htmlspecialchars($business['logo_path']).'>           
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="companyLogoFile">Upload New Logo</label>
                <input class="appearance-none block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline" id="companyLogoFile" type="file" name="logo_path_up">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Update
                </button>
            </div>
        </form>';
    } else {
        echo '<p class="text-center text-red-500">No business found.</p>';
    }
    ?>
    <span id="serverError" class="error-message"></span>
    <span id="serverSuccess" class="success-message"></span>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById('updateCompanyForm').addEventListener('submit', function (event) {
            event.preventDefault();

            let serverError = document.getElementById('serverError');
            let serverSuccess = document.getElementById('serverSuccess');

            serverError.textContent = '';
            serverSuccess.textContent = '';

            const formData = new FormData(this);
            axios.post('http://localhost/website/project/Hakathon/API/Update/update_business_info.php', formData)
                .then(function (response) {
                    if (response.data.success) {
                        console.log(response.data.message);
                        serverSuccess.textContent = response.data.message;
                    } else {
                        serverError.textContent = response.data.message;
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
