// Load header.html into the page
document.addEventListener("DOMContentLoaded", function () {
    fetch("header.html")
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.text();
        })
        .then(data => {
            document.getElementById("header-container").innerHTML = data;
        })
        .catch(error => {
            console.error("Error loading header:", error);
        });
});

// Contact form submission logic
// Contact form submission logic
document.getElementById("contactUsButton").addEventListener("click", function (event) {
    // Prevent form submission for validation
    event.preventDefault();

    // Get form field values
    const nameField = document.getElementById("name");
    const emailField = document.getElementById("email");
    const subjectField = document.getElementById("subject");
    const messageField = document.getElementById("message");

    const name = nameField.value.trim();
    const email = emailField.value.trim();
    const subject = subjectField.value.trim();
    const message = messageField.value.trim();

    // Check if all fields are filled
    if (!name || !email || !subject || !message) {
        alert("Please fill all the required fields.");
    } else {
        // Display success alert
        alert("Your form has been successfully submitted.");

        // Clear each form field manually
        nameField.value = "";
        emailField.value = "";
        subjectField.value = "";
        messageField.value = "";

        // Optionally, you can submit the form here if needed
        // event.target.closest('form').submit();
    }
});
