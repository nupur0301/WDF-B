<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.php");
    exit();
}

function clean($data) {
    return htmlspecialchars(trim($data));
}

$name = clean($_POST["name"] ?? "");
$email = clean($_POST["email"] ?? "");
$mobile = clean($_POST["mobile"] ?? "");
$password = $_POST["password"] ?? "";
$confirmPassword = $_POST["confirmPassword"] ?? "";
$course = clean($_POST["course"] ?? "");
$year = clean($_POST["year"] ?? "");
$gender = clean($_POST["gender"] ?? "");
$terms = isset($_POST["terms"]);

$errors = [];

// Validation
if ($name === "") {
    $errors[] = "Full Name is required.";
}

if ($email === "") {
    $errors[] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format.";
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

if ($course === "") {
    $errors[] = "Course is required.";
}

if ($year === "") {
    $errors[] = "Year is required.";
}

if ($gender === "") {
    $errors[] = "Gender is required.";
}

if (!$terms) {
    $errors[] = "You must accept the Terms & Conditions.";
}

if (!empty($errors)) {
    echo "<h2>Registration Failed</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
    echo '<a href="register.php">Go Back</a>';
    exit();
}

// Save to JSON file
$dataFolder = __DIR__ . "/json";
$dataFile = $dataFolder . "/registrations.json";

if (!file_exists($dataFolder)) {
    mkdir($dataFolder, 0777, true);
}
$registrations = [];

if (file_exists($dataFile)) {
    $existingData = file_get_contents($dataFile);
    $registrations = json_decode($existingData, true);

    if (!is_array($registrations)) {
        $registrations = [];
    }
}

$newRecord = [
    "name" => $name,
    "email" => $email,
    "mobile" => $mobile,
    "password" => $password,
    "course" => $course,
    "year" => $year,
    "gender" => $gender
];

$registrations[] = $newRecord;
file_put_contents($dataFile, json_encode($registrations, JSON_PRETTY_PRINT));

echo "<h2>Registration Successful</h2>";
echo "<p>Your record has been saved successfully.</p>";
echo '<a href="register.php">Register Another User</a>';
?>