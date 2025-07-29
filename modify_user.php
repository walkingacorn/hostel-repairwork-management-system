<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modify_user'])) {
    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;
    $role = $_POST['role'];
    $room_no = $_POST['room_no'];

    $updateUserSQL = "UPDATE users SET name = '$name', role = '$role'";
    if ($password) {
        $updateUserSQL .= ", password = '$password'";
    }
    $updateUserSQL .= " WHERE uid = '$uid'";
    $conn->query($updateUserSQL);

    if ($role == 'student') {
        $updateOccupantSQL = "UPDATE occupants SET room_no = '$room_no' WHERE uid = '$uid'";
        $conn->query($updateOccupantSQL);
    }

    echo "User updated successfully!";
} else {
    echo "Error: Invalid request";
}
?>
