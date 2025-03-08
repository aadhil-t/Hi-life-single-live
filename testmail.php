<?php
$to = "goutham.krishna@acodez.co.in"; // Replace with recipient's email
$subject = "Test Email";
$message = "Hello, this is a test email sent using PHP!";
$headers = "From: sender@example.com"; // Replace with sender's email

if(mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
?>
