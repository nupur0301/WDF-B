<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$student_id = trim($data["student_id"] ?? "");

if ($student_id === "") {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Student ID is required"
    ]);
    exit();
}

$sql = "DELETE FROM students WHERE student_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $student_id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => "success",
        "message" => "Student deleted successfully"
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to delete student"
    ]);
}
?>