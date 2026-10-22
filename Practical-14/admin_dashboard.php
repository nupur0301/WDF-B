<?php
session_start();
require 'db_mysqli.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$studentCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM students"))['total'];
$eventCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM events"))['total'];
$userCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM users"))['total'];
$registrationCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrations"))['total'];

$latestRegs = mysqli_query($conn, "
    SELECT r.registration_id, s.name AS student_name, e.event_name, r.registered_at
    FROM registrations r
    JOIN students s ON r.student_id = s.student_id
    JOIN events e ON r.event_id = e.event_id
    ORDER BY r.registered_at DESC
    LIMIT 5
");

$latestLogs = mysqli_query($conn, "
    SELECT log_id, user_id, action, details, created_at
    FROM audit_logs
    ORDER BY created_at DESC
    LIMIT 10
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f7fb;
            color: #222;
        }

        .page {
            max-width: 1400px;
            margin: 0 auto;
            padding: 24px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        h1, h2, h3 {
            margin: 0;
            color: #003366;
        }

        .welcome {
            margin-top: 6px;
            font-size: 16px;
        }

        .logout-link {
            display: inline-block;
            padding: 10px 16px;
            background: #003366;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
        }

        .logout-link:hover {
            background: #00509e;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 16px;
            margin: 24px 0;
        }

        .card {
            background: #fff;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            text-align: center;
        }

        .card h3 {
            margin-bottom: 10px;
            font-size: 20px;
        }

        .card p {
            margin: 0;
            font-size: 34px;
            font-weight: bold;
        }

        .section {
            background: #fff;
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 22px;
        }

        .section-title {
            margin-bottom: 14px;
            font-size: 22px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th, td {
            border: 1px solid #d6dbe3;
            padding: 10px 12px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background: #003366;
            color: #fff;
            white-space: nowrap;
        }

        .muted {
            color: #666;
        }

        @media (max-width: 768px) {
            .page {
                padding: 14px;
            }

            .card p {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

<div class="page">
    <div class="topbar">
        <div>
            <h1>Admin Dashboard</h1>
            <div class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['name'] ?? 'Admin'); ?></div>
        </div>
        <a class="logout-link" href="logout.php">Logout</a>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Users</h3>
            <p><?php echo $userCount; ?></p>
        </div>
        <div class="card">
            <h3>Students</h3>
            <p><?php echo $studentCount; ?></p>
        </div>
        <div class="card">
            <h3>Events</h3>
            <p><?php echo $eventCount; ?></p>
        </div>
        <div class="card">
            <h3>Registrations</h3>
            <p><?php echo $registrationCount; ?></p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Recent Audit Logs</h2>
        <div class="table-wrap">
            <table>
                <tr>
                    <th>Log ID</th>
                    <th>User ID</th>
                    <th>Action</th>
                    <th>Details</th>
                    <th>Created At</th>
                </tr>
                <?php if (mysqli_num_rows($latestLogs) > 0): ?>
                    <?php while ($log = mysqli_fetch_assoc($latestLogs)) { ?>
                        <tr>
                            <td><?php echo $log['log_id']; ?></td>
                            <td><?php echo $log['user_id']; ?></td>
                            <td><?php echo $log['action']; ?></td>
                            <td><?php echo $log['details']; ?></td>
                            <td><?php echo $log['created_at']; ?></td>
                        </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="muted">No audit logs found.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Latest Registrations</h2>
        <div class="table-wrap">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Student</th>
                    <th>Event</th>
                    <th>Registered At</th>
                </tr>
                <?php if (mysqli_num_rows($latestRegs) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($latestRegs)) { ?>
                        <tr>
                            <td><?php echo $row['registration_id']; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['event_name']; ?></td>
                            <td><?php echo $row['registered_at']; ?></td>
                        </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="muted">No registrations found.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>

</body>
</html>