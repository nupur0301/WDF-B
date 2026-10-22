<?php
require 'db_mysqli.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: add_event.php");
    exit();
}

function clean($data) {
    return htmlspecialchars(trim($data));
}

$event_name = clean($_POST["event_name"] ?? "");
$event_date = clean($_POST["event_date"] ?? "");
$venue = clean($_POST["venue"] ?? "");
$category = clean($_POST["category"] ?? "");
$status = clean($_POST["status"] ?? "open");

$errors = [];

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

if (!isset($_FILES["poster"]) || $_FILES["poster"]["error"] !== UPLOAD_ERR_OK) {
    $errors[] = "Poster upload is required.";
}

$allowedTypes = ["jpg", "jpeg", "png", "webp"];
$posterName = "";

if (empty($errors)) {
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
        }
    }
}

if (!empty($errors)) {
    echo "<h2>Event Add Failed</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
    echo '<a href="add_event.php">Go Back</a>';
    exit();
}

$sql = "INSERT INTO events (event_name, event_date, venue, category, status, poster)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $event_name, $event_date, $venue, $category, $status, $posterName);

if (mysqli_stmt_execute($stmt)) {
    echo "<h2>Event Added Successfully</h2>";
    echo "<p>Poster uploaded and event saved.</p>";
    echo '<a href="events.php">Go Back</a>';
} else {
    echo "Error adding event: " . mysqli_error($conn);
}
?>