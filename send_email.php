<?php
function sendEmailNotification($to, $subject, $message) {
    $headers = "From: hostel.repairs@example.com\r\n";
    $headers .= "Reply-To: hostel.repairs@example.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent to $to";
    } else {
        echo "Failed to send email";
    }
}
?>
