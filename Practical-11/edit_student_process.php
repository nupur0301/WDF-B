<?php
require 'db_mysqli.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: students.php");
    exit();
}

$student_id = $_POST["student_id"] ?? '';
$name = trim($_POST["name"] ?? '');
$email = trim($_POST["email"] ?? '');
$mobile = trim($_POST["mobile"] ?? '');
$course = trim($_POST["course"] ?? '');
$year = trim($_POST["year"] ?? '');
$status = trim($_POST["status"] ?? 'active');

if ($student_id === '' || $name === '' || $email === '' || $mobile === '' || $course === '' || $year === '') {
    die("All fields are required.");
}

$sql = "UPDATE students
        SET name = ?, email = ?, mobile = ?, course = ?, year = ?, status = ?
        WHERE student_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssi", $name, $email, $mobile, $course, $year, $status, $student_id);

if (mysqli_stmt_execute($stmt)) {
    echo "Student updated successfully. <a href='students.php'>Go Back</a>";
} else {
    echo "Error updating student: " . mysqli_error($conn);
}
?>