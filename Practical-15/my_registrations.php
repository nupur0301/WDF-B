<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: student_login.php");
    exit();
}

include 'db_mysqli.php';

$events = mysqli_query($conn, "SELECT * FROM events WHERE status='open' ORDER BY event_date");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudentHub | Event Registration</title>

    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <div class="container">
        <img src="banner.png" alt="StudentHub Logo" width="120">
        <h1>StudentHub Portal</h1>
        <h3>Event Registration</h3>
    </div>
</header>

<nav>
    <div class="container">

        <div class="menu-icon" onclick="toggleMenu()">
            ☰
        </div>

        <div class="nav-links" id="navLinks">

            <a href="dashboard.php">Dashboard</a>
            <a href="attendance.html">Attendance</a>
            <a href="timetable.html">Timetable</a>
            <a href="performance.html">Performance</a>
            <a href="events.html">Events</a>
            <a href="event_registration.php">Register Event</a>
            <a href="contact.html">Contact</a>
            <a href="faq.html">FAQ</a>
            <a href="logout.php">Logout</a>

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
    <h2>My Registered Events</h2>
    <p>Below are all the events you have registered for.</p>
</section>

<section class="profile-card">

<?php

include 'db_mysqli.php';

$email = $_SESSION['email'];

$sql = "SELECT
            e.event_name,
            e.event_date,
            e.venue,
            r.registered_at
        FROM registrations r
        JOIN students s ON r.student_id = s.student_id
        JOIN events e ON r.event_id = e.event_id
        WHERE s.email = ?
        ORDER BY r.registered_at DESC";

$stmt = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"s",$email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<table border="1" width="100%" cellpadding="10">

<tr>
    <th>Event Name</th>
    <th>Date</th>
    <th>Venue</th>
    <th>Registered On</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<tr>
    <td><?php echo htmlspecialchars($row['event_name']); ?></td>

    <td><?php echo date("d M Y",strtotime($row['event_date'])); ?></td>

    <td><?php echo htmlspecialchars($row['venue']); ?></td>

    <td><?php echo date("d M Y H:i",strtotime($row['registered_at'])); ?></td>
</tr>

<?php
}
?>

</table>

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