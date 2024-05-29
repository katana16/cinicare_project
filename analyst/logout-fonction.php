<?php
// Start session
session_start();
// Unset the admin session variable



unset($_SESSION['analyst_loggedin']);
unset($_SESSION['analystid']);

// Redirect to login page
header('Location: login.php');
exit;
?>