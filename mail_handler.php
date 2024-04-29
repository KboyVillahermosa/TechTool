<?php
if(isset($_POST['submit'])){
    // Sender's information
    $from = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $message_body = $_POST['message'];

    // Recipient's information
    $to = "villahermosafrancisco6@gmail.com"; // Replace with the recipient's email address
    $subject = "Form submission";

    // Email headers
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "Return-Path: $from\r\n";
    $headers .= "X-Mailer: PHP\r\n";

    // SMTP configuration
    $smtpUsername = "villahermosafrancisco6@gmail.com"; // Your Gmail address
    $smtpPassword = "march252003"; // Your Gmail password
    $smtpPort = 587; // SMTP port (Gmail uses 587)
    $smtpHost = "smtp.gmail.com"; // SMTP host (Gmail)

    // Set SMTP authentication parameters
    ini_set('smtp_username', $smtpUsername);
    ini_set('smtp_password', $smtpPassword);

    // Set SMTP server and port
    ini_set('SMTP', $smtpHost);
    ini_set('smtp_port', $smtpPort);

    // Set encryption to TLS
    ini_set('smtp_ssl', 'tls');

    // Send mail
    if (mail($to, $subject, $message_body, $headers)) {
        echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    } else {
        echo "Failed to send email. Please try again later.";
    }
}
?>
