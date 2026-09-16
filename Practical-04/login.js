document.getElementById("loginForm").addEventListener("submit", function(event){

    event.preventDefault();

    let username = document.getElementById("enrollment").value.trim();
    let password = document.getElementById("password").value;

    // Password Validation
    if(password.length !== 8){
        alert("Password must contain exactly 8 characters.");
        return;
    }

    // Username Validation
    if(username.length !== 8){
        alert("Username must contain exactly 8 characters.");
        return;
    }

    let letters = username.match(/[A-Za-z]/g) || [];
    let numbers = username.match(/[0-9]/g) || [];

    if(letters.length !== 2 || numbers.length !== 6){
        alert("Username must contain exactly 2 letters and exactly 6 numbers.");
        return;
    }

    alert("Login Successful!");

    window.location.href = "dashboard.html";

});