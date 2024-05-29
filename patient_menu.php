<?php
$patientid = $_SESSION['patientid'];
$photopath = $fullName = "";

$sql = "SELECT * FROM patients WHERE patientid=$patientid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $fullName = $row["firstname"] . " " . $row["lastname"];
            $photoPath = $row["photo_path"];
        }
    } else {
        echo "No doctor found with the provided ID.";
    }
?>

<div class="col-lg-2">
    <div class="sticky-sidebar">
        <section id="sidebar">
            <div class="widget-profile">
                    <div class="profile-info-widget">
                        <a href="#" class="booking-doc-img">
                            <?php if ($photoPath !== 'uploads/') :?>
                                <img src="<?php echo $photoPath; ?>" alt="<?php echo $fullName; ?>">
                            <?php else : ?>
                                <img src="assets/img/default_photo.jpg" alt="Default Photo">
                            <?php endif; ?>
                        </a>
                        <div class="profile-det-info">
                            <h3><?php echo $fullName; ?></h3>
                            <div class="patient-details">

                            </div>
                        </div>
                    </div>
                </div>
                <ul class="side-menu top">
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'patient_dashboard.php') echo 'class="active"'; ?>>
                        <a href="patient_dashboard.php">
                            <i class="fa-solid fa-table-columns"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'patient_appointments.php') echo 'class="active"'; ?>>
                        <a href="patient_appointments.php">
                            <i class="fa-regular fa-calendar-check"></i>
                            <span class="text">Appointments</span>
                        </a>
                    </li>
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'patient_records.php') echo 'class="active"'; ?>>
                        <a href="patient_records.php">
                            <i class="fa-solid fa-file-medical"></i>
                            <span class="text">Medical Records</span>
                        </a>
                    </li>
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'patient_prescriptions.php') echo 'class="active"'; ?>>
                        <a href="patient_prescriptions.php">
                            <i class="fa-solid fa-bed-pulse"></i>
                            <span class="text">Prescriptions</span>
                        </a>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'patient_setting.php') echo 'class="active"'; ?>>
                        <a href="patient_setting.php">
                            <i class="fa-solid fa-gear"></i>
                            <span class="text">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout-fonction.php" class="logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span class="text">Logout</span>
                        </a>
                    </li>
                </ul>
        </section>
    </div>
</div>