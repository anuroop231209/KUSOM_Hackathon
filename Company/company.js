document.addEventListener("DOMContentLoaded", function(event){
    event.preventDefault();
    $(document).ready(function() {
        // Initialize country dropdown using country-select-js library
        $("#country").countrySelect();
    
        // Form submission handling
        $("#customerForm").submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting
    
            // Reset any previous error messages
            $(".error-message").text("");
    
            // Validate inputs
            let isValid = true;
    
            // Validate Company Name
            let companyName = $("#companyName").val().trim();
            if (companyName === "") {
                $("#companyName").next(".error-message").text("Company Name is required.");
                isValid = false;
            }
    
            // Validate Company Address (optional)
            let companyAddress = $("#address").val().trim();
    
            // Validate Primary Contact Person
            let contactPerson = $("#name").val().trim();
            if (contactPerson === "") {
                $("#name").next(".error-message").text("Primary Contact Person is required.");
                isValid = false;
            }
    
            // Validate Email (optional, but if provided, it must be valid)
            let email = $("#email").val().trim();
            if (email !== "" && !isValidEmail(email)) {
                $("#email").next(".error-message").text("Invalid email format.");
                isValid = false;
            }
    
            // Validate Phone Number
            let phoneNumber = $("#phoneNumber").val().trim();
            if (phoneNumber === "") {
                $("#phoneNumber").next(".error-message").text("Phone Number is required.");
                isValid = false;
            } else if (!isValidPhoneNumber(phoneNumber)) {
                $("#phoneNumber").next(".error-message").text("Invalid phone number format.");
                isValid = false;
            }
    
            // Validate Landline Number (optional, if provided, must be valid)
            let landlineNumber = $("#landlineNumber").val().trim();
            if (landlineNumber !== "" && !isValidLandlineNumber(landlineNumber)) {
                $("#landlineNumber").next(".error-message").text("Invalid landline number format.");
                isValid = false;
            }
    
            // Validate State/Region (optional)
            let stateRegion = $("#stateRegion").val().trim();
    
            // Validate Country (required by country-select-js, so no need to re-validate)
            let country = $("#country").val().trim();
            if (country === "") {
                $("#country").next(".error-message").text("Country is required.");
                isValid = false;
            }
    
            // If all inputs are valid, simulate form submission (you can replace this with actual form submission logic)
            if (isValid) {
                console.log("Form submitted successfully!");
                console.log("Company Name:", companyName);
                console.log("Company Address:", companyAddress);
                console.log("Primary Contact Person:", contactPerson);
                console.log("Email:", email);
                console.log("Phone Number:", phoneNumber);
                console.log("Landline Number:", landlineNumber);
                console.log("State/Region:", stateRegion);
                console.log("Country:", country);
    
                // Reset the form or perform any other necessary actions
                // Example: $("#customerForm")[0].reset();
            }
        });
    
        // Helper function to validate email format
        function isValidEmail(email) {
            // Basic email format validation (you can enhance this as per your requirements)
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    
        // Helper function to validate phone number format (98XXXXXXXX)
        function isValidPhoneNumber(phoneNumber) {
            let phoneRegex = /^98\d{8}$/;
            return phoneRegex.test(phoneNumber);
        }
    
        // Helper function to validate landline number format (025-XXXXXXX)
        function isValidLandlineNumber(landlineNumber) {
            let landlineRegex = /^025-\d{7}$/;
            return landlineRegex.test(landlineNumber);
        }
    });
    

});
