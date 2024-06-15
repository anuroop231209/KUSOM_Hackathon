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
    