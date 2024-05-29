<?php
    require_once 'check_analyst_login.php';
    $pageTitle = "Analyst Dashboard";
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

    $sql_stat = "UPDATE `tests` SET `status`='$status' WHERE testid=$id";
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
        <?php require_once 'analyst_menu.php'; ?>
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
                                    <h3>Today Requested Tests</h3>
                                </div>
                                <?php
                                
                                    $current_date = date("Y-m-d");
                                    $sql_test = "SELECT * FROM `tests` WHERE requestdate='$current_date' AND analystid='{$_SESSION['analystid']}'";
                                    $result_test = mysqli_query($conn,$sql_test);
                                    $testnumRows = mysqli_num_rows($result_test);
                                        if ($result_test->num_rows > 0) {
                                            echo '
                                            <table>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Patient</th>
                                                    <th>Type</th>
                                                    <th>Priority</th>
                                                    <th>Status</th>
                                                    <th class="actionbtn">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            ';
                                            while($user = mysqli_fetch_assoc($result_test)) {
                                                $testid = $user['testid'];
                                                $testtype = $user['testtype'];
                                                $status = $user['status'];
                                                $priority = $user['priority'];
                                                $recordid = $user['recordid'];

                                                $sql_rec = "SELECT * FROM `medicalrecords` WHERE recordid='$recordid'";
                                                $result_rec = mysqli_query($conn,$sql_rec);
                                                $rec = mysqli_fetch_assoc($result_rec);
                                                $patientid = $rec['patientid'];

                                                $sql_pat = "SELECT * FROM `patients` WHERE patientid='$patientid'";
                                                $result_pat = mysqli_query($conn,$sql_pat);

                                                    $pat = mysqli_fetch_assoc($result_pat);
                                                        $pat_fullname = $pat['firstname'] . ' ' . $pat['lastname'];
                                                        $firstname = $pat['firstname'];
                                                        $lastname = $pat['lastname'];
                                                        $patientid= $pat['patientid'];
                                                        $analystid = $_SESSION['analystid'];
                
                                                        echo '

                                                            <tr>
                                                                <td>'.$testid.'</td>
                                                                <td>'.$pat_fullname.'</td>
                                                                <td>'.$testtype.'</td>
                                                                <td>'.$priority.'</td>
                                                                <td>'.$status.'</td>
                                                                <td>
   
                                                                ';

                                                        if ($status == "Pending") {
                                                            echo '
                                                                <!-- Complete button -->
                                                                <button onclick="confirm_action(\'com\', ' . $testid . ')" class="complete" title="Complete">
                                                                    <i class="fa-solid fa-check"></i> Complete
                                                                </button>

                                                                <!-- Reject button -->
                                                                <button onclick="confirm_action(\'rej\', ' . $testid . ')" class="reject" title="Reject">
                                                                    <i class="fa-solid fa-times"></i> Reject
                                                                </button>

                                                                <!-- Edit button -->
                                                                <button class="edit" title="Write Test Results">
                                                                <a href="analyst_write_results.php?testid=' . $testid . '"
                                                                <i class="far fa-edit"></i> Write
                                                                </a>
                                                                </button>
                                                            ';
                                                        }

                                                        if ($status == "Completed") {
                                                            echo '
                                                                <!-- View button -->
                                                                <button class="view" title="View Test Results">
                                                                <a href="analyst_view_results.php?testid=' . $testid . '"
                                                                <i class="far fa-eye"></i> View
                                                                </a>
                                                                </button>
                                                            ';
                                                        }

                                                            echo '
                                                                </td>
                                                            </tr>

                                                        ';      
                                                
                                            }

                                            echo '
                                            </tbody>
                                            </table>
                                            ';

                                        }   else {
                                            echo'There is No Test Request This Day';
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
            case 'rej':
                confirm_message = 'Are you sure you want to Reject this Test?';
                break;
            case 'acc':
                confirm_message = 'Are you sure you want to accept this Test?';
                break;
            case 'com':
                confirm_message = 'Do you complete the Test?';
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
