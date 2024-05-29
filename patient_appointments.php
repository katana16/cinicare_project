<?php
    require_once 'check_patient_login.php';
    $pageTitle = "Appointments";
    require_once 'header.php';
    
    if (isset($_GET['action']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $status = '';
    
        if ($_GET['action'] == 'can') {
            $status = 'Cancelled';
        } else {
            die("Unknown action");
        }
    
        $sql_stat = "UPDATE `appointments` SET `status`='$status' WHERE appointmentid=$id";
        $res_stat = mysqli_query($conn, $sql_stat);
        if ($res_stat) {
            header("location:patient_appointments.php");
        } else {
            die(mysqli_error($conn));
        }
    }
?>



<div class="dashboard">
    <div class="row">

        <!-- SideBar -->
        <?php require_once 'patient_menu.php'; ?>
        <!-- End SideBar -->



        <!-- Content -->
        <div class="col-lg-10 ">
<section id="content">

    <!-- Main -->
    <main>

        <div class="container">
            <div class="head-title">
                <h1>Appointment</h1>
            </div>
            

            <div class="all-list list box">
                <div class="box-head head">
                    <h3>Appointment List</h3>
                    <form action="" method="get">
                        <input type="date" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : $current_date ?>">
                        <button type="submit" class="filter">Filter</button>
                        <button class="reset"><a href="patient_appointments.php">Reset</a></button>
                    </form>
                </div>

                <?php 
                    $sql_status = "SELECT * FROM `appointments`";
                    $result_status = mysqli_query($conn, $sql_status);
                    $numRows = mysqli_num_rows($result_status);

                    if ($numRows) {
                        if (isset($_GET['date'])) {
                            $date = $_GET['date'];
                            $sql_app = "SELECT * FROM `appointments` WHERE appointmentdate='$date' AND patientid='{$_SESSION['patientid']}' ORDER BY turn";
                        } else {
                            $sql_app = "SELECT * FROM `appointments` WHERE patientid='{$_SESSION['patientid']}' ORDER BY appointmentdate, turn";
                        }

                        $result_app = mysqli_query($conn, $sql_app);
                        $appnumRows = mysqli_num_rows($result_app);

                        if ($appnumRows) {
                            echo '
                                <table>
                                <thead>
                                    <tr>
                                        <th>Turn</th>
                                        <th>Appt Date</th>
                                        <th>Doctor</th>
                                        <th>Status</th>
                                        <th class="actionbtn">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ';

                            while ($user = mysqli_fetch_assoc($result_app)) {
                                $appid = $user['appointmentid'];
                                $turn = $user['turn'];
                                $doctorid = $user['doctorid'];
                                $appdate = $user['appointmentdate'];
                                $status = $user['status'];
                                $sql_doc = "SELECT * FROM `doctors` WHERE doctorid='$doctorid'";
                                $result_doc = mysqli_query($conn, $sql_doc);
                                if ($result_doc) {
                                    while ($doc = mysqli_fetch_assoc($result_doc)) {
                                        $fullname = $doc['firstname'] . ' ' . $doc['lastname'];
                                        $speciality = $doc['speciality'];

                                        echo '
                                            <tr>
                                                <td>'.$turn.'<br/>
                                                <td>'.$appdate.'</td>
                                                <td>'.$fullname.'<br/>
                                                    <span>'.$speciality.'<span>
                                                </td>
                                                <td>'.$status.'</td>
                                                <td>
                                            ';

                                        if ($status == "Accepted" || $status == "Pending" || $status == "") {
                                            echo '
                                                <!-- Cancel button -->
                                                <button onclick="confirm_action(\'can\', ' . $appid . ')" class="cancel" title="Cancel">
                                                    <i class="fa-solid fa-times"></i> Cancel
                                                </button>
                                            ';
                                        }

                                                echo '
                                                    </td>
                                                </tr>

                                                ';
                                    }
                                }
                            }

                            echo '
                                </tbody>
                                </table>
                            ';
                        } else {
                            echo 'There are no appointments for this day';
                        }
                    } else {
                        echo 'There are no appointments';
                    }

                    // Close connection
                    $conn->close();
                ?>

            </div>
        </div>

    </main>
</section>
        </div>
<script>
    function confirm_action(action, id) {
        let confirm_message;
        
        switch (action) {
            case 'can':
                confirm_message = 'Are you sure you want to cancel this appointment?';
                break;
            default:
                // If an unknown action is provided, exit
                return;
        }
        
        let confirm_result = confirm(confirm_message);
        
        if (confirm_result) {
            window.location.href = "patient_appointments.php?action=" + action + "&id=" + id;
        }
    }
</script>
        <!-- End Content -->

</div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>