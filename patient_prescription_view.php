<?php
    require_once 'check_patient_login.php';
    $pageTitle = "View Medical Record";
    require_once 'header.php'; 

    $prescriptionid = $_GET['prescriptionid'];
    $sql_prs = "SELECT * FROM prescriptions WHERE prescriptionid='$prescriptionid'";
    $result_prs = $conn->query($sql_prs);
    $prs = $result_prs->fetch_assoc();
    $recordid = $prs["recordid"];
    $prescriptiondate = $prs['prescriptiondate'];
    $prescriptionname = $prs['prescriptionname'];
    $instructions = $prs['instructions'];

    $sql_rec = "SELECT * FROM medicalrecords WHERE recordid='$recordid'";
    $result_rec = $conn->query($sql_rec);
    $rec = $result_rec->fetch_assoc();
    $patientid = $rec["patientid"];
    $doctorid = $rec["doctorid"];

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
            <button onclick="goBack()" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</button>
        </div>
        <div class="record-content">
            <h1 class="text-center"><strong>Prescription</strong></h1>


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
                            <h5 class="card-title"><strong>Prescription info:</strong></h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>ID:</strong> <?php echo $prescriptionid; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Title:</strong> <?php echo $prescriptionname; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Created by:</strong> Dr. <?php echo $fullname_doc; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Speciality:</strong> <?php echo $speciality; ?>
                                </li>
                                <li class="list-group-item">
                                    <strong>Date:</strong> <?php echo $prescriptiondate; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card">
                <div class="all-body card-body">
                <h5 class="card-title"><strong>Instructions</strong></h5>
                <div class="card-text"><?php echo $instructions; ?></div>
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