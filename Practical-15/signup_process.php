<?php
require 'db.php';
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: signup.php");
    exit();
}
function clean($data) {
    return htmlspecialchars(trim($data));
}
$name = clean($_POST["name"] ?? "");
$email = clean($_POST["email"] ?? "");
$username = clean($_POST["username"] ?? "");
$mobile = clean($_POST["mobile"] ?? "");
$password = $_POST["password"] ?? "";
$confirmPassword = $_POST["confirmPassword"] ?? "";
$errors = [];
if ($name === "") {
    $errors[] = "Name is required.";
}
if ($email === "") {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
}
if ($username === "") {
    $errors[] = "Username is required.";
}
if ($mobile === "") {
    $errors[] = "Mobile number is required.";
} elseif (!preg_match("/^[0-9]{10}$/", $mobile)) {
    $errors[] = "Mobile number must be 10 digits.";
}
if ($password === "") {
    $errors[] = "Password is required.";
} elseif (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters.";
}
if ($confirmPassword === "") {
    $errors[] = "Confirm password is required.";
} elseif ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match.";
}
if (empty($errors)) {
    $checkSql = "SELECT id FROM users WHERE email = :email OR username = :username";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->execute([
        ':email' => $email,
        ':username' => $username
    ]);
    if ($checkStmt->fetch()) {
        $errors[] = "Email or Username already exists.";
    }
}
if (!empty($errors)) {
    echo "<h2>Registration Failed</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo '<a href="signup.php">Go Back</a>';
    exit();
}
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (name, email, username, mobile, password)
        VALUES (:name, :email, :username, :mobile, :password)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':username' => $username,
    ':mobile' => $mobile,
    ':password' => $hashedPassword
]);
echo "<h2>Registration Successful</h2>";
echo "<p>User account created successfully.</p>";
echo '<a href="login.html" style="display:inline-block; margin-top:15px; padding:10px 18px; background:#003366; color:white; text-decoration:none; border-radius:6px;">Go to Login</a>';
?>