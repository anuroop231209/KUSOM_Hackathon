document.addEventListener("DOMContentLoaded", function() {
    // Fetch company list
    axios.get('fetch_companies.php')
        .then(response => {
            const companies = response.data;
            const companySelect = document.getElementById('companySelect');
            if (companies.length === 0) {
                window.location.href = 'add_company.html';
            } else {
                companies.forEach(company => {
                    const option = document.createElement('option');
                    option.value = company.Company_id;
                    option.textContent = company.CompanyName;
                    companySelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Error fetching companies:', error);
        });

    // Handle form submission
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        axios.post('../Contacts-upload.php', formData)
            .then(response => {
                const data = response.data;
                alert(data.message);
                if (data.success) {
                    window.location.href = 'success.html';
                }
            })
            .catch(error => {
                console.error('Error submitting form:', error);
            });
    });
});
