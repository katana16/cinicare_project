<?php 
require_once 'check_admin_login.php'; 
$pageTitle = "Doctors List";
require_once 'header.php'; 

// Check if action is 'del' and doctorid is provided
if(isset($_GET['action']) && $_GET['action'] == 'del' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Start a transaction
    $conn->autocommit(false);

    // Delete related records from prescriptions table
    $sql_prescriptions = "DELETE FROM prescriptions WHERE recordid IN (SELECT recordid FROM medicalrecords WHERE doctorid = $id)";
    $conn->query($sql_prescriptions);

    // Delete related records from tests table
    $sql_tests = "DELETE FROM tests WHERE recordid IN (SELECT recordid FROM medicalrecords WHERE doctorid = $id)";
    $conn->query($sql_tests);

    // Delete related records from medicalrecords table
    $sql_medicalrecords = "DELETE FROM medicalrecords WHERE doctorid = $id";
    $conn->query($sql_medicalrecords);

    // Delete related records from appointments table
    $sql_appointments = "DELETE FROM appointments WHERE doctorid = $id";
    $conn->query($sql_appointments);

    // Delete the doctor record from doctors table
    $sql_doctor = "DELETE FROM doctors WHERE doctorid = $id";
    $res_delete = mysqli_query($conn, $sql_doctor);

    // Commit the transaction
    $conn->commit();

    // Check if deletion was successful
    if($res_delete) {
        header("Location: admin_doctors.php");
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
                            <h1>Our Doctors</h1>
                        </div>

                        <div class="all-list doctors-list">
                            <div class="list">
                                <div class="head">
                                    <h3>Doctors</h3>
                                        <a href="admin_add_doc.php" title="Add Doctor" class="add"><i class="fa-solid fa-user-plus"></i></a>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Speciality</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php   
                                $sql_read = "SELECT * FROM `doctors`";
                                $res_read = mysqli_query($conn,$sql_read);
                                if($res_read){
                                    while($doctor = mysqli_fetch_assoc($res_read)){
                                        $id = $doctor['doctorid'];
                                        $name = $doctor['firstname'] . ' ' . $doctor['lastname'];
                                        $speciality = $doctor['speciality'];

                                        echo '
                                        <tr>
                                            <td>'.$id.'</td>
                                            <td>'.$name.'</td>
                                            <td>'.$speciality.'</td>
                                            <td>
                                                <button title="Update Account" class="edit"><a href="admin_update_doc.php?updateid='.$id.'">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                </button>
                                                <button title="Delete Account" onclick="confirme_delete('.$id.')" class="delete">
                                                <i class="fa-regular fa-trash-can"></i> Delete
                                                </button>
                                                <button title="Account Info" class="info"><a href="admin_information_doc.php?infoid='.$id.'">
                                                <i class="fa-regular fa-circle-user"></i> Info</a>
                                                </button>
                                            </td>
                                        </tr>
                                        
                                        ';
                                    }
                                }
                                ?>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- End Main -->
            </section>
        </div>
        <script src="assets/js/alert_doc.js"></script>
        <!-- End Content -->

    </div>
</div>

  <!-- Footer -->
  <?php require_once 'footer.php'; ?>