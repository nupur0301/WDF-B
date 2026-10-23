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
    <h2>Register for an Event</h2>
    <p>
        Select any available event from the list below and click the Register button.
    </p>
</section>

<section class="profile-card">

<form action="register_event_process.php" method="POST">

    <table>

        <tr>
            <th>Select Event</th>
            <td>

                <select name="event_id" required>

                    <option value="">-- Select Event --</option>

                    <?php
                    while($row=mysqli_fetch_assoc($events))
                    {
                    ?>

                    <option value="<?php echo $row['event_id']; ?>">
                        <?php
                        echo $row['event_name']." - ".
                        date("d M Y",strtotime($row['event_date']));
                        ?>
                    </option>

                    <?php
                    }
                    ?>

                </select>

            </td>
        </tr>

    </table>

    <br>

    <input type="submit" value="Register Event">

</form>

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