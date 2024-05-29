
<?php
require_once 'check_admin_login.php'; 
$pageTitle = "Patients List";
require_once 'header.php'; 

// Check if action is 'del' and patientid is provided
if(isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Start a transaction
    $conn->autocommit(false);

    // Delete related records from prescriptions table
    $sql_prescriptions = "DELETE FROM prescriptions WHERE recordid IN (SELECT recordid FROM medicalrecords WHERE patientid = $id)";
    $conn->query($sql_prescriptions);

    // Delete related records from tests table
    $sql_tests = "DELETE FROM tests WHERE recordid IN (SELECT recordid FROM medicalrecords WHERE patientid = $id)";
    $conn->query($sql_tests);

    // Delete related records from medicalrecords table
    $sql_medicalrecords = "DELETE FROM medicalrecords WHERE patientid = $id";
    $conn->query($sql_medicalrecords);

    // Delete related records from appointments table
    $sql_appointments = "DELETE FROM appointments WHERE patientid = $id";
    $conn->query($sql_appointments);

    // Delete the patient record from patients table
    $sql_patient = "DELETE FROM patients WHERE patientid = $id";
    $res_delete = mysqli_query($conn, $sql_patient);

    // Commit the transaction
    $conn->commit();

    // Check if deletion was successful
    if($res_delete) {
        header("Location: admin_patients.php");
        exit();
    } else {
        die(mysqli_error($conn));
    }
}
?>

<div class="dashboard">
    <div class="row">

        <?php require_once 'admin_menu.php'; ?>

        <!-- Content -->
        <div class="col-lg-10 ">
            <section id="content">
                <!-- Main -->
                <main>
                    <div class="container">
                        <div class="head-title">
                            <h1>Our Patiens</h1>
                        </div>

                        <div class="all-list patiens-list">
                            <div class="list">
                                <div class="head">
                                    <h3>Patiens</h3>
                                    <a href="admin_add_patient.php" title="Add Secretary" class="add"><i class="fa-solid fa-user-plus"></i></a>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php   
                                        $sql_read = "SELECT * FROM `patients`";
                                        $res_read = mysqli_query($conn,$sql_read);
                                        if($res_read){
                                        while($patien = mysqli_fetch_assoc($res_read)){
                                            $id = $patien['patientid'];
                                            $fullname = $patien['firstname'] . ' ' . $patien['lastname'];

                                        echo '
                                        <tr>
                                            <td>'.$id.'</td>
                                            <td>'.$fullname.'</td>
                                            <td>
                                            
                                                <button class="edit"><a href="admin_update_pat.php?updateid='.$id.'">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                </button>

                                                <button title="Delete Account" onclick="confirme_delete('.$id.')" class="delete">
                                                <i class="fa-regular fa-trash-can"></i> Delete
                                                </button>
                                                
                                                <button title="Account Info" class="info"><a href="admin_information_pat.php?infoid='.$id.'">
                                                <i class="fa-regular fa-circle-user"></i> Info</a>
                                                </button>
                                            </td>
                                        </tr>
                                        
                                        ';
                                    }
                                }

                                // Close connection
                                $conn->close();
                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- End Main -->
            </section>
            <script src="assets/js/alert_pat.js"></script>
        </div>
        <!-- End Content -->
    </div>
</div>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>