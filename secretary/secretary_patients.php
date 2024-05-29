
<?php
require_once 'check_secretary_login.php'; 
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
        header("Location: secretary_patients.php");
        exit();
    } else {
        die(mysqli_error($conn));
    }
}
?>

<div class="dashboard">
    <div class="row">

        <?php require_once 'secretary_menu.php'; ?>

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
                                        <a href="secretary_add_patient.php" title="Add New Patient" class="add"><i class="fa-solid fa-user-plus"></i></a>
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
                                                <button title="Delete Account" onclick="confirme_delete('.$id.')" class="delete">
                                                <i class="far fa-trash-alt"></i> Delete
                                                </button>

                                                <button class="edit"><a href="secretary_update_pat.php?updateid='.$id.'">
                                                <i class="fa-solid fa-pen-to-square"></i> Update</a>
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

<script>
    function confirme_delete(id){
        let del = confirm('Do you want to delete user');
        
        if(del == true){
        window.location.href="secretary_patients.php?action=del&&id="+id;
        }
    }
</script>
        </div>
        <!-- End Content -->
    </div>
</div>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>