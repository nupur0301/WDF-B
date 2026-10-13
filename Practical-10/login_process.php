<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit();
}

function clean($data) {
    return htmlspecialchars(trim($data));
}

$login_id = clean($_POST["login_id"] ?? "");
$password = $_POST["password"] ?? "";

if ($login_id === "" || $password === "") {
    die("Login ID and password are required.");
}

$sql = "SELECT id, name, email, username, password, role
        FROM users
        WHERE email = :login_id OR username = :login_id
        LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->execute([':login_id' => $login_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found.");
}

if (!password_verify($password, $user['password'])) {
    die("Wrong password.");
}

session_regenerate_id(true);

$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['name'];
$_SESSION['email'] = $user['email'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

$updateSql = "UPDATE users SET last_login = NOW() WHERE id = :id";
$updateStmt = $pdo->prepare($updateSql);
$updateStmt->execute([':id' => $user['id']]);

header("Location: dashboard.html");
exit();
?>