<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $contact = htmlspecialchars($_POST['contact']);
    $device = htmlspecialchars($_POST['device']);
    $issue = htmlspecialchars($_POST['issue']);
    $contactMethod = htmlspecialchars($_POST['contactMethod']);

    $uploadedFile = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $fileName = basename($_FILES["photo"]["name"]);
        $targetFilePath = $uploadDir . $fileName;

        // Validate file type
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
                $uploadedFile = $targetFilePath;
            } else {
                $uploadedFile = "Error uploading file.";
            }
        } else {
            $uploadedFile = "Invalid file type.";
        }
    }

    // Email recipient and subject
    $to = "smartechxwireless@gmail.com";
    $subject = "New Diagnostic Form Submission";

    // Email message
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
        <p><strong>Preferred Contact Method:</strong> $contactMethod</p>";
    if (!empty($uploadedFile) && $uploadedFile !== "Error uploading file." && $uploadedFile !== "Invalid file type.") {
        $message .= "<p><strong>Uploaded Photo:</strong> <a href='$uploadedFile'>View File</a></p>";
    } else {
        $message .= "<p><strong>Uploaded Photo:</strong> $uploadedFile</p>";
    }
    $message .= "
    </body>
    </html>";

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
