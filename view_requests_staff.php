<?php
include 'db_connect.php';

$sql = "SELECT * FROM repair_requests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #444;
            font-size: 26px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        select, button {
            padding: 6px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-right: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #218838;
        }
        .dashboard-button {
            background-color: #333;
            color: white;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
        }
        .dashboard-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Repair Requests</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>UID</th>
            <th>Description</th>
            <th>Category</th>
            <th>Type</th>
            <th>Status</th>
            <th>Expected Date</th>
            <th>Confirmed Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['uid']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo htmlspecialchars($row['category']); ?></td>
            <td><?php echo htmlspecialchars($row['type']); ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td><?php echo htmlspecialchars($row['expected_date']); ?></td>
            <td><?php echo htmlspecialchars($row['confirmed_date']); ?></td>
            <td>
                <form action="update_request.php" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <select name="status">
                        <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="approved" <?php echo $row['status'] == 'approved' ? 'selected' : ''; ?>>Approve</option>
                        <option value="declined" <?php echo $row['status'] == 'declined' ? 'selected' : ''; ?>>Decline</option>
                        <option value="completed" <?php echo $row['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- Go back to dashboard button -->
    <a href="staff_dashboard.php" class="dashboard-button">Go to Dashboard</a>
</div>

</body>
</html>

<?php $conn->close(); ?>
