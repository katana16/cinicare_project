<?php
    require_once 'check_doctor_login.php';
    $pageTitle = "Edit Medical Record";
    require_once 'header.php'; 

    $recordid = $_GET['recordid'];
    $med_msg = $test_msg = $diag_msg = $tret_msg = $tret_update = $tret_delete = $test_delete = '';
//-------------------------------------------------------------------------------------- Update Part
    // Handle Medical Report Form Submission
    if (isset($_POST["submit_report"])) {
        $description = $_POST['description'];
        $medicalHistory = $_POST['medicalHistory'];
        // Assuming recordid is passed through the URL

        $sql = "UPDATE medicalrecords SET observation='$medicalHistory', description='$description' WHERE recordid='$recordid'";

        if ($conn->query($sql) === TRUE) {
            $med_msg = 'Medical report updated successfully';
        } else {
            $med_msg = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Handle Diagnosis Form Submission
    if (isset($_POST["submit_diagnosis"])) {
        $diagnosis = $_POST['diagnosis'];

        $sql = "UPDATE medicalrecords SET diagnosis='$diagnosis' WHERE recordid='$recordid'";

        if ($conn->query($sql) === TRUE) {
            $diag_msg = 'Diagnosis updated successfully';
        } else {
            $diag_msg = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Create New Prescription Form
    if (isset($_POST["submit_treatment"])) {
        $title = $_POST['title'];
        $instructions = $_POST['instructions'];
        $recordid = $_GET["recordid"]; // Assuming recordid is passed through the URL

        $sql = "INSERT INTO prescriptions (recordid, prescriptionname, prescriptiondate, instructions)
                VALUES ('$recordid', '$title', CURDATE(), '$instructions')";

        if ($conn->query($sql) === TRUE) {
            $tret_msg = 'Treatment submitted successfully';
        } else {
            $tret_msg = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // Update Prescription Form
    if (isset($_POST["update_treatment"])) {
        $prescriptionid = $_GET['prescriptionid'];
        $title = $_POST['title'];
        $instructions = $_POST['instructions'];

        $sql = "UPDATE prescriptions SET prescriptionname='$title', prescriptiondate=CURDATE(), instructions='$instructions' WHERE prescriptionid='$prescriptionid'";

        if ($conn->query($sql) === TRUE) {
            $tret_update = 'Treatment submitted successfully';
        } else {
            $tret_update = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // Delete Prescription
    if (isset($_POST["delete_treatment"])) {
        $prescriptionid = $_GET['prescriptionid'];
        $sql = "DELETE FROM prescriptions WHERE prescriptionid='$prescriptionid'";
        if ($conn->query($sql) === TRUE) {
            $tret_delete = 'Treatment deleted successfully';
        } else {
            $tret_delete = "Error: " . $sql . "<br>" . $conn->error;
        }

    }

    // Request Test Form
    if (isset($_POST["send_test"])) {
        $analystid = $_POST['analyst'];
        $priority = $_POST['priority'];
        $testtype = $_POST['testtype'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO tests (recordid, analystid, requestdate, status, testtype, priority, comment)
                VALUES ('$recordid', '$analystid', CURDATE(), 'Pending', '$testtype','$priority','$comment')";

        if ($conn->query($sql) === TRUE) {
            $test_msg = 'Test submitted successfully';
        } else {
            $test_msg = "Error: " . $sql . "<br>" . $conn->error;
        }

    }
    // Delete Test Request
    if (isset($_POST["delete_test"])) {
        $testid = $_POST['testid'];

        $sql = "DELETE FROM tests WHERE testid='$testid'";

        if ($conn->query($sql) === TRUE) {
            $test_delete = 'Treatment deleted successfully';
        } else {
            $test_delete = "Error: " . $sql . "<br>" . $conn->error;
        }

    }


//------------------------------------------------------------------------------------ Fetch Part
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

?>

        <!-- Content -->
<div class="container-fluid content-wrapper">
    <div class="container">
        <div class="go-back-btn">
            <button onclick="window.location.href = 'doctor_records.php';" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</button>
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
                    <h5 class="card-title"><strong>Medical Report:</strong></h5>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="<?php echo  $description; ?>" placeholder="Enter description">
                        </div>
                        <div class="mb-3">
                            <label for="medicalHistory" class="form-label">Medical History</label>
                            <textarea class="form-control" id="medicalHistory" name="medicalHistory" rows="20" placeholder="Enter medical history"><?php echo $observation; ?></textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('medicalHistory', {
                                height: 400 // Set the height to 800 pixels
                            });
                        </script>
                        <div class="d-flex align-items-center">
                            <button type="submit" name="submit_report" class="btn btn-success">Save</button>
                            <p class="ms-2"><?php echo $med_msg; ?></p>
                        </div>
                    </form>
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
                                        echo '<p>No Result Yet</p>';
                                ?>
                                    <form class="test-form" method="post" action="">
                                    <button type="submit" name="delete_test" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Test Request?')">Delete</button>
                                    <input type="hidden" name="testid" value="<?php echo $tst['testid']; ?>">
                                    </form>
                                <?php
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
                    <button class="btn btn-secondary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#requestTestForm" aria-expanded="false" aria-controls="requestTestForm">
                        Request Test
                    </button>
                    <div class="collapse mt-3" id="requestTestForm">
                        <form action="" method="POST">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="analyst" class="form-label">Select Speciality</label>
                                    <select id="analyst" class="form-select" name="analyst">
                                        <option selected>Choose...</option>
                                        <?php
                                            $sql_analyst = "SELECT * FROM analysts ORDER BY speciality";
                                            $result_analyst = $conn->query($sql_analyst);
                                            // Check if there are any prescription records
                                            if ($result_analyst->num_rows > 0) {
                                                while ($analyst = $result_analyst->fetch_assoc()) {

                                        ?>

                                                <option value="<?php echo $analyst['analystid']; ?>">Dr. <?php echo $analyst['firstname'] . ' ' . $analyst['lastname']; ?>  (<?php echo $analyst['speciality']; ?>)</option>

                                        <?php
                                                }
                                            } else {
                                                echo "<p style='text-align:center;margin-bottom:20px;'>There are no Test for this record.</p>";
                                            }
                                        ?>
                                    </select>
                                </div>


                                <div class="col-md-4">
                                    <label for="priority" class="form-label">Select Priority</label>
                                    <select id="priority" class="form-select" name="priority">
                                        <option selected>Choose...</option>
                                        <option value="High">High</option>
                                        <option value="High">Medium</option>
                                        <option value="High">Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="testtype" class="form-label">Input Test Type</label>
                                <input type="text" name="testtype" class="form-control" id="testtype" placeholder="Enter test type">
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Text area for instruction or comment</label>
                                <textarea class="form-control" name="comment" id="comment" rows="5" placeholder="Enter your comment here"></textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" name="send_test" class="btn btn-success">Send</button>
                                <p class="ms-2"><?php echo $test_msg; ?></p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>




            <div class="card">
                <div class="all-body card-body">
                    <h5 class="card-title"><strong>Diagnosis:</strong></h5>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="5" placeholder="Enter diagnosis"><?php echo $diagnosis; ?></textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('diagnosis', {
                                height: 200 // Set the height to 800 pixels
                            });
                        </script>
                        <div class="d-flex align-items-center">
                            <button type="submit" name="submit_diagnosis" class="btn btn-success">Save</button>
                            <p class="ms-2"><?php echo $diag_msg; ?></p>
                        </div>
                    </form>
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
                            $prescriptionname = $prs['prescriptionname'];
                            $instructions = $prs['instructions'];
                    ?>
                        <div class="card mt-4">
                            <div class="card-header d-flex justify-content-between">
                                <div>Prescription: <?php echo $prescriptionid; ?></div>
                                <div class="text-right">Date: <?php echo $prescriptiondate; ?></div>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?recordid=<?php echo $recordid; ?>&prescriptionid=<?php echo $prescriptionid; ?>" method="POST">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo  $prescriptionname; ?>" placeholder="Enter title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="instructions" class="form-label">Instructions</label>
                                        <textarea class="form-control instructions" id="instructions" name="instructions" rows="3" placeholder="Enter instructions"><?php echo $instructions; ?></textarea>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" name="update_treatment" class="btn btn-success">Update</button>
                                        <button type="submit" name="delete_treatment" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Prescription?')">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                        }
                        } else {
                        echo "<p style='text-align:center;margin-bottom:20px;'>There are no prescriptions for this record.</p>";
                        }
                    ?>


                    <button class="btn btn-secondary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#createPrescription" aria-expanded="false" aria-controls="requestTestForm">
                    Create New Prescription
                    </button>
                    <div class="collapse mt-3" id="createPrescription">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                            </div>
                            <div class="mb-3">
                                <label for="instructions" class="form-label">Instructions</label>
                                <textarea class="form-control instructions" id="instructions" name="instructions" rows="5" placeholder="Enter instructions"></textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <button type="submit" name="submit_treatment" class="btn btn-success">Save</button>
                                <p class="ms-2"><?php echo $tret_msg; ?></p>
                            </div>
                        </form>
                    </div>
                    <script>
                        // JavaScript
                        document.addEventListener("DOMContentLoaded", function() {
                            // Get all elements with the class 'ckeditor-textarea'
                            var textareas = document.querySelectorAll('.instructions');

                            // Loop through each textarea and initialize CKEditor
                            textareas.forEach(function(textarea) {
                                CKEDITOR.replace(textarea, {
                                    height: 200 // Set the height to 200 pixels (adjust as needed)
                                });
                            });
                        });
                    </script>
                </div>
            </div>


        </div>
    </div>
</div>


<!-- Footer -->
<?php require_once 'footer.php'; ?>