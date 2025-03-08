<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';


// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $requirements = $_POST['requirements'];

$title = "General";

    $template = file_get_contents('./enquirymailtemplate.php');
    $template = str_replace(['{{name}}', '{{email}}', '{{phone}}', '{{requirements}}'], [$name, $email, $phone, $requirements, $title], $template);
   
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        $mail->isSendmail();

        // Recipient and sender settings
        $mail->setFrom('no-reply@hilifebuilders.in', 'Hi-Life');
        // $mail->addAddress('hilifesales@gmail.com');
        $mail->addAddress('goutham.krishna@acodez.co.in');
        $mail->addCC('t.adhil@acodez.co.in');
        // $mail->addBCC('ads@acodez.in');

        $title = "General";

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Enquiry - ' . $title;
        $mail->Body    = $template;
        $mail->AltBody = "Name: $name\n Email: $email\n Phone: $phone\n Requirements: $requirements\n";

        // Send email
        if ($mail->send()) {
            echo 'Message sent successfully!';
        } else {
            echo 'Message could not be sent.';
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'Invalid request method.';
}
