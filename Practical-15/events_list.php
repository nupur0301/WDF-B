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

$sql = "SELECT event_id, event_name, event_date, venue, category, status
        FROM events
        ORDER BY event_id DESC";

$result = mysqli_query($conn, $sql);

$events = [];

while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}

echo json_encode([
    "status" => "success",
    "data" => $events
]);
?>