<?php
require 'db_mysqli.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    die("Student ID is required.");
}

$sql = "SELECT * FROM students WHERE student_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$student = mysqli_fetch_assoc($result);

if (!$student) {
    die("Student not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 500px; margin: auto; }
        label { display:block; margin-top: 12px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 16px; }
    </style>
</head>
<body>

<h2>Edit Student</h2>

<form method="post" action="edit_student_process.php">
    <input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">

    <label>Name</label>
    <input type="text" name="name" value="<?php echo $student['name']; ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo $student['email']; ?>" required>

    <label>Mobile</label>
    <input type="text" name="mobile" value="<?php echo $student['mobile']; ?>" required>

    <label>Course</label>
    <input type="text" name="course" value="<?php echo $student['course']; ?>" required>

    <label>Year</label>
    <input type="text" name="year" value="<?php echo $student['year']; ?>" required>

    <label>Status</label>
    <select name="status">
        <option value="active" <?php if ($student['status'] === 'active') echo 'selected'; ?>>Active</option>
        <option value="inactive" <?php if ($student['status'] === 'inactive') echo 'selected'; ?>>Inactive</option>
    </select>

    <button type="submit">Update Student</button>
</form>

</body>
</html>