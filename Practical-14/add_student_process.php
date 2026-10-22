<?php
require 'db_mysqli.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: add_student.php");
    exit();
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$mobile = trim($_POST["mobile"] ?? "");
$course = trim($_POST["course"] ?? "");
$year = trim($_POST["year"] ?? "");
$status = trim($_POST["status"] ?? "active");

if ($name === "" || $email === "" || $mobile === "" || $course === "" || $year === "") {
    die("All fields are required.");
}

$sql = "INSERT INTO students (name, email, mobile, course, year, status) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $mobile, $course, $year, $status);

if (mysqli_stmt_execute($stmt)) {
    echo "Student added successfully. <a href='students.php'>Go Back</a>";
} else {
    echo "Error adding student: " . mysqli_error($conn);
}
?>