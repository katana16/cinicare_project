<?php
require_once 'db_connection.php'; 

// Get the patientId and doctorId from the URL parameters
$patientid = $_GET['patientid'];
$doctorid = $_GET['doctorid'];
$recorddate = date("Y-m-d");
// Insert new record into the 'records' table
$sql = "INSERT INTO medicalrecords (patientid, doctorid, recorddate) VALUES ('$patientid', '$doctorid', '$recorddate')";
if (mysqli_query($conn, $sql)) {
    // Get the ID of the newly inserted record
    $newRecordId = mysqli_insert_id($conn);
    // Redirect to the medical record page with the ID of the new record
    header("Location: doctor_record_create.php?recordid=$newRecordId");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
