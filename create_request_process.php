<?php
session_start();
include 'db_connect.php';

$uid = $_SESSION['uid'];
$description = $_POST['description'];
$category = $_POST['category'];
$type = $_POST['type'];
$expected_date = $_POST['expected_date'];
$image_url = '';

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $image_url = 'uploads/' . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
}

$sql = "INSERT INTO repair_requests (uid, description, category, type, expected_date, image_url) VALUES ('$uid', '$description', '$category', '$type', '$expected_date', '$image_url')";

if ($conn->query($sql) === TRUE) {
    echo "Request submitted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
