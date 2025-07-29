<?php
include 'db_connect.php';

// Fetch all repair requests from the database
$sql = "SELECT * FROM repair_requests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Repair Requests - Admin</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        /* Table Styles */
        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        td {
            background-color: #f3f3f3;
        }
        /* Row hover effect */
        tr:hover {
            background-color: #f1f1f1;
        }

        #gotodash{
            
            width: 100%;
            padding: 12px;
            background-color: #00b09b;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        #gotodash:hover {
            background-color: #333;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            th, td {
                text-align: left;
                padding: 10px;
            }
            tr {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Repair Requests</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>UID</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Expected Date</th>
                    <th>Confirmed Date</th>
                </tr>
            </thead>
            <tbody>
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
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Button to go back to the Student Dashboard -->
        <button onclick="location.href='admin_dashboard.php'" class="dashboard-button" id="gotodash">Go to Dashboard</button>



    </div>
</body>
</html>

<?php $conn->close(); ?>
