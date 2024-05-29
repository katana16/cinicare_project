<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['doctor_loggedin'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}
?>