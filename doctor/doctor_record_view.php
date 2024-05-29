<?php
    require_once 'check_doctor_login.php';
    $pageTitle = "View Medical Record";
    require_once 'header.php'; 

    $recordid = $_GET['recordid'];
    $sql_rec = "SELECT * FROM medicalrecords WHERE recordid='$recordid'";
    $result_rec = $conn->query($sql_rec);
    $rec = $result_rec->fetch_assoc();
    $patientid = $rec["patientid"];
    $doctorid = $rec["doctorid"];
    $recorddate = $rec["recorddate"];
    $description = $rec["description"];
    $observation = $rec["observation"];
    $diagnosis = $rec["diagnosis"];


    $sql_pat = "SELECT * FROM patients WHERE patientid='$patientid'";
    $result_pat = $conn->query($sql_pat);
    $pat = $result_pat->fetch_assoc();
    $fullname_pat = $pat['firstname'] . ' ' . $pat['lastname'];
    $birthdate = $pat['birthdate'];
        $birthdate = $pat['birthdate'];
        $birthday = new DateTime($birthdate);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthday)->y;
    $gender = $pat['gender'];
    $bloodgroup = $pat['bloodgroup'];
    $address = $pat['address'];
    $mobile = $pat['mobile'];


    $sql_doc = "SELECT * FROM doctors WHERE doctorid='$doctorid'";
    $result_doc = $conn->query($sql_doc);
    $doc = $result_doc->fetch_assoc();
    $fullname_doc = $doc['firstname'] . ' ' . $doc['lastname'];
    $speciality = $doc['speciality'];


    $sql_prs = "SELECT * FROM prescriptions WHERE recordid='$recordid'";
    $result_prs = $conn->query($sql_prs);
    if ($result_prs->num_rows > 0) {
        while ($prs  = $result_prs->fetch_assoc()) {
            $instructions = $prs['instructions'];
        }
    } else {
        $instructions = "There are no prescriptions.";
    }
?>



        <!-- Content -->
<div class="container-fluid content-wrapper">
    <div class="container">
        <div class="go-back-btn">
            <button onclick="goBack()" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</button>
        </div>
        <div class="record-content">
            <h1 class="text-center"><strong>Medical Record</strong></h1>


            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="all-body card-body">
                            <h5 class="card-title"> <strong>Patient Info:</strong></h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Name:</strong> <?php echo $fullname_pat; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Age:</strong> <?php echo $age; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Gender:</strong> <?php echo $gender; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Address:</strong> <?php echo $address; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Phone:</strong> <?php echo $mobile; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="all-body card-body">
                            <h5 class="card-title"><strong>File info:</strong></h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>File N:</strong> <?php echo $recordid; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Created by:</strong> Dr. <?php echo $fullname_doc; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Speciality:</strong> <?php echo $speciality; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Date:</strong> <?php echo $recorddate; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>


            <div class="card">
                <div class="all-body card-body">
                <h5 class="card-title"><strong>Description:</strong></h5>
                <p class="card-text"><?php echo $rec["description"]; ?></p>
                </div>
            </div>

            <div class="card">
                <div class="all-body card-body">
                <h5 class="card-title"><strong>Medical Report:</strong></h5>
                <div class="card-text"><?php echo $observation; ?></div>
                </div>
            </div>




            <div class="card">
                <div class="all-body card-body">
                    <h5 class="card-title"><strong>Tests:</strong></h5>
                    <?php
                        $sql_tst = "SELECT * FROM tests WHERE recordid='$recordid'";
                        $result_tst = $conn->query($sql_tst);
                        // Check if there are any prescription records
                        if ($result_tst->num_rows > 0) {
                            while ($tst = $result_tst->fetch_assoc()) {
                                $results = $tst['results'];
                                $analystid = $tst['analystid'];

                                $sql_analyst = "SELECT * FROM analysts WHERE analystid='$analystid'";
                                $result_analyst = $conn->query($sql_analyst);
                                $analyst = $result_analyst->fetch_assoc();
                                $fullname = $analyst['firstname'] . ' ' . $analyst['lastname'];
                                $speciality_analyst = $analyst['speciality'];
                    ?>


                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between">
                            <span>Type: <?php echo $tst['testtype']; ?></span>
                            <span>Result Date: <?php echo $tst['resultdate']; ?></span>
                        </div>
                        <div class="card-body">
                            <div class="text-right">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Request Date:</strong> <?php echo $tst['requestdate']; ?></p>
                                        <p><strong>Status:</strong> <?php echo $tst['status']; ?></p>
                                        <p><strong>Priority:</strong> <?php echo $tst['priority']; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Analyst:</strong> <?php echo $fullname; ?></p>
                                        <p><strong>Speciality:</strong> <?php echo $speciality_analyst; ?></p>
                                    </div>
                                </div>
                                <br/>
                                <p><strong>Comment:</strong> <?php echo $tst['comment']; ?></p>
                                <p><strong>Results:</strong></p>
                                <?php 
                                    if ($results == '') {
                                        echo 'No Result Yet';
                                    } else {
                                        echo $results;
                                    }
                                ?>
                            </div> 
                        </div>
                    </div>

                    <?php
                            }
                        } else {
                            echo "<p style='text-align:center;margin-bottom:20px;'>There are no Test for this record.</p>";
                        }
                    ?>
                    
                </div>
            </div>








            <div class="card">
                <div class="all-body card-body">
                <h5 class="card-title"><strong>Diagnosis:</strong></h5>
                <div class="card-text"><?php echo $diagnosis; ?></div>
                </div>
            </div>

            <div class="card">
                <div class="all-body card-body">
                    <h5 class="card-title"><strong>Treatment:</strong></h5>
                    <?php
                        $sql_prs = "SELECT * FROM prescriptions WHERE recordid='$recordid'";
                        $result_prs = $conn->query($sql_prs);

                        // Check if there are any prescription records
                        if ($result_prs->num_rows > 0) {
                        while ($prs = $result_prs->fetch_assoc()) {
                            $prescriptionid  = $prs['prescriptionid'];
                            $prescriptiondate = $prs['prescriptiondate'];
                            $instructions = $prs['instructions'];
                    ?>
                        <div class="card mt-4">
                            <div class="card-header d-flex justify-content-between">
                                <div>Prescription: <?php echo $prescriptionid; ?></div>
                                <div class="text-right">Date: <?php echo $prescriptiondate; ?></div>
                            </div>
                            <div class="card-body">
                                <div class="card-text"><?php echo $instructions; ?></div>
                            </div>
                        </div>
                    <?php
                        }
                        } else {
                        echo "<p>There are no prescriptions for this record.</p>";
                        }
                    ?>
                </div>
            </div>


        </div>
    </div>
</div>


  <script>
    function goBack() {
      window.history.back();
    }
  </script>

<!-- Footer -->
<?php require_once 'footer.php'; ?>