<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: student_login.php");
    exit();
}

include 'db_mysqli.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: event_registration.php");
    exit();
}

$email = $_SESSION['email'];
$event_id = $_POST['event_id'];

/* Find Student ID */

$sql = "SELECT student_id FROM students WHERE email=? LIMIT 1";
$stmt = mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"s",$email);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)==0)
{
    die("Student record not found.");
}

$student = mysqli_fetch_assoc($result);
$student_id = $student['student_id'];

/* Check Duplicate Registration */

$sql="SELECT registration_id
      FROM registrations
      WHERE student_id=? AND event_id=?";

$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"ii",$student_id,$event_id);
mysqli_stmt_execute($stmt);

$result=mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result)>0)
{
    echo "<script>
    alert('You have already registered for this event.');
    window.location='event_registration.php';
    </script>";
    exit();
}

/* Register Event */

$sql="INSERT INTO registrations(student_id,event_id)
VALUES(?,?)";

$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"ii",$student_id,$event_id);

if(mysqli_stmt_execute($stmt))
{
    echo "<script>
    alert('Registration Successful!');
    window.location='event_registration.php';
    </script>";
}
else
{
    echo "<script>
    alert('Registration Failed!');
    window.location='event_registration.php';
    </script>";
}
?>