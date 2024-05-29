<!-- Header -->
<?php 
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

  // Check if the user is logged in
  if (isset($_SESSION['patient_loggedin'])) {
      // Redirect to login page or handle unauthorized access
      header("Location: patient_dashboard.php");
      exit();
  }
  $pageTitle = "User Login";
  require_once 'header.php'; 
?>

  <!-- Main Content -->
<?php


// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Login Logic
if(isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

    // Query database to check credentials
    $query = "SELECT * FROM patients WHERE email='$email' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Login successful
        $user = $result->fetch_assoc();
        $_SESSION['patient_loggedin'] = true;
        $_SESSION['patientid'] = $user['patientid'];
        // Redirect to profile page with user id as parameter
        header('Location: patient_dashboard.php?patientid=' . urlencode($user['patientid']));
        exit;
    } else {
        // Login failed
        $error = "Invalid Email or Pssword";
    }
}

?>


    <div class="container">
      <div class="login-content">

        <div class="form-container">
          <div class="login-header">
            <h3>Login</h3>
          </div>
          <form action="#" method="post">
            <input type="text" id="email" name="email" required placeholder="Email">
            <input type="password" id="password" name="password" required placeholder="Password">
            <input type="submit" name="login" value="Login">
            <?php if(isset($error)) echo "<p>$error</p>"; ?>
          </form>
          <div class="signup-or">
                <span class="or-line"></span>
          </div>
          <div class="dont-have">Don’t have an account? <a href="signup.php">Sign up</a></div>
        </div>

        <div class="image-container">
            <img src="assets/img/login-banner.png" alt="Image">
        </div>
      </div>
    </div>

  <!-- Footer -->
  <?php require_once 'footer.php'; ?>