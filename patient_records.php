<?php
    require_once 'check_patient_login.php';
    $pageTitle = "Medical Records";
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
                            <h1>Medical Records</h1>
                        </div>
                        

                        <div class="all-list list box">
                            <div class="box-head head">
                                <h3>Medical Records List</h3>
                                <form action="" method="get">
                                    <input type="date" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : $current_date ?>">
                                    <button type="submit" class="filter">Filter</button>
                                    <button class="reset"><a href="patient_records.php">Reset</a></button>
                                </form>
                            </div>

                            <?php 
                                $sql_status = "SELECT * FROM `medicalrecords`";
                                $result_status = mysqli_query($conn, $sql_status);
                                $numRows = mysqli_num_rows($result_status);

                                if ($numRows) {
                                    if (isset($_GET['date'])) {
                                        $date = $_GET['date'];
                                        $sql_app = "SELECT * FROM `medicalrecords` WHERE recorddate='$date' AND patientid='{$_SESSION['patientid']}'";
                                    } else {
                                        $sql_app = "SELECT * FROM `medicalrecords` WHERE patientid='{$_SESSION['patientid']}' ORDER BY recorddate";
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
                                                    <th>Created By</th>
                                                    <th class="actionbtn">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        ';

                                        while ($user = mysqli_fetch_assoc($result_app)) {
                                            $recordid = $user['recordid'];
                                            $doctorid = $user['doctorid'];
                                            $recorddate = $user['recorddate'];
                                            $description = $user['description'];
                                            $sql_doc = "SELECT * FROM `doctors` WHERE doctorid='$doctorid'";
                                            $result_doc = mysqli_query($conn, $sql_doc);
                                            if ($result_doc) {
                                                while ($doc = mysqli_fetch_assoc($result_doc)) {
                                                    $fullname = $doc['firstname'] . ' ' . $doc['lastname'];
                                                    $speciality = $doc['speciality'];

                                                    echo '
                                                        <tr>
                                                            <td>'.$recordid.'</td>
                                                            <td>'.$recorddate.'</td>
                                                            <td>'.$description.'</td>
                                                            <td>Dr. '.$fullname.'<br/>
                                                            <span>'.$speciality.'<span></td>
                                                            <td>

                                                            <!-- View button -->
                                                            <button class="view" title="View Medical Record">
                                                            <a href="patient_record_view.php?recordid=' . $recordid . '"
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

        <!-- End Content -->

</div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>