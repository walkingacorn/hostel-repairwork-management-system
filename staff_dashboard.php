<?php
session_start();

// Check if the user is logged in by verifying session variables
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Retrieve staff information from the session
$uid = $_SESSION['uid'];
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Staff';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <style>
        body {
            background-color: #98c1d9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .dashboard-container {
            display: flex;
            width: 50%;
            max-width: 1200px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            flex-direction: row; 
            height: 70vh;
        }

        /* Left Sidebar for Staff Profile */
        .sidebar {
            flex: 1;
            /*background: linear-gradient(135deg, #FF5722, #FF7043);*/
            background-color: #ee6c4d;
            color: white;
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .sidebar h2 {
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
        }

        .sidebar p {
            margin: 10px 0;
            font-size: 18px;
        }

        .sidebar p strong {
            font-weight: bold;
        }

        /* Right Content Area */
        .content {
            flex: 4;
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 40px;
            background-color: #f9fafb;
            position: relative;
            border-left: 3px solid #FF5722;
            overflow-y: auto;
        }

        .content h1 {
            text-align: center;
            font-size: 32px;
            color: #333;
            font-weight: 700;
        }

        /* Button Container for Main Buttons */
        .button-container {
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        .button {
            padding: 20px 30px;
            background-color: #3d5a80;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
        }

        .button:hover {
            background-color: #293241;
            transform: translateY(-5px);
        }

        .button:active {
            transform: translateY(2px);
        }

        /* Logout Button */
        .logout-button {
            padding: 15px 30px;
            background-color: #f44336;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease-in-out;
            align-self: center;
            margin-top: auto;
            margin-bottom: 30px;
        }

        .logout-button:hover {
            background-color: #d32f2f;
            transform: translateY(-5px);
        }

        .logout-button:active {
            transform: translateY(2px);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Left Sidebar for Staff Profile -->
        <div class="sidebar">
            <h2>Staff Profile</h2>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>UID:</strong> <?php echo htmlspecialchars($uid); ?></p>
        </div>

        <!-- Right Content Area for Manage Repair Requests and Logout -->
        <div class="content">
            <h1>Staff Dashboard</h1>

            <div class="button-container">
                <a href="view_requests_staff.php" class="button">View Repair Requests</a>
            </div>

            <!-- Logout Button -->
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </div>
</body>
</html>
