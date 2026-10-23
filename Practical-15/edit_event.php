<?php
require 'db_mysqli.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    die("Event ID is required.");
}

$sql = "SELECT * FROM events WHERE event_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$event = mysqli_fetch_assoc($result);

if (!$event) {
    die("Event not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 500px; margin: auto; }
        label { display:block; margin-top: 12px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 16px; }
        img { max-width: 120px; margin-top: 10px; }
    </style>
</head>
<body>

<h2>Edit Event</h2>

<form method="post" action="edit_event_process.php" enctype="multipart/form-data">
    <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
    <input type="hidden" name="old_poster" value="<?php echo $event['poster']; ?>">

    <label>Event Name</label>
    <input type="text" name="event_name" value="<?php echo $event['event_name']; ?>" required>

    <label>Event Date</label>
    <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required>

    <label>Venue</label>
    <input type="text" name="venue" value="<?php echo $event['venue']; ?>" required>

    <label>Category</label>
    <input type="text" name="category" value="<?php echo $event['category']; ?>" required>

    <label>Status</label>
    <select name="status">
        <option value="open" <?php if ($event['status'] === 'open') echo 'selected'; ?>>Open</option>
        <option value="closed" <?php if ($event['status'] === 'closed') echo 'selected'; ?>>Closed</option>
    </select>

    <label>Current Poster</label><br>
    <?php if (!empty($event['poster'])): ?>
        <img src="uploads/<?php echo $event['poster']; ?>" alt="Poster">
    <?php else: ?>
        <p>No poster uploaded.</p>
    <?php endif; ?>

    <label>Change Poster (optional)</label>
    <input type="file" name="poster" accept=".jpg,.jpeg,.png,.webp">

    <button type="submit">Update Event</button>
</form>

</body>
</html>