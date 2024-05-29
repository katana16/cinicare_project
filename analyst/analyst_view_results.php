<?php
    require_once 'check_analyst_login.php';
    $pageTitle = "Test Results";
    require_once 'header.php'; 

    $testid = $_GET['testid'];
    $med_msg = $test_msg = $diag_msg = $tret_msg = $tret_update = $tret_delete = $test_delete = $result_msg = '';
//-------------------------------------------------------------------------------------- Update Part

    // Handle Results Form Submission
    if (isset($_POST["submit_results"])) {
        $results = $_POST['results'];

        $sql = "UPDATE tests SET results='$results', resultdate=CURDATE() WHERE testid='$testid'";

        if ($conn->query($sql) === TRUE) {
            $result_msg = 'Results submited successfully';
        } else {
            $result_msg = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

//------------------------------------------------------------------------------------ Fetch Part

    $sql_tst = "SELECT * FROM tests WHERE testid='$testid'";
    $result_tst = $conn->query($sql_tst);
    $tst = $result_tst->fetch_assoc();
        $results = $tst['results'];
        $analystid = $tst['analystid'];
        $recordid = $tst['recordid'];


    $sql_rec = "SELECT * FROM medicalrecords WHERE recordid='$recordid'";
    $result_rec = $conn->query($sql_rec);
    $rec = $result_rec->fetch_assoc();
        $patientid = $rec["patientid"];
        $doctorid = $rec["doctorid"];
        $recorddate = $rec["recorddate"];
        $description = $rec["description"];
        $observation = $rec["observation"];
        $diagnosis = $rec["diagnosis"];

    $sql_doc = "SELECT * FROM analysts WHERE analystid='$analystid'";
    $result_doc = $conn->query($sql_doc);
    $doc = $result_doc->fetch_assoc();
        $fullname_analyst = $doc['firstname'] . ' ' . $doc['lastname'];
        $speciality_analyst = $doc['speciality'];

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

?>

        <!-- Content -->
<div class="container-fluid content-wrapper">
    <div class="container">
        <div class="go-back-btn">
            <button onclick="window.location.href = 'analyst_tests.php';" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</button>
        </div>
        <div class="record-content">
            <h1 class="text-center"><strong>Test Results</strong></h1>


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
                            <h5 class="card-title"><strong>Info:</strong></h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Test ID:</strong> <?php echo $testid; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Analyzed by:</strong> <?php echo $fullname_analyst; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Speciality:</strong> <?php echo $speciality_analyst; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Result Date:</strong> <?php echo $tst['requestdate']; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>







            <div class="card">
                <div class="all-body card-body">
                    <h5 class="card-title"><strong>Tests:</strong></h5>




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
                                        <p><strong>Requsted by:</strong> <?php echo $fullname_doc; ?></p>
                                        <p><strong>Speciality:</strong> <?php echo $speciality; ?></p>
                                    </div>
                                </div>
                                <br/>
                                <p><strong>Comment:</strong> <?php echo $tst['comment']; ?></p>
                                <p><strong>Results:</strong></p>
                                <?php
                                if ($results == '') {
                                        echo '<p>No Result Yet</p>';
                                    } else {
                                        echo $results;
                                    }
                                ?>
                            </div> 
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
</div>


<!-- Footer -->
<?php require_once 'footer.php'; ?>