$("#signupBtn").on("click", function (event) {
    // Prevent form submission for validation
    event.preventDefault();

    // Get form field values using jQuery
    const name = $("#name").val().trim();
    const email = $("#email").val().trim();
    const password = $("#password").val().trim();
    const confirmPassword = $("#confirmPassword").val().trim();

    // Simple email validation regex pattern
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Check if all fields are filled and valid
    if (!name || !email || !password || !confirmPassword) {
        alert("Please fill all the required fields.");
    } else if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
    } else if (password !== confirmPassword) {
        alert("Passwords do not match. Please try again.");
    } else {
        // Dummy signup success action (store user name in localStorage for greeting)
        localStorage.setItem('username', name);
        alert("Sign up successful. Redirecting to homepage...");

        // Redirect to homepage
        window.location.href = "/pages/home-page/home.html";
    }
});
