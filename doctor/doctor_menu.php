
<?php
$doctorid = $_SESSION['doctorid'];
$photopath = $fullName = $speciality = "";

$sql = "SELECT firstname, lastname, photo_path, speciality FROM doctors WHERE doctorid = $doctorid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $fullName = $row["firstname"] . " " . $row["lastname"];
            $photoPath = $row["photo_path"];
            $speciality = $row["speciality"];
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
                                <img src="../<?php echo $photoPath; ?>" alt="<?php echo $fullName; ?>">
                            <?php else : ?>
                                <img src="../assets/img/default_photo.jpg" alt="Default Photo">
                            <?php endif; ?>
                        </a>
                        <div class="profile-det-info">
                            <h3>Dr. <?php echo $fullName; ?></h3>
                            
                            <div class="patient-details">
                                <h5 class="mb-0"><?php echo $speciality; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="side-menu top">
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>>
                        <a href="index.php">
                            <i class="fa-solid fa-table-columns"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'doctor_appointments.php') echo 'class="active"'; ?>>
                        <a href="doctor_appointments.php">
                            <i class="fa-regular fa-calendar-check"></i>
                            <span class="text">Appointment List</span>
                        </a>
                    </li>
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'doctor_records.php') echo 'class="active"'; ?>>
                        <a href="doctor_records.php">
                            <i class="fa-solid fa-file-medical"></i>
                            <span class="text">Patients Record</span>
                        </a>
                    </li>
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'doctor_work_days.php') echo 'class="active"'; ?>>
                        <a href="doctor_work_days.php">
                            <i class="fa-solid fa-bed-pulse"></i>
                            <span class="text">Working Days</span>
                        </a>
                    </li>
                </ul>
                <ul class="side-menu">
                    <li <?php if(basename($_SERVER['PHP_SELF']) == 'doctor_setting.php') echo 'class="active"'; ?>>
                        <a href="doctor_setting.php">
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