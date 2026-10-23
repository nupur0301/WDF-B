<?php
session_start();

$userId = $_SESSION['user_id'] ?? 0;
$role = $_SESSION['role'] ?? 'guest';
$name = $_SESSION['name'] ?? 'User';

require 'db_mysqli.php';
require 'audit_helper.php';

if ($userId) {
    logAction($conn, $userId, 'Logout', "$name logged out as $role");
}

session_unset();
session_destroy();

header("Location: index.html");
exit();
?>