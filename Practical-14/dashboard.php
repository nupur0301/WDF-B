<?php
session_start();
$role = $_SESSION['role'] ?? 'student';
$name = $_SESSION['name'] ?? 'Nupur';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentHub | Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="container">
        <img src="banner.png" alt="StudentHub Logo" width="120">
        <h1>StudentHub Portal</h1>
        <h3><?php echo ($role === 'admin') ? 'Admin Dashboard' : 'Student Dashboard'; ?></h3>
    </div>
</header>

<nav>
    <div class="container">
        <div class="menu-icon" onclick="toggleMenu()">
            ☰
        </div>

        <div class="nav-links" id="navLinks">
            <?php if ($role === 'admin'): ?>
                <a href="admin_dashboard.php">Admin Dashboard</a>
                <a href="students.php">Student Management</a>
                <a href="events.php">Event Management</a>
                <a href="students_api.html">Student API CRUD</a>
                <a href="events_api.html">Event API CRUD</a>
            <?php else: ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="attendance.html">Attendance</a>
                <a href="timetable.html">Timetable</a>
                <a href="performance.html">Performance</a>
                <a href="events.html">Events</a>
                <a href="faq.html">FAQ</a>
                <a href="students_api.html">Student API CRUD</a>
            <?php endif; ?>
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
    <section class="dashboard-header">
        <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
        <p>
            Welcome to your StudentHub Dashboard. Here you can manage your attendance,
            timetable, academic performance and college activities.
        </p>
    </section>

    <section class="profile-card">
        <h2>Student Profile</h2>
        <table>
            <tr>
                <th>Enrollment No.</th>
                <td>25DIT038</td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo htmlspecialchars($name); ?></td>
            </tr>
            <tr>
                <th>Course</th>
                <td>B.Tech Information Technology</td>
            </tr>
            <tr>
                <th>Semester</th>
                <td>3</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>abc@charusat.edu.in</td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>+91 9876543210</td>
            </tr>
        </table>
    </section>

    <section class="quick-access">
        <h2>Quick Access</h2>
        <div class="dashboard-grid">
            <?php if ($role === 'admin'): ?>
                <a href="admin_dashboard.php" class="dashboard-card">Admin Dashboard</a>
                <a href="students.php" class="dashboard-card">Student Management</a>
                <a href="events.php" class="dashboard-card">Event Management</a>
                <a href="students_api.html" class="dashboard-card">Student API CRUD</a>
                <a href="events_api.html" class="dashboard-card">Event API CRUD</a>
            <?php else: ?>
                <a href="attendance.html" class="dashboard-card">Attendance</a>
                <a href="timetable.html" class="dashboard-card">Timetable</a>
                <a href="performance.html" class="dashboard-card">Performance</a>
                <a href="events.html" class="dashboard-card">Events</a>
                <a href="contact.html" class="dashboard-card">Contact</a>
                <a href="logout.php">Logout</a>
                <?php endif; ?>
        </div>
    </section>
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