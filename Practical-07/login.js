document.getElementById("loginForm").addEventListener("submit", function(event){

    event.preventDefault();

    let username = document.getElementById("enrollment").value.trim();
    let password = document.getElementById("password").value;

    // Password Validation
    let passwordPattern = /^(?=.*[0-9])(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z0-9!@#$%^&*(),.?":{}|<>]{8,}$/;

if (!passwordPattern.test(password)) {
    alert("Password must be at least 8 characters long and contain at least one number and one special character.");
    return;
}

    // Username Validation
    if (username === "") {
    alert("Please enter your username.");
    return false;
}
    alert("Login Successful!");

    window.location.href = "dashboard.html";

});