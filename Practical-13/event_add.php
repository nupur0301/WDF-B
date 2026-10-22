<?php
require 'db.php';

$event_name = trim($_POST["event_name"] ?? "");
$event_date = trim($_POST["event_date"] ?? "");
$venue = trim($_POST["venue"] ?? "");
$category = trim($_POST["category"] ?? "");
$status = trim($_POST["status"] ?? "open");

if ($event_name === "" || $event_date === "" || $venue === "" || $category === "") {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit();
}

if (!isset($_FILES["poster"]) || $_FILES["poster"]["error"] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Poster file is required"
    ]);
    exit();
}

$allowedTypes = ["jpg", "jpeg", "png", "webp"];
$posterOriginal = $_FILES["poster"]["name"];
$posterTmp = $_FILES["poster"]["tmp_name"];
$posterSize = $_FILES["poster"]["size"];
$posterExt = strtolower(pathinfo($posterOriginal, PATHINFO_EXTENSION));

if (!in_array($posterExt, $allowedTypes)) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Only JPG, JPEG, PNG and WEBP files are allowed"
    ]);
    exit();
}

if ($posterSize > 2 * 1024 * 1024) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Poster size must be less than 2 MB"
    ]);
    exit();
}

$uploadDir = "../uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$posterName = time() . "_" . basename($posterOriginal);
$targetFile = $uploadDir . $posterName;

if (!move_uploaded_file($posterTmp, $targetFile)) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to upload poster"
    ]);
    exit();
}

$sql = "INSERT INTO events (event_name, event_date, venue, category, status, poster)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssss", $event_name, $event_date, $venue, $category, $status, $posterName);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => "success",
        "message" => "Event added successfully"
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Failed to add event"
    ]);
}
?>