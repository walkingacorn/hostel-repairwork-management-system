<?php
session_start();
include 'db_connect.php'; // Include your database connection

// If form is submitted for adding a new student/staff/admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $room_no = isset($_POST['room_no']) ? $_POST['room_no'] : null; // Room No should be null for staff/admin

    // Insert into the users table
    $sql1 = "INSERT INTO users (uid, name, password, role) VALUES ('$uid', '$name', '$password', '$role')";
    if ($conn->query($sql1) === TRUE) {
        // If role is 'student', insert into occupants table with room_no
        if ($role == 'student') {
            $sql2 = "INSERT INTO occupants (uid, name, room_no, password) VALUES ('$uid', '$name', '$room_no', '$password')";
            $conn->query($sql2);
        }
        echo "User added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Users</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Your custom styles for the page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #588b8b;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #f28f3b;
            text-align: center;
        }
        .search-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .search-bar input {
            width: 60%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-bar button {
            padding: 10px 20px;
            background-color: #f28f3b;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .search-bar button:hover {
            background-color: #45a049;
        }
        .add-student-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        .add-student-form h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .add-student-form input,
        .add-student-form select,
        .add-student-form button {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .add-student-form select {
            padding: 14px;
        }
        .add-student-form button {
            background-color: #00b09b;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .add-student-form button:hover {
            background-color: #45a049;
        }
        .students-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .students-table th,
        .students-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ccc;
        }
        .students-table th {
            background-color: #f28f3b;
            color: white;
        }
        .students-table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .students-table .actions button {
            padding: 8px 16px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .students-table .actions button.modify {
            background-color: #6b4e71;
        }
        .students-table .actions button:hover {
            background-color: #d32f2f;
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

       
        
        

        @media (max-width: 768px) {
            .search-bar input {
                width: 75%;
            }
            .students-table,
            .students-table th,
            .students-table td {
                font-size: 14px;
            }
        }

       </style>
</head>
<body>

<div class="container">
    <h1>Manage Users</h1>

    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" placeholder="Search by Name or UID" id="searchInput" onkeyup="filterStudents()">
        <button onclick="filterStudents()">Search</button>
    </div>

    <!-- Add New User Form -->
    <div class="add-student-form">
        <h2>Add New User</h2>
        <form action="add_occupant_process.php" method="POST">
            <input type="text" name="name" placeholder="Enter name" required>
            <input type="text" name="uid" placeholder="Enter UID" required>
            <input type="password" name="password" placeholder="Enter password" required>

            <!-- Role Dropdown -->
            <label for="role">Role:</label>
            <select name="role" id="role" required onchange="toggleRoomNo()">
                <option value="student">Student</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option> <!-- Added Admin option -->
            </select>

            <!-- Room Number Field (conditionally displayed) -->
            <div id="roomNoField">
                <input type="text" name="room_no" placeholder="Enter room number">
            </div>

            <button type="submit" name="add_user">Add User</button>
        </form>
    </div>

    <!-- Users Table -->
    <table class="students-table" id="studentsTable">
        <thead>
            <tr>
                <th>Sl. No.</th>
                <th>UID</th>
                <th>Name</th>
                <th>Room No.</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch users from the database
            $sql = "SELECT * FROM users u LEFT JOIN occupants o ON u.uid = o.uid";
            $result = $conn->query($sql);
            $i = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr data-uid='" . $row['uid'] . "'>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row['uid'] . "</td>"; // Ensure UID is being displayed
                echo "<td>" . $row['name'] . "</td>"; // Ensure Name is being displayed
                echo "<td>" . ($row['room_no'] ?: '-') . "</td>"; // Display room number or '-' if not available
                echo "<td>" . $row['role'] . "</td>";
                echo "<td class='actions'>
                        <button class='modify' onclick='modifyUser(\"" . $row['uid'] . "\")'>Modify</button>
                        <button onclick='deleteUser(\"" . $row['uid'] . "\")'>Delete</button>
                      </td>";
                echo "</tr>";
                $i++;
            }

            ?>
        </tbody>
    </table>

     <!-- Button to go back to the Student Dashboard -->
     <button onclick="location.href='admin_dashboard.php'" class="dashboard-button" id="gotodash">Go to Dashboard</button>       

</div>

<script>
// Modify user function
function modifyUser(uid) {
    window.location.href = `modify_user.php?uid=${uid}`; // Redirect to modify page
}

// Delete user function
function deleteUser(uid) {
    if (confirm("Are you sure you want to delete this user?")) {
        window.location.href = `delete_user.php?uid=${uid}`; // Redirect to delete user page
    }
}

// Search function for filtering users by UID or name
function filterStudents() {
    let input = document.getElementById("searchInput").value.toUpperCase();
    let table = document.getElementById("studentsTable");
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        let columns = rows[i].getElementsByTagName("td");
        let name = columns[2].textContent.toUpperCase();
        let uid = columns[1].textContent.toUpperCase();

        if (name.includes(input) || uid.includes(input)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

// Toggle the room number field based on the role selection
function toggleRoomNo() {
    let role = document.getElementById("role").value;
    let roomNoField = document.getElementById("roomNoField");
    if (role === "student") {
        roomNoField.style.display = "block";
    } else {
        roomNoField.style.display = "none";
    }
}
</script>

</body>
</html>
