<?php
    require_once 'check_admin_login.php';
    $pageTitle = "Admin Dashboard";
    require_once 'header.php'; 

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = '';

    if ($_GET['action'] == 'com') {
        $status = 'Completed';
    } elseif ($_GET['action'] == 'rej') {
        $status = 'Rejected';
    } elseif ($_GET['action'] == 'acc') {
        $status = 'Accepted';
    } else {
        die("Unknown action");
    }

    $sql_stat = "UPDATE `appointments` SET `status`='$status' WHERE appointmentid=$id";
    $res_stat = mysqli_query($conn, $sql_stat);
    if ($res_stat) {
        header("location:index.php");
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
                            <h1>Dashboard</h1>
                        </div>

                        <ul class="box-info">
                            <li>
                            <i class="fa-solid fa-hospital-user"></i>
                                <span class="text">
                                    <?php 
                                        $query = "SELECT * FROM `analysts`";
                                        $result = mysqli_query($conn,$query);
                                        if($totalCount = mysqli_num_rows($result)){
                                            echo '<h3>'.$totalCount.'</h3>';
                                        }else {
                                            echo '<h3>NO Data</h3>';
                                        } 
                                    ?>
                                    <p>Analysts</p>
                                </span>
                            </li>
                            <li>
                                <i class="fa-solid fa-bed-pulse"></i>
                                <span class="text">
                                    <?php 
                                        $query = "SELECT * FROM `patients`";
                                        $result = mysqli_query($conn,$query);
                                        if($totalCount = mysqli_num_rows($result)){
                                            echo '<h3>'.$totalCount.'</h3>';
                                        }else {
                                            echo '<h3>NO Data</h3>';
                                        } 
                                    ?>
                                    <p>Patiens</p>
                                </span>
                            </li>
                            <li>
                                <i class="fa-solid fa-user-doctor"></i>
                                <span class="text">
                                    <?php 
                                        $query = "SELECT * FROM `doctors`";
                                        $result = mysqli_query($conn,$query);
                                        if($totalCount = mysqli_num_rows($result)){
                                            echo '<h3>'.$totalCount.'</h3>';
                                        }else {
                                            echo '<h3>NO Data</h3>';
                                        } 
                                    ?>
                                    <p>Doctors</p>
                                </span>
                            </li>
                        </ul>

                        <div class="table-data">
                            <div class="order">
                                <div class="head">
                                    <h3>Today Appointments</h3>
                                </div>
                                <?php
                                    $current_date = date("Y-m-d");
                                    $sql_app = "SELECT * FROM `appointments` WHERE appointmentdate='$current_date' AND status='Pending' ORDER BY doctorid, appointmentid";
                                    $result_app = mysqli_query($conn,$sql_app);
                                    $appnumRows = mysqli_num_rows($result_app);
                                    if($appnumRows){
                                        if($result_app){
                                            echo '
                                            <table>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Patient</th>
                                                    <th>Doctor</th>
                                                    <th>N°App</th>
                                                    <th>Status</th>
                                                    <th class="actionbtn">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            ';
                                            while($user = mysqli_fetch_assoc($result_app)) {
                                                $appid = $user['appointmentid'];
                                                $status = $user['status'];
                                                $patientid = $user['patientid'];
                                                $doctorid = $user['doctorid'];

                                                $numApp='';
                                                $sql_DocApp = "SELECT COUNT(*) AS numApp FROM appointments WHERE doctorid = $doctorid AND appointmentdate = '$current_date' AND status='Accepted'";
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
                                                $result_pat = mysqli_query($conn,$sql_pat);
                                                if($result_pat){
                                                    while($pat = mysqli_fetch_assoc($result_pat)){
                                                        $fullname_pat = $pat['firstname'] . ' ' . $pat['lastname'];
                
                                                        echo '
                                                            <tr>
                                                                <td>'.$appid.'</td>
                                                                <td>'.$fullname_pat.'</td>
                                                                <td>'.$fullname_doc.'
                                                                <br/><span>'.$speciality.'<span>
                                                                </td>
                                                                <td>'.$numApp.'</td>
                                                                <td>'.$status.'</td>
                                                                <td>
                                                        ';

                                                        if ($status == "Rejected" || $status == "Pending") {
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
                                        }
                                    }
                                    else{
                                            echo'There is No Appointment Requests This Day';
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
                confirm_message = 'Are you sure you want to reject this appointment?';
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
            window.location.href = "index.php?action=" + action + "&id=" + id;
        }
    }
</script>
        <!-- End Content -->

    </div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>
