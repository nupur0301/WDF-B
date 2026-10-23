<?php
require 'db.php';

$name = "Test Student";
$email = "teststudent@example.com";
$mobile = "9876543210";
$course = "B.Tech IT";
$year = "Third Year";

$sql = "INSERT INTO students (name, email, mobile, course, year)
        VALUES (:name, :email, :mobile, :course, :year)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':mobile' => $mobile,
    ':course' => $course,
    ':year' => $year
]);

echo "Student inserted successfully!";
?>