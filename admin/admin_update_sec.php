<?php
    require_once 'check_admin_login.php';
    $pageTitle = "Update Secretary";
    require_once 'header.php'; 
  ?>

<?php 

$id = $_GET['updateid'];

// echo $id;
// die();
$sql_analyst = "SELECT * FROM `secretary` WHERE secretaryid=$id";
$res_analyst = mysqli_query($conn,$sql_analyst);

$analyst = mysqli_fetch_assoc($res_analyst);
    $id = $analyst['secretaryid'];
    $firstname = $analyst['firstname'];
    $lastname = $analyst['lastname'];
    $birthdate = $analyst['birthdate'];
    $startDate = $analyst['startdate'];
    $email = $analyst['email'];
    $mobile = $analyst['mobile'];
    $password = $analyst['password'];

$msg='';
if(isset($_POST['submit'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];
    $startDate = $_POST['startdate'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    
    $sql_update = "UPDATE `secretary` SET secretaryid=$id,`firstname`='$firstname',`lastname`='$lastname',`birthdate`='$birthdate',`startdate`='$startDate',`email`='$email',`mobile`='$mobile',`password`='$password' WHERE secretaryid=$id";
     
    $res_update = mysqli_query($conn,$sql_update);

    if($res_update){
     $msg='Updated successfully';
    }else {
        die(mysqli_error($conn));
    }
    }
?>



    <div class="container">
        <div class="add-box">
            <div class="head">
                <h3>Update</h3>
                <a href="admin_secretary.php"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
            <form method="post">
            <div class="fild">
                    <label class="label">First Name</label>
                    <input type="text" class="form-control" required placeholder="enter your first name" name="firstname" autocomplete="off"  value=<?php echo $firstname ?>>
                </div>
                <div class="fild">
                    <label class="label">Last Name</label>
                    <input type="text" class="form-control" required placeholder="enter your last name" name="lastname" autocomplete="off"  value=<?php echo $lastname ?>>
                </div>

                <div class="fild">
                    <label class="label">Start Date</label>
                    <input type="date" class="form-control" required placeholder="enter your start date" name="startdate" autocomplete="off" value=<?php echo $startDate ?>>
                </div>
                <div class="fild">
                    <label class="label">Birthdate</label>
                    <input type="date" class="form-control" required placeholder="enter your Birthdate" name="birthdate" autocomplete="off" value=<?php echo $birthdate ?>>
                </div>
                <div class="fild">
                    <label class="label">Email</label>
                    <input type="email" class="form-control" required placeholder="enter your email" name="email" autocomplete="off" value=<?php echo $email ?> >
                </div>
                <div class="fild">
                    <label class="label">mobile</label>
                    <input type="tel" class="form-control" required placeholder="enter your phone number" name="mobile" autocomplete="off" value=<?php echo $mobile ?>>
                </div>
                <div class="fild">
                    <label class="label">Password</label>
                    <input type="password" class="form-control" required placeholder="enter your password" name="password" autocomplete="off" value=<?php echo $password ?>>
                </div>
                <button type="submit" class="btn" name="submit" >Update</button>
                <p><?php echo $msg ?></p>
            </form>
        </div>
    </div>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>