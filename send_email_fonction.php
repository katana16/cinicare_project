<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['msg'] = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    
    // Example: Send email
    $to = "mb16virgo@gmail.com";
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        $_SESSION['msg'] ='Message sent successfully!';
    } else {
        $_SESSION['msg'] = 'Failed to send message. Please try again later';
    }
header("Location: contactus.php");
exit();
}
?>