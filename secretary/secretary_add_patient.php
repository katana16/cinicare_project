<?php 
    require_once 'check_secretary_login.php'; 
    $pageTitle = "Patient Registration";
    require_once 'header.php'; 
?>

<?php

// Initialize variables for form data and errors
$firstname = $lastname = $email = $password = $gender = $birthdate = $speciality = $state = $bloodgroup = $phone = $address = $photo_path = "";
$email_err = $msg_success = $msg_error = "";

// When form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"] ?? "";
    $birthdate = $_POST["birthdate"];
    $state = $_POST["state"] ?? "";
    $bloodgroup = $_POST["bloodgroup"] ?? "";
    $phone = $_POST["phone"] ?? "";
    $address = $_POST["address"] ?? "";

    // Upload photo
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $target_file);
    $photo_path = $target_file;

    // Check if email already exist
    $email_query = "SELECT patientid FROM patients WHERE email = '$email'";
    $email_result = mysqli_query($conn, $email_query);
    
    if (mysqli_num_rows($email_result) > 0) {
        $email_err = "This email is already registered.";
    }

    // If email are unique, insert user into database
    if (empty($email_err)) {
        // Insert user into database with photo path
        $insert_query = "INSERT INTO patients (firstname, lastname, email, password, gender, birthdate, state, bloodgroup, mobile, address, photo_path) VALUES ('$firstname', '$lastname', '$email', '$password', '$gender', '$birthdate', '$state', '$bloodgroup', '$phone', '$address', '$photo_path')";
        if (mysqli_query($conn, $insert_query)) {
            $success = "success";
            $msg_success = "Patient added successfully";
        } else {
            $msg_error = "Something went wrong. Please try again later.";
        }
 
    }

    // Close database connection
    mysqli_close($conn);
}
?>



    <div class="container">
        <div class="golobal-content add-box">

            <div class="form-container">

                <div class="head">
                    <h3>Patient Registration</h3>
                    <a href="secretary_patients.php"><i class="fa-solid fa-left-long"></i></a>
                </div>


                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <span class="error"><?php echo $email_err; ?></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2 d-flex align-items-center">
                            <label for="birthdate" class="form-label">Birthdate:</label>
                        </div>

                        <div class="col-md-10">
                            <input type="date" name="birthdate" class="form-control" placeholder="Birthdate" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <select name="gender" class="form-select" required>
                                <option value="" disabled selected>Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <select name="bloodgroup" class="form-select">
                                <option value="" disabled selected>Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>

                    </div>


                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select name="state" class="form-select">
                                <option value="" disabled selected>State</option>
                                <option value="Adrar">Adrar</option>
                                <option value="Aïn Defla">Aïn Defla</option>
                                <option value="Aïn Témouchent">Aïn Témouchent</option>
                                <option value="Algiers">Algiers</option>
                                <option value="Annaba">Annaba</option>
                                <option value="Batna">Batna</option>
                                <option value="Béchar">Béchar</option>
                                <option value="Béjaïa">Béjaïa</option>
                                <option value="Biskra">Biskra</option>
                                <option value="Bordj Bou Arréridj">Bordj Bou Arréridj</option>
                                <option value="Bouïra">Bouïra</option>
                                <option value="Boumerdès">Boumerdès</option>
                                <option value="Chlef">Chlef</option>
                                <option value="Constantine">Constantine</option>
                                <option value="Djelfa">Djelfa</option>
                                <option value="El Bayadh">El Bayadh</option>
                                <option value="El Oued">El Oued</option>
                                <option value="El Tarf">El Tarf</option>
                                <option value="Ghardaïa">Ghardaïa</option>
                                <option value="Guelma">Guelma</option>
                                <option value="Illizi">Illizi</option>
                                <option value="Jijel">Jijel</option>
                                <option value="Khenchela">Khenchela</option>
                                <option value="Laghouat">Laghouat</option>
                                <option value="M'Sila">M'Sila</option>
                                <option value="Mascara">Mascara</option>
                                <option value="Médéa">Médéa</option>
                                <option value="Mila">Mila</option>
                                <option value="Mostaganem">Mostaganem</option>
                                <option value="Naama">Naama</option>
                                <option value="Oran">Oran</option>
                                <option value="Ouargla">Ouargla</option>
                                <option value="Oum El Bouaghi">Oum El Bouaghi</option>
                                <option value="Relizane">Relizane</option>
                                <option value="Saïda">Saïda</option>
                                <option value="Sétif">Sétif</option>
                                <option value="Sidi Bel Abbès">Sidi Bel Abbès</option>
                                <option value="Skikda">Skikda</option>
                                <option value="Souk Ahras">Souk Ahras</option>
                                <option value="Tamanrasset">Tamanrasset</option>
                                <option value="Tébessa">Tébessa</option>
                                <option value="Tiaret">Tiaret</option>
                                <option value="Tindouf">Tindouf</option>
                                <option value="Tipaza">Tipaza</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-9">
                            <input type="text" id="address" name="address" class="form-control" placeholder="Address">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="tel" id="phone" name="phone" class="form-control" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="Phone Number">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <small class="form-text text-muted">Upload your photo (JPG, PNG, GIF) with a maximum size of 5MB.</small>
                            <input type="file" name="photo" class="form-control" accept="image/*">

                        </div>
                    </div>

                    <input type="submit" value="Signup">
                </form>
                <p class="<?php echo $success; ?>"><?php echo $msg_success; ?></p>
                <p class="error"><?php echo $msg_error; ?></p>


            </div>
            <div class="image-container">
                <img src="assets/img/patientsRegistration.png" alt="Image">
            </div>

        </div>
    </div>



  <!-- Footer -->
  <?php require_once 'footer.php'; ?>