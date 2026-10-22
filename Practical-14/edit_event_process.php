<?php
session_start();
require 'db_mysqli.php';
require 'audit_helper.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: events.php");
    exit();
}

function clean($data) {
    return htmlspecialchars(trim($data));
}

$event_id = $_POST["event_id"] ?? '';
$old_poster = $_POST["old_poster"] ?? '';

$event_name = clean($_POST["event_name"] ?? "");
$event_date = clean($_POST["event_date"] ?? "");
$venue = clean($_POST["venue"] ?? "");
$category = clean($_POST["category"] ?? "");
$status = clean($_POST["status"] ?? "open");

$errors = [];

if ($event_id === '') {
    $errors[] = "Event ID is required.";
}
if ($event_name === "") {
    $errors[] = "Event name is required.";
}
if ($event_date === "") {
    $errors[] = "Event date is required.";
}
if ($venue === "") {
    $errors[] = "Venue is required.";
}
if ($category === "") {
    $errors[] = "Category is required.";
}

$posterName = $old_poster;

if (isset($_FILES["poster"]) && $_FILES["poster"]["error"] === UPLOAD_ERR_OK) {
    $allowedTypes = ["jpg", "jpeg", "png", "webp"];
    $posterTmp = $_FILES["poster"]["tmp_name"];
    $posterOriginal = $_FILES["poster"]["name"];
    $posterSize = $_FILES["poster"]["size"];
    $posterExt = strtolower(pathinfo($posterOriginal, PATHINFO_EXTENSION));

    if (!in_array($posterExt, $allowedTypes)) {
        $errors[] = "Only JPG, JPEG, PNG and WEBP files are allowed.";
    }

    if ($posterSize > 2 * 1024 * 1024) {
        $errors[] = "Poster size must be less than 2 MB.";
    }

    if (empty($errors)) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $posterName = time() . "_" . basename($posterOriginal);
        $targetFile = $uploadDir . $posterName;

        if (!move_uploaded_file($posterTmp, $targetFile)) {
            $errors[] = "Failed to upload poster.";
        } else {
            if (!empty($old_poster) && file_exists($uploadDir . $old_poster)) {
                unlink($uploadDir . $old_poster);
            }
        }
    }
}

if (!empty($errors)) {
    echo "<h2>Event Update Failed</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
    echo '<a href="events.php">Go Back</a>';
    exit();
}

$sql = "UPDATE events 
        SET event_name = ?, event_date = ?, venue = ?, category = ?, status = ?, poster = ?
        WHERE event_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssssi", $event_name, $event_date, $venue, $category, $status, $posterName, $event_id);

if (mysqli_stmt_execute($stmt)) {
    $userId = $_SESSION['user_id'] ?? 0;
    logAction($conn, $userId, 'Update Event', "Updated event ID $event_id: $event_name");
    echo "<h2>Event Updated Successfully</h2>";
    echo '<a href="events.php">Go Back</a>';
} else {
    echo "Error updating event: " . mysqli_error($conn);
}
?>