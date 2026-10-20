<?php
require 'db_mysqli.php';

$sql = "SELECT * FROM events ORDER BY event_id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f7fb;
        }
        h2 {
            color: #003366;
        }
        .top-links {
            margin: 15px 0;
        }
        .top-links a {
            display: inline-block;
            padding: 10px 14px;
            background: #003366;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-right: 8px;
        }
        .top-links a:hover {
            background: #0059B3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background: #003366;
            color: white;
        }
        .open {
            color: green;
            font-weight: bold;
        }
        .closed {
            color: red;
            font-weight: bold;
        }
        .poster-img {
            width: 80px;
            height: auto;
            border-radius: 4px;
        }
        .action-links a {
            text-decoration: none;
            margin: 0 4px;
            font-weight: bold;
        }
        .edit {
            color: #0059B3;
        }
        .delete {
            color: #c0392b;
        }
    </style>
</head>
<body>

<h2>Event Management</h2>

<div class="top-links">
    <a href="add_event.php">Add Event</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Event Name</th>
        <th>Date</th>
        <th>Venue</th>
        <th>Category</th>
        <th>Status</th>
        <th>Poster</th>
        <th>Actions</th>
    </tr>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['event_id']; ?></td>
                <td><?php echo $row['event_name']; ?></td>
                <td><?php echo $row['event_date']; ?></td>
                <td><?php echo $row['venue']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td class="<?php echo $row['status']; ?>">
                    <?php echo $row['status']; ?>
                </td>
                <td>
                    <?php if (!empty($row['poster'])): ?>
                        <img src="uploads/<?php echo $row['poster']; ?>" alt="Poster" class="poster-img">
                    <?php else: ?>
                        No Poster
                    <?php endif; ?>
                </td>
                <td class="action-links">
                    <a class="edit" href="edit_event.php?id=<?php echo $row['event_id']; ?>">Edit</a>
                    |
                    <a class="delete" href="delete_event.php?id=<?php echo $row['event_id']; ?>" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No events found.</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>