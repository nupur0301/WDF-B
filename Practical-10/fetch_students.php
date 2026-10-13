<?php
require 'db.php';

$sql = "SELECT * FROM students";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Student Records</h2>";
echo "<table border='1' cellpadding='8'>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Mobile</th><th>Course</th><th>Year</th></tr>";

foreach ($students as $student) {
    echo "<tr>";
    echo "<td>" . $student['student_id'] . "</td>";
    echo "<td>" . $student['name'] . "</td>";
    echo "<td>" . $student['email'] . "</td>";
    echo "<td>" . $student['mobile'] . "</td>";
    echo "<td>" . $student['course'] . "</td>";
    echo "<td>" . $student['year'] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>