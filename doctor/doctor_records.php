<?php
    require_once 'check_doctor_login.php';
    $pageTitle = "Patients Recoreds";
    require_once 'header.php'; 
?>

<?php 

// Check if action is 'del' and doctorid is provided
if(isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['recordid'])) {
    $recordid = $_GET['recordid'];

    // Start a transaction
    $conn->autocommit(false);

    // Delete related records from prescriptions table
    $sql_prescriptions = "DELETE FROM prescriptions WHERE recordid = $recordid";
    $conn->query($sql_prescriptions);

    // Delete related records from tests table
    $sql_tests = "DELETE FROM tests WHERE recordid = '$recordid'";
    $conn->query($sql_tests);

    // Delete related records from medicalrecords table
    $sql_medicalrecords = "DELETE FROM medicalrecords WHERE recordid = $recordid";
    $res_delete = mysqli_query($conn, $sql_medicalrecords );

    // Commit the transaction
    $conn->commit();

    // Check if deletion was successful
    if($res_delete) {
        header("Location: doctor_records.php");
        exit();
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

        <div class="col-lg-10 ">
            <section id="content">
                <!-- Main -->
                <main>
                    <div class="container">
                        <div class="head-title">
                            <h1>Medical Records</h1>
                        </div>
                        

                        <div class="all-list list box">
                            <div class="box-head head">
                                <h3>Medical Records List</h3>
                                <form action="" method="get">
                                    <input type="date" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : $current_date ?>">
                                    <button type="submit" class="filter">Filter</button>
                                    <button class="reset"><a href="doctor_records.php">Reset</a></button>
                                </form>
                            </div>

                            <?php 
                                $sql_status = "SELECT * FROM `medicalrecords`";
                                $result_status = mysqli_query($conn, $sql_status);
                                $numRows = mysqli_num_rows($result_status);

                                if ($numRows) {
                                    if (isset($_GET['date'])) {
                                        $date = $_GET['date'];
                                        $sql_app = "SELECT * FROM `medicalrecords` WHERE recorddate='$date' AND doctorid='{$_SESSION['doctorid']}' ORDER BY doctorid";
                                    } else {
                                        $sql_app = "SELECT * FROM `medicalrecords` WHERE doctorid='{$_SESSION['doctorid']}' ORDER BY recorddate";
                                    }

                                    $result_app = mysqli_query($conn, $sql_app);
                                    $recordnumRows = mysqli_num_rows($result_app);

                                    if ($recordnumRows) {
                                        echo '
                                            <table>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Patient</th>
                                                    <th class="actionbtn">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        ';

                                        while ($user = mysqli_fetch_assoc($result_app)) {
                                            $recordid = $user['recordid'];
                                            $patientid = $user['patientid'];
                                            $recorddate = $user['recorddate'];
                                            $description = $user['description'];
                                            $sql_doc = "SELECT * FROM `patients` WHERE patientid='$patientid'";
                                            $result_doc = mysqli_query($conn, $sql_doc);
                                            if ($result_doc) {
                                                while ($doc = mysqli_fetch_assoc($result_doc)) {
                                                    $fullname = $doc['firstname'] . ' ' . $doc['lastname'];

                                                    echo '
                                                        <tr>
                                                            <td>'.$recordid.'</td>
                                                            <td>'.$recorddate.'</td>
                                                            <td>'.$description.'</td>
                                                            <td>'.$fullname.'<br/>
                                                            <td>

                                                            <!-- View button -->
                                                            <button class="view" title="View Medical Record">
                                                            <a href="doctor_record_view.php?recordid=' . $recordid . '"
                                                            <i class="far fa-eye"></i> View
                                                            </a>
                                                            </button>

                                                            <!-- Edit button -->
                                                            <button class="edit" title="Edit Medical Record">
                                                            <a href="doctor_record_create.php?recordid=' . $recordid . '"
                                                            <i class="far fa-edit"></i> Edit
                                                            </a>
                                                            </button>

                                                            <!-- Delete button -->
                                                            <button onclick="confirm_action(' . $recordid . ')" class="delete" title="Delete">
                                                                <i class="far fa-trash-alt"></i> Delete
                                                            </button>
                                                        ';
                                                
                                                        

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
                                        echo 'There are no medical records on this date';
                                    }
                                } else {
                                    echo 'There are no medical records';
                                }

                                // Close connection
                                $conn->close();
                            ?>

                        </div>
                    </div>

                </main>
            </section>

        </div>

    </div>
</div>
<script>
    function confirm_action(recordid){
    let del = confirm('Do you want to delete this Medical Record');
    
    if(del == true){
      window.location.href="doctor_records.php?action=del&&recordid="+recordid;
    }
  }
  </script>


<!-- Footer -->
<?php require_once 'footer.php'; ?>

