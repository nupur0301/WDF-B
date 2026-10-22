<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit("Unauthorized");
}

if ($_SESSION['role'] !== 'admin') {
    http_response_code(403);
    exit("Forbidden");
}
require 'db.php';

$sql = "SELECT student_id, name, email, mobile, course, year, status FROM students ORDER BY student_id DESC";
$result = mysqli_query($conn, $sql);

$students = [];

while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $students
]);
?>