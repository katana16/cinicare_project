<!-- Header -->
<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
// Check if the user is logged in
if (isset($_SESSION['doctor_loggedin'])) {
  // Redirect to index page 
  header("Location: index.php");
  exit();
} 
  $pageTitle = "Doctor Login";
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
    $query = "SELECT * FROM doctors WHERE email='$email' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Login successful
        $user = $result->fetch_assoc();
        $_SESSION['doctor_loggedin'] = true;
        $_SESSION['doctorid'] = $user['doctorid'];
        // Redirect to profile page with user id as parameter
        header('Location: index.php?doctorid=' . urlencode($user['doctorid']));
        exit;
    } else {
        // Login failed
        $error = "Invalid Email or Pssword";
    }
}

?>


    <div class="container">
      <div class="login-content d-flex justify-content-center align-items-center vh-100">

        <div class="form-container">
          <div class="login-header">
            <h3>Doctor Login</h3>
          </div>
          <form action="#" method="post">
            <input type="text" id="email" name="email" required placeholder="Email">
            <input type="password" id="password" name="password" required placeholder="Password">
            <input type="submit" name="login" value="Login">
            <?php if(isset($error)) echo "<p>$error</p>"; ?>
          </form>
        </div>

        <div class="image-container">
            <img src="assets/img/doctorlogin.png" alt="Image">
        </div>
      </div>
    </div>

  <!-- Footer -->
  <?php require_once 'footer.php'; ?>