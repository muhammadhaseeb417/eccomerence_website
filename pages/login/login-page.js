
console.log("Script loaded");
document.getElementById("loginForm").addEventListener("submit", async function (event) {
    console.log("Form submitted");
    event.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    try {
        alert("Login Attempt")
        const response = await fetch("/my_website/pages/login/login.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`,
        });

        const result = await response.json();

        const loginStatus = document.getElementById("loginStatus");
        if (result.status === "success") {
            loginStatus.innerHTML = `<span style="color: green;">${result.message}</span>`;
            window.location.href = "/my_website/pages/home-page/home.php"; // Redirect to homepage
        } else {
            loginStatus.innerHTML = `<span style="color: red;">${result.message}</span>`;
        }
    } catch (error) {
        console.error("Error:", error);
        document.getElementById("loginStatus").innerHTML =
            '<span style="color: red;">An error occurred. Please try again later.</span>';
    }
});
