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
$data = json_decode(file_get_contents("php://input"), true);
$event_id = trim($data["event_id"] ?? "");
$event_name = trim($data["event_name"] ?? "");
$event_date = trim($data["event_date"] ?? "");
$venue = trim($data["venue"] ?? "");
$category = trim($data["category"] ?? "");
$status = trim($data["status"] ?? "open");
$poster = trim($data["poster"] ?? "");
if ($event_id === "" || $event_name === "" || $event_date === "" || $venue === "" || $category === "") {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit();
}
$sql = "UPDATE events
        SET event_name = ?, event_date = ?, venue = ?, category = ?, status = ?, poster = ?
        WHERE event_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssi", $event_name, $event_date, $venue, $category, $status, $poster, $event_id);
if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => "success",
        "message" => "Event updated successfully"
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to update event"
    ]);
}
?>