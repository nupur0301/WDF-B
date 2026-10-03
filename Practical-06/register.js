function validateForm()
{
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let mobile = document.getElementById("mobile").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;
    let course = document.getElementById("course").value;
    let year = document.getElementById("year").value;
    let gender = document.getElementsByName("gender");
    let terms = document.getElementById("terms").checked;

    document.getElementById("nameError").innerHTML = "";
    document.getElementById("emailError").innerHTML = "";
    document.getElementById("mobileError").innerHTML = "";
    document.getElementById("passwordError").innerHTML = "";
    document.getElementById("confirmError").innerHTML = "";
    document.getElementById("courseError").innerHTML = "";
    document.getElementById("yearError").innerHTML = "";
    document.getElementById("genderError").innerHTML = "";
    document.getElementById("termsError").innerHTML = "";
    let nameRegex = /^[A-Za-z ]{3,30}$/;
    let emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    let mobileRegex = /^[6-9][0-9]{9}$/;
    let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
    let valid = true;
    if(!nameRegex.test(name))
    {
        document.getElementById("nameError").innerHTML="Enter a valid name.";
        valid = false;
    }
    if(!emailRegex.test(email))
    {
        document.getElementById("emailError").innerHTML="Invalid email.";
        valid = false;
    }
    if(!mobileRegex.test(mobile))
    {
        document.getElementById("mobileError").innerHTML="Enter a valid 10-digit mobile number.";
        valid = false;
    }
    if(!passwordRegex.test(password))
    {
        document.getElementById("passwordError").innerHTML="Password must contain 8+ characters, uppercase, lowercase, number and special character.";
        valid = false;
    }
    if(password != confirmPassword)
    {
        document.getElementById("confirmError").innerHTML="Passwords do not match.";
        valid = false;
    }
    if(course=="")
    {
        document.getElementById("courseError").innerHTML="Select a course.";
        valid = false;
    }
    if(year=="")
    {
        document.getElementById("yearError").innerHTML="Select a year.";
        valid = false;
    }
    let genderSelected = false;
    for(let i=0;i<gender.length;i++)
    {
        if(gender[i].checked)
        {
            genderSelected = true;
        }
    }
    if(!genderSelected)
    {
        document.getElementById("genderError").innerHTML="Select gender.";
        valid = false;
    }
    if(!terms)
    {
        document.getElementById("termsError").innerHTML="Accept Terms & Conditions.";
        valid = false;
    }
    if(valid)
    {
        alert("Registration Successful");
    }
    return valid;
}