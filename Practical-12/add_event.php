<?php require 'db_mysqli.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 500px; margin: auto; }
        label { display:block; margin-top: 12px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px 16px; }
    </style>
</head>
<body>

<h2>Add New Event</h2>

<form method="post" action="add_event_process.php" enctype="multipart/form-data">
    <label>Event Name</label>
    <input type="text" name="event_name" required>

    <label>Event Date</label>
    <input type="date" name="event_date" required>

    <label>Venue</label>
    <input type="text" name="venue" required>

    <label>Category</label>
    <input type="text" name="category" required>

    <label>Status</label>
    <select name="status">
        <option value="open">Open</option>
        <option value="closed">Closed</option>
    </select>

    <label>Poster</label>
    <input type="file" name="poster" accept=".jpg,.jpeg,.png,.webp" required>

    <button type="submit">Save Event</button>
</form>

</body>
</html>