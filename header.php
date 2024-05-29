<?php require_once 'db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <!-- Favicons -->
  <link type="image/x-icon" href="assets/img/favicon.png" rel="icon">
  <!-- Owl Carousel For the slider  -->
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <!-- Bootstrap v5.3.3 CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
  <!-- render all elements normally -->
  <link rel="stylesheet" href="assets/css/normalize.css">
  <!-- Main Style CSS -->
  <link property="stylesheet" rel='stylesheet' href='assets/css/style.css' type='text/css' media='all'/>
  <link rel="stylesheet" href="assets/css/dashboard.css">
  <!-- Fontawesome CSS -->
  <link rel="stylesheet" href="assets/css/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="assets/css/fontawesome/css/all.min.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid d-flex justify-content-between"> <a class="navbar-brand" href="#">
          <img class="logo" src="assets/img/logo/logo11.png" alt="logo">
        </a>
        <nav class="collapse navbar-collapse" id="navbarSupportedContent"> <ul class="navbar-nav mr-auto">  <li class="nav-item active">
              <a class="nav-link" href="/clinicare/">Home <span class="sr-only">(current)</span></a>
            </li>


<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDoctor" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Doctors
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdownDoctor">
    <a class="dropdown-item" href="search-doctors.php">All</a>
    <div class="dropdown-divider"></div>
    <h6 class="dropdown-header">Specialties</h6>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Generalist">Generalist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Cardiologist">Cardiologist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Gynecologist">Gynecologist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Dermatologist">Dermatologist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Endocrinologist">Endocrinologist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Gastroenterologist">Gastroenterologist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Ophthalmologist">Ophthalmologist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Orthopedist">Orthopedist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Pediatrician">Pediatrician</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Psychiatrist">Psychiatrist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Urologist">Urologist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Radiologist">Radiologist</a>
    <a class="dropdown-item" href="search-doctors.php?name=&gender=&specialty=Biologist">Biologist</a>

    <!-- Add more specialty adjectives as needed -->
  </div>
</li>

            <li class="nav-item">
              <a class="nav-link" href="aboutus.php">About</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="contactus.php">Contact</a>
            </li>
          </ul>
        </nav>
    
        <div class="signup-in">

        <?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

    <?php if (isset($_SESSION['patient_loggedin']) && $_SESSION['patient_loggedin']) { ?>
        <a class="btn btn-primary mr-2" href="patient_dashboard.php?patientid=<?php echo urlencode($_SESSION['patientid']); ?>">Profile</a>
        <a class="btn btn-primary mr-2" href="logout-fonction.php">Logout</a>

    <?php } else { ?>
        <a class="btn btn-primary mr-2" href="login.php">Sign In</a>
        <a class="btn btn-success" href="signup.php">Sign Up</a>
    <?php } ?>
        </div>
      </div>
    </nav>
  </header>