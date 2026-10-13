<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentHub | Registration</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="container">
        <img src="banner.png" alt="StudentHub Logo" class="logo">
        <h1>StudentHub Portal</h1>
        <h3>Create New Student Account</h3>
    </div>
</header>

<nav>
    <div class="container">

        <div class="menu-icon" onclick="toggleMenu()">
              ☰
        </div>

        <div class="nav-links" id="navLinks">
            <a href="index.html">Home</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
            <a href="login.html">Login</a>
        </div>

        <div class="theme-toggle">
            <span>☀️</span>
            <label class="switch">
                <input type="checkbox" id="themeSwitch">
                <span class="slider"></span>
            </label>
            <span>🌙</span>
        </div>

    </div>
</nav>

<main>
   <div class="register-container">
    <h2>Create Your Account</h2>

    <form id="registerForm" method="post" action="signup_process.php">

        <label for="name">Full Name</label><br>
        <input type="text" id="name" name="name" placeholder="Enter your full name">
        <span id="nameError" class="error"></span>
        <br><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" placeholder="Enter your email">
        <span id="emailError" class="error"></span>
        <br><br>

        <label for="mobile">Mobile Number</label><br>
        <input type="tel" id="mobile" name="mobile" placeholder="Enter mobile number">
        <span id="mobileError" class="error"></span>
        <br><br>

        <label for="username">Username</label><br>
        <input type="text" id="username" name="username" placeholder="Enter username">
        <span id="usernameError" class="error"></span>
        <br><br>

        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" placeholder="Enter password">
        <span id="passwordError" class="error"></span>
        <br><br>

        <label for="confirmPassword">Confirm Password</label><br>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
        <span id="confirmError" class="error"></span>
        <br><br>
        
        <input type="submit" value="Register">
        <input type="reset" value="Reset">
    </form>
</div>

    <div class="login-link">
        Already have an account?
        <a href="login.html">Login Here</a>
    </div>
</main>

<footer>
    <div class="container">
        <p><strong>StudentHub Portal</strong></p>
        <p>Charotar University of Science and Technology</p>
        <p>Email : info@charusat.edu</p>
        <p>Phone : +91 9876543210</p>
        <p>Address : Changa, Anand, Gujarat</p>
        <p>&copy; 2026 StudentHub Portal. All Rights Reserved.</p>
    </div>
</footer>

<script src="theme.js"></script>
<script src="menu.js"></script>
</body>
</html>