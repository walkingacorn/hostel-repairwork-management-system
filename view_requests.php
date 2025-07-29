<?php
session_start();
include 'db_connect.php'; // Include your database connection

// Check if the session variables 'uid' and 'role' are set
if (!isset($_SESSION['uid']) || !isset($_SESSION['role'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

// Get the user's UID and role from the session
$uid = $_SESSION['uid'];
$role = $_SESSION['role'];

// Initialize the SQL query for displaying requests based on role
if ($role == 'admin') {
    // Admin can see all requests
    $sql = "SELECT r.id, r.uid, r.description, r.status, r.confirmed_date, r.created_at, u.name
            FROM repair_requests r
            INNER JOIN users u ON r.uid = u.uid
            ORDER BY r.created_at DESC";
} elseif ($role == 'student') {
    // Get the student's room number from the session
    $room_no = $_SESSION['room_no'];

    // Student can see their own requests and their roommates' requests
    $sql = "SELECT r.id, r.description, r.status, r.confirmed_date, r.created_at
            FROM repair_requests r
            INNER JOIN occupants o ON r.uid = o.uid
            WHERE o.room_no = '$room_no' AND (r.uid = '$uid' OR o.room_no = '$room_no')
            ORDER BY r.created_at DESC";
}

// Execute the query
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
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        table tr:hover {
            background-color: #f9f9f9;
        }

        .status {
            font-weight: bold;
            color: green;
        }

        .status.pending {
            color: orange;
        }

        .status.completed {
            color: blue;
        }

        .status.rejected {
            color: red;
        }

        button {
            
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

        button:hover {
            background-color: #96c93d;
        }

        .dashboard-button {
            background-color: #333;
        }

        .dashboard-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Repair Requests</h1>

        <?php
        // Check if there are any results
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Sl. No.</th><th>Problem Description</th><th>Status</th><th>Confirmed Date</th><th>Created At</th></tr>";

            // Output the requests in a table
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";

                // Status styling based on the value
                $status_class = 'status';
                if ($row['status'] == 'pending') {
                    $status_class .= ' pending';
                } elseif ($row['status'] == 'completed') {
                    $status_class .= ' completed';
                } elseif ($row['status'] == 'rejected') {
                    $status_class .= ' rejected';
                }

                echo "<td><span class='" . $status_class . "'>" . $row['status'] . "</span></td>";
                echo "<td>" . $row['confirmed_date'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No requests found.</p>";
        }
        ?>

        <!-- Button to go back to the Student Dashboard -->
        <button onclick="location.href='student_dashboard.php'" class="dashboard-button">Go to Dashboard</button>
    </div>

</body>
</html>

<?php
$conn->close();
?>
