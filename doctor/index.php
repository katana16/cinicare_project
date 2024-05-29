<?php
    require_once 'check_doctor_login.php';
    $pageTitle = "Doctor Dashboard";
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
        <?php require_once 'doctor_menu.php'; ?>
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

                        <div class="table-data">
                            <div class="order">
                                <div class="head">
                                    <h3>Today Appointment</h3>
                                </div>
                                <?php
                                
                                    $current_date = date("Y-m-d");
                                    $sql_app = "SELECT * FROM `appointments` WHERE appointmentdate='$current_date' 
                                    AND doctorid='{$_SESSION['doctorid']}'
                                    AND status NOT IN ('Rejected', 'Cancelled') 
                                    ORDER BY turn";
                                    $result_app = mysqli_query($conn,$sql_app);
                                    $appnumRows = mysqli_num_rows($result_app);
                                    if($appnumRows){
                                        if($result_app){
                                            echo '
                                            <table>
                                            <thead>
                                                <tr>
                                                    <th>Turn</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Status</th>
                                                    <th class="actionbtn">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            ';
                                            while($user = mysqli_fetch_assoc($result_app)) {
                                                $appid = $user['appointmentid'];
                                                $turn = $user['turn'];
                                                $patientid = $user['patientid'];
                                                $status = $user['status'];

                                                $sql_pat = "SELECT * FROM `patients` WHERE patientid='$patientid'";
                                                $result_pat = mysqli_query($conn,$sql_pat);
                                                if($result_pat){
                                                    while($pat = mysqli_fetch_assoc($result_pat)){
                                                        $firstname = $pat['firstname'];
                                                        $lastname = $pat['lastname'];
                                                        $patientid= $pat['patientid'];
                                                        $doctorid = $_SESSION['doctorid'];
                
                                                        echo '

                                                            <tr>
                                                                <td>'.$turn.'</td>
                                                                <td>'.$firstname.'</td>
                                                                <td>'.$lastname.'</td>
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
                                                        if ($status == "Accepted") {
                                                            echo '
                                                                <!-- Complete button -->
                                                                <button onclick="confirm_action(\'com\', ' . $appid . ')" class="complete" title="Complete">
                                                                    <i class="fa-solid fa-check"></i> Complete
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


                                                        if ($status == "Accepted") {
                                                            echo '
                                                                <button class="create" title="Create Record" onclick="confirm_create(' . $doctorid . ', ' . $patientid . ')">
                                                                <i class="fas fa-file"></i> Create
                                                                </a>
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
                                            echo'There is No Appointment This Day';
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
            window.location.href = "index.php?action=" + action + "&id=" + id;
        }
    }
</script>
        <!-- End Content -->

    </div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>
