<?php
include 'db_connect.php';
include 'send_email.php';

$id = $_POST['id'];
$status = $_POST['status'];
$confirmed_date = date('Y-m-d');

// Update the request
$sql = "UPDATE repair_requests SET status='$status', confirmed_date='$confirmed_date' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Request updated successfully";

    // Retrieve student email
    $sql_email = "SELECT uid FROM repair_requests WHERE id='$id'";
    $result = $conn->query($sql_email);
    $uid = $result->fetch_assoc()['uid'];

    $sql_student = "SELECT email FROM occupants WHERE uid='$uid'";
    $result_student = $conn->query($sql_student);
    $student_email = $result_student->fetch_assoc()['email'];

    // Send email notification
    $subject = "Update on Your Repair Request";
    $message = "Dear Student,<br>Your repair request (ID: $id) has been updated to: $status.";
    if (!empty($confirmed_date)) {
        $message .= "<br>Confirmed Repair Date: $confirmed_date";
    }

    sendEmailNotification($student_email, $subject, $message);
} else {
    echo "Error updating request: " . $conn->error;
}

$conn->close();
header("Location: view_requests_staff.php");
exit;
?>
