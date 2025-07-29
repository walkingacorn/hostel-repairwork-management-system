<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in by verifying session variables
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Retrieve user information from the session
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Student';
$room_no = isset($_SESSION['room_no']) ? $_SESSION['room_no'] : 'Unknown';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : 'Unknown';

// Close the database connection if it's not needed anymore
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #fff3b0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            display: flex;
            width: 70%;
            max-width: 900px;
            height: 45vh;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* Left Sidebar for Student Profile */
        .sidebar {
            flex: 1;
            background-color:#335c67 ; 
            color: white;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .sidebar h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .sidebar p {
            margin: 8px 0;
            font-size: 16px;
        }

        /* Right Content Area */
        .content {
            flex: 3;
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            background-color:#ffffff ; 
            position: relative;
        }

        .content h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            gap: 30px;
        }

        .button {
            flex: 1;
            padding: 20px;
            background-color: #e09f3e;
            color: white;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #231942;
        }

        /* Logout Button */
        .logout-button {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 25px;
            background-color: #f44336;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
        }

        .logout-button:hover {
            background-color: #d32f2f;
           
        }

        
    </style>
</head>
<body>

<div class="dashboard-container">
    <!-- Left Sidebar for Student Profile -->
    <div class="sidebar">
        <h2>Student Profile</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Room No:</strong> <?php echo htmlspecialchars($room_no); ?></p>
        <p><strong>UID:</strong> <?php echo htmlspecialchars($uid); ?></p>
    </div>

    <!-- Right Content Area for New Repair Request and View Status -->
    <div class="content">
        <h1>Student Dashboard</h1>
        <div class="button-container">
            <a href="create_request.php" class="button">New Repair Request</a>
            <a href="view_requests.php" class="button">View Status of the Request</a>
        </div>

        <!-- Logout Button -->
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</div>

</body>
</html>
