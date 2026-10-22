<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$student_id = trim($data["student_id"] ?? "");
$name = trim($data["name"] ?? "");
$email = trim($data["email"] ?? "");
$mobile = trim($data["mobile"] ?? "");
$course = trim($data["course"] ?? "");
$year = trim($data["year"] ?? "");
$status = trim($data["status"] ?? "active");

if ($student_id === "" || $name === "" || $email === "" || $mobile === "" || $course === "" || $year === "") {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit();
}

$sql = "UPDATE students 
        SET name = ?, email = ?, mobile = ?, course = ?, year = ?, status = ?
        WHERE student_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssi", $name, $email, $mobile, $course, $year, $status, $student_id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => "success",
        "message" => "Student updated successfully"
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to update student"
    ]);
}
?>