<?php
// Start session
session_start();
// Unset the admin session variable
unset($_SESSION['admin_loggedin']);
unset($_SESSION['adminid']);

// Redirect to login page
header('Location: login.php');
exit;
?>