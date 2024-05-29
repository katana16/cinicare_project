<!-- Header -->
<?php 
  $pageTitle = "Doctors";
  require_once 'header.php'; 
  ?>

  <!-- Main Content -->
<div class="content">
  <div class="container">


    <div class="search-box">
      <h2>Search Filter</h2>
      <div class="centered-form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" class="row">
          <div class="col-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="Search...">
          </div>
          <div class="col-3">
            <select class="form-select" name="gender" id="gender">
              <option value="" selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
          </div>
          <div class="col-3">
            <select class="form-select" id="specialty" name="specialty">
              <option value="" selected>Select Specialty</option>
              <option value="Generalist">Generalist</option>
              <option value="Cardiologist">Cardiologist</option>
              <option value="Gynecologist">Gynecologist</option>
              <option value="Dermatologist">Dermatologist</option>
              <option value="Endocrinologist">Endocrinologist</option>
              <option value="Gastroenterologist">Gastroenterologist</option>
              <option value="Neurologist">Neurologist</option>
              <option value="Oncologist">Oncologist</option>
              <option value="Ophthalmologist">Ophthalmologist</option>
              <option value="Orthopedist">Orthopedist</option>
              <option value="Pediatrician">Pediatrician</option>
              <option value="Psychiatrist">Psychiatrist</option>
              <option value="Urologist">Urologist</option>
              <option value="Radiologist">Radiologist</option>
              <option value="Biologist">Biologist</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="col">
            <input class="btn btn-primary mb-3" type="submit" value="Search">
          </div>
        </form>
      </div>
    </div>


    <div class="row">
      <?php
      // Fetching search criteria
      $name = $_GET['name'] ?? '';
      $specialty = $_GET['specialty'] ?? '';
      $gender = $_GET['gender'] ?? '';

      // Constructing the SQL query
      $sql = "SELECT * FROM doctors WHERE 1=1";
      if (!empty($name)) {
        $sql .= " AND firstname LIKE '%$name%' OR lastname LIKE '%$name%'";
    }
    if (!empty($specialty)) {
        $sql .= " AND speciality = '$specialty'";
    }
    if (!empty($gender)) {
        $sql .= " AND gender = '$gender'";
    }

      // Executing the query
      $result = $conn->query($sql);

      // Displaying search results
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "
            <div class='col-md-3'>
              <div class='profile-widget'>
                <div class='doc-img'>
                  <a href='doctor-profile.html'>
                    <img class='img-fluid' alt='Doctor Photo' src='" . $row['photo_path'] . "'>
                  </a>
                </div>
                <div class='pro-content'>
                  <h3 class='title'>
                  <a>" . $row['firstname'] . " " . $row['lastname'] . "</a>
                  </h3>
                  <p class='speciality'>" . $row['speciality'] . "</p>
                  <ul class='available-info'>
                    <li>
                      <i class='fas fa-map-marker-alt'></i> " . $row['state'] . "
                    </li>
                    <li>
                      <i class='far fa-clock'></i> Available: " . $row['workdays'] . "
                    </li>
                  </ul>
                  <div class='row row-sm'>
                    <div class='col'>
                      <a href='" . (isset($_SESSION['patient_loggedin']) ? "appointment.php?doctorid=" . $row['doctorid'] : "login.php") . "' class='btn book-btn'>Book Now</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              ";
          }
      } else {
        echo "<h2>No results found</h2>";
      }

      $conn->close();
      ?>
    </div>

  </div>
</div>




  
  <!-- Footer -->
  <?php require_once 'footer.php'; ?>