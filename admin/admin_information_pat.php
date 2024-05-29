<?php 
    require_once 'check_admin_login.php'; 
    $pageTitle = "Patient Info";
    require_once 'header.php'; 
?>

<?php 
$id = $_GET['infoid'];

$sql_patien = "SELECT * FROM `patients` WHERE patientid=$id";
$res_patien = mysqli_query($conn,$sql_patien);

$patien = mysqli_fetch_assoc($res_patien);
    $id = $patien['patientid'];
    $firstName = $patien['firstname'];
    $lastName = $patien['lastname'];
    $email = $patien['email'];
    $mobile = $patien['mobile'];
    $password = $patien['password'];

?>

    <div class="container">
        <div class="add-box">
            <div class="head">
                <h3>Information</h3>
                <a href="admin_patients.php"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
            <form method="post">
            <div class="fild">
                    <label class="label">First Name</label>
                    <input type="text" class="input" required placeholder="enter your First Name" name="firstname" autocomplete="off"  readonly value=<?php echo $firstName ?>>
                </div>
                <div class="fild">
                    <label class="label">Last Name</label>
                    <input type="text" class="input" required placeholder="enter your Last Name" name="lastname" autocomplete="off" readonly value=<?php echo $lastName ?>>
                </div>
                <div class="fild">
                    <label class="label">Birthdate</label>
                    <input type="text" class="input" required placeholder="enter your Last Name" name="birthdate" autocomplete="off" readonly value=<?php echo $patien['birthdate'] ?>>
                </div>
                <div class="fild">
                    <label class="label">Blood Group</label>
                    <input type="text" class="input" required placeholder="enter your Last Name" name="bloodgroup" autocomplete="off" readonly value=<?php echo $patien['bloodgroup'] ?>>
                </div>
                <div class="fild">
                    <label class="label">Gender</label>
                    <input type="text" class="input" required placeholder="enter your Last Name" name="gender" autocomplete="off" readonly value=<?php echo $patien['gender'] ?>>
                </div>
                <div class="fild">
                    <label class="label">Address</label>
                    <input type="text" class="input" required placeholder="enter your Last Name" name="address" autocomplete="off" readonly value=<?php echo $patien['address'] ?>>
                </div>

                <div class="fild">
                    <label class="label">Email</label>
                    <input type="email" class="input" required placeholder="enter your email" name="email" autocomplete="off" readonly value=<?php echo $email ?> >
                </div>
                <div class="fild">
                    <label class="label">mobile</label>
                    <input type="tel" class="input" required placeholder="enter your phone number" name="mobile" autocomplete="off" readonly value=<?php echo $mobile ?>>
                </div>
                <div class="fild">
                    <label class="label">Password</label>
                    <input type="password" class="input" required placeholder="enter your password" name="password" autocomplete="off" readonly value=<?php echo $password ?>>
                </div>
            </form>
        </div>
    </div>
    
  <!-- Footer -->
  <?php require_once 'footer.php'; ?>