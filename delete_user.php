<?php
include 'db_connect.php';

if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];
    $conn->query("DELETE FROM occupants WHERE uid = '$uid'");
    $conn->query("DELETE FROM users WHERE uid = '$uid'");
    echo "User deleted successfully!";
} else {
    echo "Error: Invalid request";
}
?>
