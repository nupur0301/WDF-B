<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
require 'db_mysqli.php';
require 'audit_helper.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    die("Event ID is required.");
}

$sql = "SELECT poster, event_name FROM events WHERE event_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$event = mysqli_fetch_assoc($result);

if (!$event) {
    die("Event not found.");
}

$poster = $event['poster'];
$eventName = $event['event_name'];

if (!empty($poster) && file_exists("uploads/" . $poster)) {
    unlink("uploads/" . $poster);
}

$deleteSql = "DELETE FROM events WHERE event_id = ?";
$deleteStmt = mysqli_prepare($conn, $deleteSql);
mysqli_stmt_bind_param($deleteStmt, "i", $id);

if (mysqli_stmt_execute($deleteStmt)) {
    $userId = $_SESSION['user_id'] ?? 0;
    logAction($conn, $userId, 'Delete Event', "Deleted event ID $id: $eventName");
    echo "<h2>Event Deleted Successfully</h2>";
    echo '<a href="events.php">Go Back</a>';
} else {
    echo "Error deleting event: " . mysqli_error($conn);
}
?>