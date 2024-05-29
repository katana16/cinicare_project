<?php
// Start session
session_start();
// Unset the admin session variable

unset($_SESSION['secretary_loggedin']);
unset($_SESSION['secretaryid']);

// Redirect to login page
header('Location: login.php');
exit;
?>