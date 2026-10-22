<?php
require 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$event_id = trim($data["event_id"] ?? "");

if ($event_id === "") {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Event ID is required"
    ]);
    exit();
}

$sql = "DELETE FROM events WHERE event_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $event_id);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => "success",
        "message" => "Event deleted successfully"
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to delete event"
    ]);
}
?>