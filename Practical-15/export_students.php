<?php
require 'db_mysqli.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=students.csv');

$output = fopen('php://output', 'w');

// CSV header
fputcsv($output, ['ID', 'Name', 'Email', 'Mobile', 'Course', 'Year', 'Status', 'Created At', 'Updated At']);

// Fetch data
$sql = "SELECT * FROM students ORDER BY student_id DESC";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $row['student_id'],
        $row['name'],
        $row['email'],
        $row['mobile'],
        $row['course'],
        $row['year'],
        $row['status'],
        $row['created_at'],
        $row['updated_at']
    ]);
}

fclose($output);
exit();
?>