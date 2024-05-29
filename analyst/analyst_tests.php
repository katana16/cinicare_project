<?php
    require_once 'check_analyst_login.php';
    $pageTitle = "Analyst Tests List";
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

    $sql_stat = "UPDATE `tests` SET `status`='$status' WHERE testid=$id";
    $res_stat = mysqli_query($conn, $sql_stat);
    if ($res_stat) {
        header("location: analyst_tests.php");
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
                            <h1>Appointment</h1>
                        </div>
                        

                        <div class="all-list list box">
                            <div class="box-head head">
                                <h3>Appointment list</h3>
                                <form action="" method="get">
                                    <input type="date" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : $current_date ?>">
                                    <button type="submit" class="filter">Filter</button>
                                    <button class="reset"><a href="doctor_appointments.php">Reset</a></button>
                                </form>
                            </div>

                            <?php 
                                $sql_status = "SELECT * FROM `tests`";
                                $result_status = mysqli_query($conn, $sql_status);
                                $numRows = mysqli_num_rows($result_status);

                                if ($numRows) {
                                    if (isset($_GET['date'])) {
                                        $date = $_GET['date'];
                                        $sql_test = "SELECT * FROM `tests` WHERE requestdate='$date' AND analystid='{$_SESSION['analystid']}' ORDER BY 
                                        CASE
                                            WHEN status = 'Pending' THEN 1 ELSE 2
                                        END,
                                        requestdate";
                                    } else {
                                        $sql_test = "SELECT * FROM `tests` WHERE analystid='{$_SESSION['analystid']}' ORDER BY 
                                        CASE
                                            WHEN status = 'Pending' THEN 1 ELSE 2
                                        END,
                                        requestdate";
                                    }

                                    $result_test = mysqli_query($conn, $sql_test);
                                    $appnumRows = mysqli_num_rows($result_test);

                                    if ($appnumRows) {
                                        echo '
                                            <table>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Priority</th>
                                                    <th>Status</th>
                                                    <th class="actionbtn">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        ';

                                        while ($user = mysqli_fetch_assoc($result_test)) {
                                            $testid = $user['testid'];
                                            $requestdate = $user['requestdate'];
                                            $testtype = $user['testtype'];
                                            $status = $user['status'];
                                            $priority = $user['priority'];
                                            $recordid = $user['recordid'];

                                            $sql_rec = "SELECT * FROM `medicalrecords` WHERE recordid='$recordid'";
                                            $result_rec = mysqli_query($conn,$sql_rec);
                                            $rec = mysqli_fetch_assoc($result_rec);
                                            $patientid = $rec['patientid'];
                                            $doctorid = $rec['doctorid'];


                                            $sql_pat = "SELECT * FROM `patients` WHERE patientid='$patientid'";
                                            $result_pat = mysqli_query($conn, $sql_pat);
                                            if ($result_pat) {
                                                while ($pat = mysqli_fetch_assoc($result_pat)) {
                                                    $fullname = $pat['firstname'] . ' ' . $pat['lastname'];
                                                    $firstname = $pat['firstname'];
                                                    $lastname = $pat['lastname'];

                                                    echo '
                                                        <tr>
                                                            <td>'.$testid.'</td>
                                                            <td>'.$requestdate.'</td>
                                                            <td>'.$fullname.'</td>
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
        case 'rej':
            confirm_message = 'Are you sure you want to Reject this Test?';
            break;
        case 'acc':
            confirm_message = 'Are you sure you want to accept this Test?';
            break;
        case 'com':
            confirm_message = 'Do you complete the Test ?';
            break;
        default:
            // If an unknown action is provided, exit
            return;
    }
    
    let confirm_result = confirm(confirm_message);
    
    if (confirm_result) {
        window.location.href = "analyst_tests.php?action=" + action + "&id=" + id;
    }
    }
</script>
        <!-- End Content -->


    </div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>