<!-- SideBar -->
<div class="col-lg-2">
    <div class="sticky-sidebar">
    <section id="sidebar">
        <a href="#" class="brand">
            <i class="fa-solid fa-face-smile"></i>
            <span class="text">Admin</span>
        </a>
        <ul class="side-menu top">
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>>
            <a href="index.php">
                    <i class="fa-solid fa-table-columns"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'admin_appointments.php') echo 'class="active"'; ?>>
                <a href="admin_appointments.php">
                    <i class="fa-regular fa-calendar-check"></i>
                    <span class="text">Appointments</span>
                </a>
            </li>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'admin_doctors.php') echo 'class="active"'; ?>>
                <a href="admin_doctors.php">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span class="text">Doctors</span>
                </a>
            </li>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'admin_analysts.php') echo 'class="active"'; ?>>
                <a href="admin_analysts.php">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span class="text">Analysts</span>
                </a>
            </li>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'admin_secretary.php') echo 'class="active"'; ?>>
                <a href="admin_secretary.php">
                    <i class="fa-solid fa-hospital-user"></i>
                    <span class="text">Secretary</span>
                </a>
            </li>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'admin_patients.php') echo 'class="active"'; ?>>
                <a href="admin_patients.php">
                    <i class="fa-solid fa-bed-pulse"></i>
                    <span class="text">Patiens</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'http://localhost:8025') echo 'class="active"'; ?>>
                <a href="http://localhost:8025" target="_blank">
                    <i class="fa-solid fa-envelope"></i>
                    <span class="text">Mailbox</span>
                </a>
            </li>
            <li <?php if(basename($_SERVER['PHP_SELF']) == 'admin_setting.php') echo 'class="active"'; ?>>
                <a href="admin_setting.php">
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
<!-- End SideBar -->