document.getElementById('staffForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const name = document.getElementById('name').value;
    const address = document.getElementById('address').value;
    const phone = document.getElementById('phone').value;
    const email = document.getElementById('email').value;
    
    // Create a new list item
    const li = document.createElement('li');
    li.appendChild(document.createTextNode(`Name: ${name}, Address: ${address}, Phone: ${phone}, Email: ${email}`));
    
    // Append the list item to the staff list
    document.getElementById('staffList').appendChild(li);
    
    // Clear form fields
    document.getElementById('staffForm').reset();
});
