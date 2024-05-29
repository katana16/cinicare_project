<!-- Header -->
<?php 
    require_once 'check_patient_login.php';
    $pageTitle = "Patient Profile";
    require_once 'header.php'; 
?>



<!-- Main Content -->
<?php
$username = $_SESSION['patientid'];

// Check if a new photo was uploaded
if(isset($_FILES['photo'])) {
    // Get the old photo path from the database
    $get_photo_sql = "SELECT photo_path FROM patients WHERE username='$username'";
    $result = $conn->query($get_photo_sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $old_photo_path = $row['photo_path'];
        
        // Delete the old photo file from the server
        if(file_exists($old_photo_path)) {
            unlink($old_photo_path);
        }
    }
    
    // Upload the new photo
    $file_name = $_FILES['photo']['name'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_destination = 'uploads/' . $file_name; // Change 'uploads/' to your desired directory
    move_uploaded_file($file_tmp, $file_destination);
    
    // Save file path to the database
    $update_photo_sql = "UPDATE patients SET photo_path='$file_destination' WHERE username='$username'";
    if ($conn->query($update_photo_sql) === TRUE) {
        // Photo updated successfully
    } else {
        // Error updating photo
    }
}

// Fetch user data after updating photo
$sql = "SELECT * FROM patients WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first row (assuming username is unique)
    $row = $result->fetch_assoc();
    $photo_path = $row['photo_path'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
} else {
    $photo_path = 'default_photo.jpg'; // Default photo path if no photo found
    echo "<p>User not found</p>";
}

$conn->close();
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="photo" accept="image/*">
    <input type="hidden" name="username" value="<?php echo $username; ?>">
    <input type="submit" value="Upload Photo">
</form>

<h1>Welcome, <?php echo $firstname . " " . $lastname; ?></h1>
<img src="<?php echo $photo_path; ?>" alt="User Photo">
<!-- Add other profile information here -->










<!-- Footer -->
<?php require_once 'footer.php'; ?>