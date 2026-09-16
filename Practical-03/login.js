function loginValidation() {

    var enrollment = document.getElementById("enrollment").value;
    var password = document.getElementById("password").value;

    if (enrollment == "") {
        alert("Please enter your Enrollment Number.");
        return false;
    }

    if (password == "") {
        alert("Please enter your Password.");
        return false;
    }

    alert("Login Successful!");

    window.location.href = "dashboard.html";

    return false;
}