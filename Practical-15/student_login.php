<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentHub | Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="notificationBanner" class="notification-banner">
    <span>📢 Login using your StudentHub Enrollment Number and Password.</span>
    <button id="closeNotification">&times;</button>
</div>
    <header>
        <div class="container">
<img src="banner.png" alt="StudentHub Logo" width="120">
            <h1>StudentHub Portal</h1>
            <h3>Student Login</h3>
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
    <a href="login.php">Login</a>
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
        <div class="container">
            <h2>Student Login</h2>
            <form id="loginForm" class="login-form" method="post" action="login_process.php">
                <label for="enrollment">Enter Username</label>
                <input type="text" id="enrollment" name="login_id" placeholder="Enter Username or Email">
                <label for="password">Password</label>
                <input type="password"
                       id="password"
                       name="password"
                       placeholder="Enter Password"
                       required>
                <input type="checkbox" name="remember_me"> Remember Me
                <input type="hidden" name="expected_role" value="student">
                <div class="button-group">
                    <input type="submit" value="Login">
                    <input type="reset" value="Clear">

                </div>
            </form>
           <a href="signup.php" class="register-link">
    New User? Register Here
</a>
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
    <script src="notification.js"></script>
    <script src="menu.js"></script>
</body>
</html>