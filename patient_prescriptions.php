<?php
    require_once 'check_patient_login.php';
    $pageTitle = "Prescriptions";
    require_once 'header.php'; 
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
                            <h1>Prescriptions</h1>
                        </div>
                        

                        <div class="all-list list box">
                            <div class="box-head head">
                                <h3>Prescriptions List</h3>
                                <form action="" method="get">
                                    <input type="date" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : $current_date ?>">
                                    <button type="submit" class="filter">Filter</button>
                                    <button class="reset"><a href="patient_prescriptions.php">Reset</a></button>
                                </form>
                            </div>

                            <?php 
                                $sql_status = "SELECT * FROM `prescriptions`";
                                $result_status = mysqli_query($conn, $sql_status);
                                $numRows = mysqli_num_rows($result_status);

                                if ($numRows) {
                                    if (isset($_GET['date'])) {
                                        $date = $_GET['date'];
                                        $sql_app = "SELECT * 
                                                    FROM prescriptions 
                                                    INNER JOIN medicalrecords ON prescriptions.recordid = medicalrecords.recordid 
                                                    WHERE prescriptions.prescriptiondate = '$date' AND medicalrecords.patientid = '{$_SESSION['patientid']}'";

                                    } else {
                                        $sql_app = "SELECT * 
                                                    FROM prescriptions 
                                                    INNER JOIN medicalrecords ON prescriptions.recordid = medicalrecords.recordid 
                                                    WHERE medicalrecords.patientid = '{$_SESSION['patientid']}' ORDER BY prescriptiondate";
                                    }

                                    $result_app = mysqli_query($conn, $sql_app);
                                    $presnumRows = mysqli_num_rows($result_app);

                                    if ($presnumRows) {
                                        echo '
                                            <table>
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Name</th>
                                                    <th>Created By</th>
                                                    <th class="actionbtn">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        ';

                                        while ($user = mysqli_fetch_assoc($result_app)) {
                                            $prescriptionid = $user['prescriptionid'];
                                            $doctorid = $user['doctorid'];
                                            $prescriptiondate = $user['prescriptiondate'];
                                            $prescriptionname = $user['prescriptionname'];

                                            $sql_doc = "SELECT * FROM `doctors` WHERE doctorid='$doctorid'";
                                            $result_doc = mysqli_query($conn, $sql_doc);
                                            if ($result_doc) {
                                                while ($doc = mysqli_fetch_assoc($result_doc)) {
                                                    $fullname = $doc['firstname'] . ' ' . $doc['lastname'];
                                                    $speciality = $doc['speciality'];

                                                    echo '
                                                        <tr>
                                                            <td>'.$prescriptionid.'</td>
                                                            <td>'.$prescriptiondate.'</td>
                                                            <td>'.$prescriptionname.'</td>
                                                            <td>Dr. '.$fullname.'<br/>
                                                            <span>'.$speciality.'<span></td>
                                                            <td>

                                                            <!-- Cancel button -->
                                                            <button class="view" title="View Medical Record">
                                                            <a href="patient_prescription_view.php?prescriptionid=' . $prescriptionid . ';"
                                                            <i class="far fa-eye"></i> View
                                                            </a>
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
                                        echo 'There are no prescriptions on this date';
                                    }
                                } else {
                                    echo 'There are no prescriptions';
                                }

                                // Close connection
                                $conn->close();
                            ?>

                        </div>
                    </div>

                </main>
            </section>
        </div>

        <!-- End Content -->

</div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>