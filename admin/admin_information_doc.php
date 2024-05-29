<?php 
    require_once 'check_admin_login.php'; 
    $pageTitle = "Doctor info";
    require_once 'header.php'; 
?>

<?php 


$id = $_GET['infoid'];
$name = "";
$sql_doctor = "SELECT * FROM `doctors` WHERE doctorid=$id";
$res_doctor = mysqli_query($conn,$sql_doctor);

$doctor = mysqli_fetch_assoc($res_doctor);
    $id = $doctor['doctorid'];
    $name = $doctor['firstname'] . ' ' . $doctor['lastname'];
    $speciality = $doctor['speciality'];
    $birthdate = $doctor['birthdate'];
    $startDate = $doctor['startdate'];
    $email = $doctor['email'];
    $mobile = $doctor['mobile'];
    $password = $doctor['password'];

?>



    <div class="container">
        <div class="add-box">
            <div class="head">
                <h3>Information</h3>
                <a href="admin_doctors.php"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
            <form method="post">
            <div class="fild">
                    <label class="label">Name</label>
                    <input type="text" class="input" required placeholder="enter your name" name="name" autocomplete="off"  readonly value="<?php echo $name; ?>">
                </div>
                <div class="fild">
                    <label class="label">Speciality</label>
                    <input type="text" class="input" required placeholder="enter your email" name="speciality" autocomplete="off" readonly value="<?php echo $speciality ?>">
                </div>
                <div class="fild">
                    <label class="label">Start Date</label>
                    <input type="date" class="input" required placeholder="enter your email" name="startDate" autocomplete="off" readonly value="<?php echo $startDate ?>">
                </div>
                <div class="fild">
                    <label class="label">Birthdate</label>
                    <input type="date" class="input" required placeholder="enter your email" name="birthdate" autocomplete="off readonly"value="<?php echo $birthdate ?>">
                </div>
                <div class="fild">
                    <label class="label">Email</label>
                    <input type="email" class="input" required placeholder="enter your email" name="email" autocomplete="off" readonly value="<?php echo $email ?>" >
                </div>
                <div class="fild">
                    <label class="label">Mobile</label>
                    <input type="tel" class="input" required placeholder="enter your phone number" name="mobile" autocomplete="off" readonly value="<?php echo $mobile ?>">
                </div>
                <div class="fild">
                    <label class="label">Password</label>
                    <input type="password" class="input" required placeholder="enter your password" name="password" autocomplete="off" readonly value="<?php echo $password ?>">
                </div>
            </form>
        </div>
    </div>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>