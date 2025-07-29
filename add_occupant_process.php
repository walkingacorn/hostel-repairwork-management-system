<?php
include 'db_connect.php'; // Include database connection

// Get data from form
$uid = $_POST['uid'];
$name = $_POST['name'];
$password = $_POST['password']; // Password entered by admin
$role = $_POST['role']; // role can be 'student', 'admin', or 'staff'
$room_no = isset($_POST['room_no']) ? $_POST['room_no'] : null; // Room number entered by admin (only for students)

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if the user is trying to add an admin
if ($role == 'admin') {
    // Check if there's already an admin in the system
    $check_admin_sql = "SELECT COUNT(*) AS admin_count FROM users WHERE role = 'admin'";
    $result = $conn->query($check_admin_sql);
    $row = $result->fetch_assoc();

    if ($row['admin_count'] > 0) {
        echo "Error: There is already an admin in the system. Only one admin is allowed.";
        exit(); // Prevent adding another admin
    }
}

// Insert data into users table
$sql1 = "INSERT INTO users (uid, name, password, role) 
         VALUES ('$uid', '$name', '$hashed_password', '$role')";

// Insert data into occupants table if the role is student
if ($role == 'student') {
    // Only insert into the occupants table if the role is 'student'
    $sql2 = "INSERT INTO occupants (uid, name, room_no, password) 
             VALUES ('$uid', '$name', '$room_no', '$hashed_password')";
    
    if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
        echo "Student added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    // Only insert into the users table if the role is not student
    if ($conn->query($sql1) === TRUE) {
        echo "Admin or Staff added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
