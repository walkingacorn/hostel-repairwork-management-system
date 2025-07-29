<?php
session_start();
include 'db_connect.php'; // Include your database connection

$uid = $_POST['uid']; // User ID from the login form
$password = $_POST['password']; // Password from the login form

// SQL query to check both users and occupants table using JOIN
$sql = "
    SELECT u.uid, u.name, u.password, u.role, o.room_no 
    FROM users u 
    LEFT JOIN occupants o ON u.uid = o.uid
    WHERE u.uid = '$uid'";  // We match the user by UID

// Execute the query
$result = $conn->query($sql);

// Check if user exists in the database
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc(); // Fetch user data

    // Verify the password using password_verify() function
    if (password_verify($password, $user['password'])) {
        // Set session variables for user
        $_SESSION['uid'] = $user['uid']; // Store UID in session
        $_SESSION['role'] = $user['role']; // Store role (admin, student, staff) in session
        $_SESSION['room_no'] = $user['room_no']; // Store room number in session for students
        $_SESSION['name'] = $user['name'];

        // Redirect based on the user's role
        if ($user['role'] == 'admin') {
            header('Location: admin_dashboard.php'); // Admin dashboard
        } elseif ($user['role'] == 'student') {
            header('Location: student_dashboard.php'); // Student dashboard
        } elseif ($user['role'] == 'staff') {
            header('Location: staff_dashboard.php'); // Staff dashboard
        }
        exit(); // Stop further script execution after redirect
    } else {
        echo "Invalid UID or Password."; // If password is incorrect
    }
} else {
    echo "No user found with the provided UID."; // If no user is found with the provided UID
}

?>
