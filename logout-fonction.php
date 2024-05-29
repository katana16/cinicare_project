<?php
// Start session
session_start();
// Unset the admin session variable
unset($_SESSION['patient_loggedin']);
unset($_SESSION['patientid']);

// Redirect to login page
header('Location: login.php');
exit;
?>