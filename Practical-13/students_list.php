<?php
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