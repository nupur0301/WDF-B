<?php
require 'db.php';
$sql = "SELECT event_id, event_name, event_date, venue, category, status, poster FROM events ORDER BY event_id DESC";
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