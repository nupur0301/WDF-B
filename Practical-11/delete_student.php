<?php
require 'db_mysqli.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    die("Student ID is required.");
}

$sql = "UPDATE students SET status = 'inactive' WHERE student_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: students.php?msg=deleted");
    exit();
} else {
    echo "Error deleting student: " . mysqli_error($conn);
}
?>