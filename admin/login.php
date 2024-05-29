<!-- Header -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if the user is logged in
if (isset($_SESSION['admin_loggedin'])) {
    // Redirect to index page 
    header("Location: index.php");
    exit();
} 
  $pageTitle = "Admin Login";
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
    $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Login successful
        $user = $result->fetch_assoc();
          $_SESSION['admin_loggedin'] = true;
          $_SESSION['adminid'] = $user['adminid'];
          // Redirect to profile page with user id as parameter
          header('Location: index.php?adminid=' . urlencode($user['adminid']));
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
            <h3>Admin Login</h3>
          </div>
          <form action="#" method="post">
            <input type="text" id="email" name="email" required placeholder="Email">
            <input type="password" id="password" name="password" required placeholder="Password">
            <input type="submit" name="login" value="Login">
            <?php if(isset($error)) echo "<p>$error</p>"; ?>
          </form>
        </div>

        <div class="image-container">
            <img src="assets/img/login-banner.png" alt="Image">
        </div>
      </div>
    </div>

  <!-- Footer -->
  <?php require_once 'footer.php'; ?>