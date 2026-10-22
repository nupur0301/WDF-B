<?php require 'db_mysqli.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 500px; margin: auto; }
        label { display:block; margin-top: 12px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 16px; }
    </style>
</head>
<body>

<h2>Add New Student</h2>

<form method="post" action="add_student_process.php">
    <label>Name</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Mobile</label>
    <input type="text" name="mobile" required>

    <label>Course</label>
    <input type="text" name="course" required>

    <label>Year</label>
    <input type="text" name="year" required>

    <label>Status</label>
    <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>

    <button type="submit">Save Student</button>
</form>

</body>
</html>