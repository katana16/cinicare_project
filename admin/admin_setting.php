<?php
    require_once 'check_admin_login.php';
    $pageTitle = "Settings";
    require_once 'header.php';
?>



<div class="dashboard">
    <div class="row">

        <!-- SideBar -->
        <?php require_once 'admin_menu.php'; ?>
        <!-- End SideBar -->

<?php
    $msg = $color = $email_err = "";
    $adminid = $_SESSION['adminid'];

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form data
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password= $_POST['password'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $birthdate = $_POST['birthdate'];
        $gender = $_POST['gender'];
        
        // Check if email already exist not the current email
        $email_query = "SELECT email FROM admin WHERE email = '$email' AND adminid != $adminid";
        $email_result = mysqli_query($conn, $email_query);
        
        if (mysqli_num_rows($email_result) > 0) {
            $email_err = "This email is already registered.";
        }


        // If email are unique, Update user into database
        if (empty($email_err)) {
            // Update the database
            $sql = "UPDATE admin SET firstname='$firstname', lastname='$lastname', email='$email', password='$password', address='$address', mobile='$mobile', birthdate='$birthdate', gender='$gender' WHERE adminid='$adminid'";
            if ($conn->query($sql) === TRUE) {
                $color = "#26af48";
                $msg = "Settings updated successfully";
            } else {
                $color = "red";
                $msg = "Error updating Settings: " . $conn->error;
            }
        }
    }
    // Retrieve admin information
    $sql = "SELECT * FROM admin WHERE adminid ='$adminid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
?>


        <!-- Content -->
        <div class="col-lg-10 ">
            <section id="content">
                    <!-- Main -->
                    <main>
                        <div class="container">
                            <div class="head-title">
                                <h1>Settings</h1>
                            </div>
                            

                            <div class="all-list list box">
                                <div class="box-head head">
                                    <h3>Update Settings</h3> <p style="color: <?php echo $color; ?>;"><?php echo $msg; ?></p>
                                </div>

                                <div class="setting-form">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="firstname" class="col-sm-2 col-form-label">First Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="lastname" class="col-sm-2 col-form-label">Last Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>">
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                        <div class="col-sm-10">
                                            <span class="error"><?php echo $email_err; ?></span>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="mobile" class="col-sm-2 col-form-label">Password:</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="address" class="col-sm-2 col-form-label">Address:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="mobile" class="col-sm-2 col-form-label">Mobile:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $row['mobile']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="birthdate" class="col-sm-2 col-form-label">Birthdate:</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $row['birthdate']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="gender" name="gender">
                                                <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                                <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>

                                </div>
                            </div>
                        </div>
                    </main>
            </section>
        </div>

        <!-- End Content -->

</div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>