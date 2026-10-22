<?php
function logAction($conn, $userId, $action, $details = '') {
    $sql = "INSERT INTO audit_logs (user_id, action, details) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iss", $userId, $action, $details);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>