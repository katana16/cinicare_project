<?php
    require_once 'check_admin_login.php';
    $pageTitle = "Appointment List";
    require_once 'header.php'; 

    $current_date = date("Y-m-d");

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = '';

    // Check the action parameter and set the status accordingly
    if ($_GET['action'] == 'com') {
        $status = 'Completed';
    } elseif ($_GET['action'] == 'rej') {
        $status = 'Rejected';
    } elseif ($_GET['action'] == 'acc') {
        $status = 'Accepted';
    } else {
        // If an unknown action is provided, exit
        die("Unknown action");
    }

    $sql_stat = "UPDATE `appointments` SET `status`='$status' WHERE appointmentid=$id";
    $res_stat = mysqli_query($conn, $sql_stat);
    if ($res_stat) {
        header("location: admin_appointments.php");
    } else {
        die(mysqli_error($conn));
    }
}
?>

<div class="dashboard">
    <div class="row">

        <!-- SideBar -->
        <?php require_once 'admin_menu.php'; ?>
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
                                <h3>Appointment list</h3>
                                <form action="" method="get">
                                    <input type="date" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : $current_date ?>">
                                    <button type="submit" class="filter">Filter</button>
                                    <button class="reset"><a href="admin_appointments.php">Reset</a></button>
                                </form>
                            </div>

                            <?php 
                                $sql_status = "SELECT * FROM `appointments`";
                                $result_status = mysqli_query($conn, $sql_status);
                                $numRows = mysqli_num_rows($result_status);

                                if ($numRows) {
                                    if (isset($_GET['date'])) {
                                        $date = $_GET['date'];
                                        $sql_app = "SELECT * FROM `appointments` WHERE appointmentdate='$date' ORDER BY 
                                        CASE
                                            WHEN status = 'Pending' THEN 1 ELSE 2
                                        END,appointmentid";
                                    } else {
                                        $sql_app = "SELECT * FROM `appointments` ORDER BY 
                                        CASE
                                            WHEN status = 'Pending' THEN 1 ELSE 2
                                        END,doctorid,appointmentdate,appointmentid";
                                    }

                                    $result_app = mysqli_query($conn, $sql_app);
                                    $appnumRows = mysqli_num_rows($result_app);

                                    if ($appnumRows) {
                                        echo '
                                            <table>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Patient</th>
                                                    <th>Doctor</th>
                                                    <th>N°App</th>
                                                    <th>App Date</th>
                                                    <th>Status</th>
                                                    <th class="actionbtn">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        ';

                                        while ($user = mysqli_fetch_assoc($result_app)) {
                                            $appid = $user['appointmentid'];
                                            $appdate = $user['appointmentdate'];
                                            $status = $user['status'];
                                            $patientid = $user['patientid'];
                                            $doctorid = $user['doctorid'];


                                            $numApp='';
                                            $sql_DocApp = "SELECT COUNT(*) AS numApp FROM appointments WHERE doctorid = $doctorid AND appointmentdate = '$appdate' AND status='Accepted'";
                                            $res_DocApp = $conn->query($sql_DocApp);
                                            if ($res_DocApp->num_rows > 0) {
                                                while($DocApp = $res_DocApp->fetch_assoc()) {
                                                    $numApp = $DocApp["numApp"];
                                                }
                                            } else {
                                                $numApp = '0';
                                            }

                                            $sql_doc = "SELECT * FROM doctors WHERE doctorid='$doctorid'";
                                            $result_doc = $conn->query($sql_doc);
                                            $doc = $result_doc->fetch_assoc();
                                            $fullname_doc = $doc['firstname'] . ' ' . $doc['lastname'];
                                            $speciality = $doc['speciality'];


                                            $sql_pat = "SELECT * FROM `patients` WHERE patientid='$patientid'";
                                            $result_pat = mysqli_query($conn, $sql_pat);
                                            if ($result_pat) {
                                                while ($pat = mysqli_fetch_assoc($result_pat)) {
                                                    $fullname_pat = $pat['firstname'] . ' ' . $pat['lastname'];
                                                    $firstname = $pat['firstname'];
                                                    $lastname = $pat['lastname'];

                                                    echo '
                                                        <tr>
                                                            <td>'.$appid.'</td>
                                                            <td>'.$fullname_pat.'</td>
                                                            <td>'.$fullname_doc.'
                                                            <br/><span>'.$speciality.'<span>
                                                            </td>
                                                            <td>'.$numApp.'</td>
                                                            <td>'.$appdate.'</td>
                                                            <td>'.$status.'</td>
                                                            <td>
                                                        ';

                                                        if ($status == "Pending") {
                                                            echo '
                                                                <!-- Accept button -->
                                                                <button onclick="confirm_action(\'acc\', ' . $appid . ')" class="accept" title="Accept">
                                                                    <i class="fa-solid fa-check"></i> Accept
                                                                </button>
                                                            ';
                                                        }

                                                        if ($status == "Accepted" || $status == "Pending") {
                                                            echo '
                                                                <!-- Reject button -->
                                                                <button onclick="confirm_action(\'rej\', ' . $appid . ')" class="reject" title="Reject">
                                                                    <i class="fa-solid fa-times"></i> Reject
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
    function confirm_create(doctorid, patientid){
        let com = confirm('Do you Want to create Medical Record for this Patient?');
    
        if(com == true){
            window.location.href = "create_record_fonction.php?doctorid=" + doctorid + "&patientid=" + patientid;
        }
    }
    function confirm_action(action, id) {
    let confirm_message;
    
    switch (action) {
        case 'rej':
            confirm_message = 'Are you sure you want to Reject this appointment?';
            break;
        case 'acc':
            confirm_message = 'Are you sure you want to accept this appointment?';
            break;
        case 'com':
            confirm_message = 'Do you complete the consultation ?';
            break;
        default:
            // If an unknown action is provided, exit
            return;
    }
    
    let confirm_result = confirm(confirm_message);
    
    if (confirm_result) {
        window.location.href = "admin_appointments.php?action=" + action + "&id=" + id;
    }
    }
</script>
        <!-- End Content -->


    </div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>