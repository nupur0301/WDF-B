<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$name = trim($data["name"] ?? "");
$email = trim($data["email"] ?? "");
$mobile = trim($data["mobile"] ?? "");
$course = trim($data["course"] ?? "");
$year = trim($data["year"] ?? "");
$status = trim($data["status"] ?? "active");

if ($name === "" || $email === "" || $mobile === "" || $course === "" || $year === "") {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit();
}

$sql = "INSERT INTO students (name, email, mobile, course, year, status) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $mobile, $course, $year, $status);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => "success",
        "message" => "Student added successfully"
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to add student"
    ]);
}
?>