<?php
    require_once 'check_analyst_login.php';
    $pageTitle = "Settings";
    require_once 'header.php';
?>



<div class="dashboard">
    <div class="row">

        <!-- SideBar -->
        <?php require_once 'analyst_menu.php'; ?>
        <!-- End SideBar -->

<?php
    $msg = $color = $email_err = "";
    $analystid = $_SESSION['analystid'];

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process form data
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $speciality = $_POST['speciality'];
        $email = $_POST['email'];
        $password= $_POST['password'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $mobile = $_POST['mobile'];
        $birthdate = $_POST['birthdate'];
        $gender = $_POST['gender'];
        $bloodgroup = $_POST['bloodgroup'];
        


        if ($_FILES["photo"]["size"] > 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        
            // Move uploaded file to the target directory
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $target_file)) {
                $photoPath = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    
        // Check if email already exist not the current email
        $email_query = "SELECT email FROM analysts WHERE email = '$email' AND analystid != $analystid";
        $email_result = mysqli_query($conn, $email_query);
        
        if (mysqli_num_rows($email_result) > 0) {
            $email_err = "This email is already registered.";
        }


        // If email are unique, Update user into database
        if (empty($email_err)) {
            // Update the database
            $sql = "UPDATE analysts SET firstname='$firstname', lastname='$lastname', speciality='$speciality', email='$email', password='$password', address='$address', state='$state', mobile='$mobile', birthdate='$birthdate', gender='$gender', bloodgroup='$bloodgroup', photo_path='$photoPath' WHERE analystid='$analystid'";
            if ($conn->query($sql) === TRUE) {
                $color = "#26af48";
                $msg = "Settings updated successfully";
            } else {
                $color = "red";
                $msg = "Error updating Settings: " . $conn->error;
            }
        }
    }
    // Retrieve analyst information
    $sql = "SELECT * FROM analysts WHERE analystid ='$analystid'";
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
                                        <label for="speciality" class="col-sm-2 col-form-label">Speciality:</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="speciality" name="speciality">
                                                <option value="" disabled>Speciality</option>
                                                <option value="Radiologist" <?php if($row['speciality'] == 'Radiologist') echo 'selected'; ?>>Radiologist</option>
                                                <option value="Biologist" <?php if($row['speciality'] == 'Biologist') echo 'selected'; ?>>Biologist</option>
                                                <option value="Other" <?php if($row['speciality'] == 'Other') echo 'selected'; ?>>Other</option>
                                            </select>                                        
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
                                        <label for="state" class="col-sm-2 col-form-label">State:</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="state" name="state">
                                                <option value="Adrar" <?php if($row['state'] == 'Adrar') echo 'selected'; ?>>Adrar</option>
                                                <option value="Aïn Defla" <?php if($row['state'] == 'Aïn Defla') echo 'selected'; ?>>Aïn Defla</option>
                                                <option value="Aïn Témouchent" <?php if($row['state'] == 'Aïn Témouchent') echo 'selected'; ?>>Aïn Témouchent</option>
                                                <option value="Algiers" <?php if($row['state'] == 'Algiers') echo 'selected'; ?>>Algiers</option>
                                                <option value="Annaba" <?php if($row['state'] == 'Annaba') echo 'selected'; ?>>Annaba</option>
                                                <option value="Batna" <?php if($row['state'] == 'Batna') echo 'selected'; ?>>Batna</option>
                                                <option value="Béchar" <?php if($row['state'] == 'Béchar') echo 'selected'; ?>>Béchar</option>
                                                <option value="Béjaïa" <?php if($row['state'] == 'Béjaïa') echo 'selected'; ?>>Béjaïa</option>
                                                <option value="Biskra" <?php if($row['state'] == 'Biskra') echo 'selected'; ?>>Biskra</option>
                                                <option value="Bordj Bou Arréridj" <?php if($row['state'] == 'Bordj Bou Arréridj') echo 'selected'; ?>>Bordj Bou Arréridj</option>
                                                <option value="Bouïra" <?php if($row['state'] == 'Bouïra') echo 'selected'; ?>>Bouïra</option>
                                                <option value="Boumerdès" <?php if($row['state'] == 'Boumerdès') echo 'selected'; ?>>Boumerdès</option>
                                                <option value="Chlef" <?php if($row['state'] == 'Chlef') echo 'selected'; ?>>Chlef</option>
                                                <option value="Constantine" <?php if($row['state'] == 'Constantine') echo 'selected'; ?>>Constantine</option>
                                                <option value="Djelfa" <?php if($row['state'] == 'Djelfa') echo 'selected'; ?>>Djelfa</option>
                                                <option value="El Bayadh" <?php if($row['state'] == 'El Bayadh') echo 'selected'; ?>>El Bayadh</option>
                                                <option value="El Oued" <?php if($row['state'] == 'El Oued') echo 'selected'; ?>>El Oued</option>
                                                <option value="El Tarf" <?php if($row['state'] == 'El Tarf') echo 'selected'; ?>>El Tarf</option>
                                                <option value="Ghardaïa" <?php if($row['state'] == 'Ghardaïa') echo 'selected'; ?>>Ghardaïa</option>
                                                <option value="Guelma" <?php if($row['state'] == 'Guelma') echo 'selected'; ?>>Guelma</option>
                                                <option value="Illizi" <?php if($row['state'] == 'Illizi') echo 'selected'; ?>>Illizi</option>
                                                <option value="Jijel" <?php if($row['state'] == 'Jijel') echo 'selected'; ?>>Jijel</option>
                                                <option value="Khenchela" <?php if($row['state'] == 'Khenchela') echo 'selected'; ?>>Khenchela</option>
                                                <option value="Laghouat" <?php if($row['state'] == 'Laghouat') echo 'selected'; ?>>Laghouat</option>
                                                <option value="M'Sila" <?php if($row['state'] == 'M\'Sila') echo 'selected'; ?>>M'Sila</option>
                                                <option value="Mascara" <?php if($row['state'] == 'Mascara') echo 'selected'; ?>>Mascara</option>
                                                <option value="Médéa" <?php if($row['state'] == 'Médéa') echo 'selected'; ?>>Médéa</option>
                                                <option value="Mila" <?php if($row['state'] == 'Mila') echo 'selected'; ?>>Mila</option>
                                                <option value="Mostaganem" <?php if($row['state'] == 'Mostaganem') echo 'selected'; ?>>Mostaganem</option>
                                                <option value="Naama" <?php if($row['state'] == 'Naama') echo 'selected'; ?>>Naama</option>
                                                <option value="Oran" <?php if($row['state'] == 'Oran') echo 'selected'; ?>>Oran</option>
                                                <option value="Ouargla" <?php if($row['state'] == 'Ouargla') echo 'selected'; ?>>Ouargla</option>
                                                <option value="Oum El Bouaghi" <?php if($row['state'] == 'Oum El Bouaghi') echo 'selected'; ?>>Oum El Bouaghi</option>
                                                <option value="Relizane" <?php if($row['state'] == 'Relizane') echo 'selected'; ?>>Relizane</option>
                                                <option value="Saïda" <?php if($row['state'] == 'Saïda') echo 'selected'; ?>>Saïda</option>
                                                <option value="Sétif" <?php if($row['state'] == 'Sétif') echo 'selected'; ?>>Sétif</option>
                                                <option value="Sidi Bel Abbès" <?php if($row['state'] == 'Sidi Bel Abbès') echo 'selected'; ?>>Sidi Bel Abbès</option>
                                                <option value="Skikda" <?php if($row['state'] == 'Skikda') echo 'selected'; ?>>Skikda</option>
                                                <option value="Souk Ahras" <?php if($row['state'] == 'Souk Ahras') echo 'selected'; ?>>Souk Ahras</option>
                                                <option value="Tamanrasset" <?php if($row['state'] == 'Tamanrasset') echo 'selected'; ?>>Tamanrasset</option>
                                                <option value="Tébessa" <?php if($row['state'] == 'Tébessa') echo 'selected'; ?>>Tébessa</option>
                                                <option value="Tiaret" <?php if($row['state'] == 'Tiaret') echo 'selected'; ?>>Tiaret</option>
                                                <option value="Tindouf" <?php if($row['state'] == 'Tindouf') echo 'selected'; ?>>Tindouf</option>
                                                <option value="Tipaza" <?php if($row['state'] == 'Tipaza') echo 'selected'; ?>>Tipaza</option>
                                                <option value="Other" <?php if($row['state'] == 'Other') echo 'selected'; ?>>Other</option>
                                            </select>                                        
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
                                        <label for="bloodgroup" class="col-sm-2 col-form-label">Blood Group:</label>
                                        <div class="col-sm-10">
                                            <select class="form-select" id="bloodgroup" name="bloodgroup">
                                                <option value="A+" <?php if($row['bloodgroup'] == 'A+') echo 'selected'; ?>>A+</option>
                                                <option value="A-" <?php if($row['bloodgroup'] == 'A-') echo 'selected'; ?>>A-</option>
                                                <option value="B+" <?php if($row['bloodgroup'] == 'B+') echo 'selected'; ?>>B+</option>
                                                <option value="B-" <?php if($row['bloodgroup'] == 'B-') echo 'selected'; ?>>B-</option>
                                                <option value="AB+" <?php if($row['bloodgroup'] == 'AB+') echo 'selected'; ?>>AB+</option>
                                                <option value="AB-" <?php if($row['bloodgroup'] == 'AB-') echo 'selected'; ?>>AB-</option>
                                                <option value="O+" <?php if($row['bloodgroup'] == 'O+') echo 'selected'; ?>>O+</option>
                                                <option value="O-" <?php if($row['bloodgroup'] == 'O-') echo 'selected'; ?>>O-</option>
                                                <!-- Add more blood groups as needed -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="bloodgroup" class="col-sm-2 col-form-label">Update Photo:</label>
                                        <div class="col-sm-10">
                                        <small class="form-text text-muted">Upload your photo (JPG, PNG, GIF) with a maximum size of 5MB.</small>
                                        <input type="file" name="photo" class="form-control" accept="image/*">
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