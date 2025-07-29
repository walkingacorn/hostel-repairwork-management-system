<?php
session_start();

// Check if the user is logged in by verifying session variables
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Retrieve admin information from the session
$uid = $_SESSION['uid'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color:#006d77 ; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            display: flex;
            width: 50%;
            max-width: 1200px;
            height: 40vh; /* Increased height */
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Left Sidebar for Admin Profile */
        .sidebar {
            flex: 1;
            background-color: #e29578;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .sidebar h2 {
            margin-bottom: 15px;
        }

        .sidebar p {
            margin: 5px 0;
        }

        /* Right Content Area */
        .content {
            flex: 3;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: relative;
            background-color: #edf6f9;
        }

        .content h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            gap: 20px;
        }

        .button {
            flex: 1;
            padding: 15px;
            background-color: #766153;
            color: white;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .button:hover {
            background-color: #006d77;
        }

        /* Logout Button */
        .logout-button {
            position: absolute;
            bottom: 20px; /* Position at the bottom of the content area */
            left: 50%;
            transform: translateX(-50%); /* Center the button horizontally */
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
    <!-- Left Sidebar for Admin Profile -->
    <div class="sidebar">
        <h2>Admin Profile</h2>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Role:</strong> Administrator</p>
        <p><strong>UID:</strong> <?php echo htmlspecialchars($uid); ?></p>
    </div>

    <!-- Right Content Area for Manage Users and View Requests -->
    <div class="content">
        <h1>Admin Dashboard</h1>
        <div class="button-container">
            <a href="add_occupant.php" class="button">Manage Users</a>
            <a href="view_requests_admin.php" class="button">View All Repair Requests</a>
        </div>

        <!-- Logout Button -->
        <a href="logout.php" class="logout-button">Logout</a>
    </div>
</div>

</body>
</html>
