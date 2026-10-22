<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
require 'db_mysqli.php';
$search = $_GET['search'] ?? '';
$course = $_GET['course'] ?? '';
$status = $_GET['status'] ?? '';
$msg = $_GET['msg'] ?? '';
$sql = "SELECT * FROM students WHERE 1=1";
if ($search !== '') {
    $safeSearch = mysqli_real_escape_string($conn, $search);
    $sql .= " AND (
        name LIKE '%$safeSearch%' OR
        email LIKE '%$safeSearch%' OR
        mobile LIKE '%$safeSearch%' OR
        course LIKE '%$safeSearch%'
    )";
}
if ($course !== '') {
    $safeCourse = mysqli_real_escape_string($conn, $course);
    $sql .= " AND course = '$safeCourse'";
}
if ($status !== '') {
    $safeStatus = mysqli_real_escape_string($conn, $status);
    $sql .= " AND status = '$safeStatus'";
}
$sql .= " ORDER BY student_id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student CRUD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f7fb;
        }
        h2 {
            color: #003366;
        }
        .top-links {
            margin: 15px 0;
        }
        .top-links a {
            display: inline-block;
            padding: 10px 14px;
            background: #003366;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-right: 8px;
        }
        .top-links a:hover {
            background: #0059B3;
        }
        .msg {
            padding: 10px 14px;
            border-radius: 6px;
            margin: 15px 0;
            font-weight: bold;
        }
        .msg.success {
            background: #d4edda;
            color: #155724;
        }
        .msg.error {
            background: #f8d7da;
            color: #721c24;
        }
        form {
            margin: 20px 0;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
        form input[type="text"],
        form select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            min-width: 220px;
        }
        form button, form a {
            padding: 10px 14px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        form button {
            background: #003366;
            color: white;
        }
        form button:hover {
            background: #0059B3;
        }
        form a {
            background: #777;
            color: white;
        }
        form a:hover {
            background: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #003366;
            color: white;
        }
        .active {
            color: green;
            font-weight: bold;
        }
        .inactive {
            color: red;
            font-weight: bold;
        }
        .action-links a {
            text-decoration: none;
            margin: 0 4px;
            font-weight: bold;
        }
        .edit {
            color: #0059B3;
        }
        .delete {
            color: #c0392b;
        }
    </style>
</head>
<body>
<h2>Student Management</h2>
<div class="top-links">
    <a href="admin_dashboard.php">Dashboard</a>
    <a href="students.php">Students</a>
    <a href="events.php">Events</a>
    <a href="students_api.html">Student API</a>
    <a href="events_api.html">Event API</a>
    <a href="add_student.php">Add Student</a>
    <a href="export_students.php">Export CSV</a>
    <a href="logout.php">Logout</a>
</div>
<?php if ($msg === 'deleted'): ?>
    <div class="msg success">Student marked as inactive successfully.</div>
<?php elseif ($msg === 'added'): ?>
    <div class="msg success">Student added successfully.</div>
<?php elseif ($msg === 'updated'): ?>
    <div class="msg success">Student updated successfully.</div>
<?php endif; ?>

<form method="get" action="">
    <input type="text" name="search" placeholder="Search by name, email, mobile or course"
           value="<?php echo htmlspecialchars($search); ?>">

    <select name="course">
        <option value="">All Courses</option>
        <option value="B.Tech IT" <?php if ($course === 'B.Tech IT') echo 'selected'; ?>>B.Tech IT</option>
        <option value="B.Tech CE" <?php if ($course === 'B.Tech CE') echo 'selected'; ?>>B.Tech CE</option>
        <option value="B.Tech CSE" <?php if ($course === 'B.Tech CSE') echo 'selected'; ?>>B.Tech CSE</option>
        <option value="B.Tech AIML" <?php if ($course === 'B.Tech AIML') echo 'selected'; ?>>B.Tech AIML</option>
    </select>

    <select name="status">
        <option value="">All Status</option>
        <option value="active" <?php if ($status === 'active') echo 'selected'; ?>>Active</option>
        <option value="inactive" <?php if ($status === 'inactive') echo 'selected'; ?>>Inactive</option>
    </select>

    <button type="submit">Search / Filter</button>
    <a href="students.php">Reset</a>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Course</th>
        <th>Year</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['mobile']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['year']; ?></td>
                <td class="<?php echo $row['status']; ?>">
                    <?php echo $row['status']; ?>
                </td>
                <td class="action-links">
                    <a class="edit" href="edit_student.php?id=<?php echo $row['student_id']; ?>">Edit</a>
                    |
                    <a class="delete"
                       href="delete_student.php?id=<?php echo $row['student_id']; ?>"
                       onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No students found.</td>
        </tr>
    <?php endif; ?>
</table>
</body>
</html>