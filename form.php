<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $contact = htmlspecialchars($_POST['contact']);
    $device = htmlspecialchars($_POST['device']);
    $issue = htmlspecialchars($_POST['issue']);
    $contactMethod = htmlspecialchars($_POST['contactMethod']);

    // Email recipient and subject
    $to = "smartechxwireless@gmail.com"; // Replace with your email
    $subject = "New Diagnostic Form Submission";

    // Email body content
    $message = "
    <html>
    <head>
        <title>Diagnostic Form Submission</title>
    </head>
    <body>
        <h2>Diagnostic Form Details</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Contact:</strong> $contact</p>
        <p><strong>Device:</strong> $device</p>
        <p><strong>Issue:</strong></p>
        <p>$issue</p>
        <p><strong>Preferred Contact Method:</strong> $contactMethod</p>
    </body>
    </html>
    ";

    // Email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: smartechx.com" . "\r\n"; // Replace with your domain

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "<p>Thank you for submitting the diagnostic form. We will get back to you soon!</p>";
    } else {
        echo "<p>There was an error submitting the form. Please try again later.</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
