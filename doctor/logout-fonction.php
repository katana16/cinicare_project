<?php
// Start session
session_start();
// Unset the admin session variable



unset($_SESSION['doctor_loggedin']);
unset($_SESSION['doctorid']);

// Redirect to login page
header('Location: login.php');
exit;
?>