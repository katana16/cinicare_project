<?php
    require_once 'check_patient_login.php';
    $pageTitle = "Patient Dashboard";
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
            header("location:patient_dashboard.php");
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
                            <h1>Dashboard</h1>
                        </div>
                    
                        <div class="table-data">
                            <div class="order">
                                <div class="head">
                                    <h3>Today Appointment</h3>
                                </div>
                                <?php
                                
                                    $current_date = date("Y-m-d");
                                    $sql_app = "SELECT * FROM `appointments` WHERE appointmentdate='$current_date' AND patientid='{$_SESSION['patientid']}' ORDER BY turn";
                                    $result_app = mysqli_query($conn,$sql_app);
                                    $appnumRows = mysqli_num_rows($result_app);
                                    if($appnumRows){
                                        if($result_app){
                                            echo '
                                            <table>
                                            <thead>
                                                <tr>
                                                    <th>Turn</th>
                                                    <th>Doctor</th>
                                                    <th>Speciality</th>
                                                    <th>Status</th>
                                                    <th class="actionbtn">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            ';
                                            while($user = mysqli_fetch_assoc($result_app)) {
                                                $appid = $user['appointmentid'];
                                                $turn = $user['turn'];
                                                $doctorid = $user['doctorid'];
                                                $status = $user['status'];

                                                $sql_doc = "SELECT * FROM `doctors` WHERE doctorid='$doctorid'";
                                                $result_doc = mysqli_query($conn,$sql_doc);
                                                if($result_doc){
                                                    while($doc = mysqli_fetch_assoc($result_doc)){
                                                        $fullname = $doc['firstname'] . ' ' . $doc['lastname'];
                                                        $speciality = $doc['speciality'];
                                                        $doctorid= $doc['doctorid'];
                                                        $patientid = $_SESSION['patientid'];
                
                                                        echo '

                                                            <tr>
                                                                <td>'.$turn.'<br/>
                                                                <td>'.$fullname.'</td>
                                                                <td>'.$speciality.'</td>
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

                                                        if ($status == "Accepted") {
                                                            echo '
                                                            <button class="view" title="Track your turn">
                                                            <a href="patient_track_turn.php?doctorid=' . $doctorid . '&appointmentid='.$appid.'"
                                                            <i class="far fa-clock"></i> Track
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
            window.location.href = "patient_dashboard.php?action=" + action + "&id=" + id;
        }
    }
</script>
        <!-- End Content -->

</div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>