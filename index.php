<!-- Header -->
  <?php 
  $pageTitle = "CliniCare";
  require_once 'header.php'; 
  ?>



  <!-- Main Content -->
  
  <!-- First Section with Image -->
  <section class="home-sections" id="first-section" class="mt-5">
        <div class="container">
        <div class="max-width-section">
            <div class="row align-items-center">
                <div class="col-md-6">
                  <h2>Consult <span>Best Doctors</span> available at our clinic.</h2>
                  <p>Easily book appointments online for quick access to our top doctors.</p>
                  <a href="#" class="btn btn-primary" id="appointmentBtn">Get Appointment</a>
                  <script>
                    document.getElementById("appointmentBtn").addEventListener("click", function(event) {
                      event.preventDefault(); // Prevent default behavior of the anchor tag
                      // Check if the user is logged in
                      <?php if(isset($_SESSION['patient_loggedin'])) { ?>
                        // If logged in, redirect to the appointment page
                        window.location.href = "search-doctors.php";
                      <?php } else { ?>
                        // If not logged in, redirect to the login page
                        window.location.href = "login.php";
                      <?php } ?>
                    });
                  </script>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
      </div>
  </section>



    <!-- speicality Section -->
    <section class="home-sections mt-5" id="speicality-section">
      <div class="container">
        <div class="max-width-section">
          <div class="section-header section-header-one" >
            <h2 class="section-title">Specialities</h2>
          </div>

          <div id="speicality-slider">
            <div class="speicality-carousel owl-carousel owl-theme">

              <!-- Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-01.png" class="img-fluid" alt="Speciality">
                  </div>
                  <p>Urology</p>
                </div>	
              </div>

              <!-- Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-02.png" class="img-fluid" alt="Speciality">
                  </div>
                  <p>Neurology</p>	
                </div>	
              </div>

              <!-- Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-03.png" class="img-fluid" alt="Speciality">
                  </div>	
                  <p>Orthopedic</p>	
                </div>	
              </div>

              <!-- Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-04.png" class="img-fluid" alt="Speciality">
                  </div>	
                  <p>Cardiologist</p>	
                </div>	
              </div>

              <!-- Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-05.png" class="img-fluid" alt="Speciality">
                  </div>	
                  <p>Dentist</p>
                </div>	
              </div>

              <!-- Repeat Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-01.png" class="img-fluid" alt="Speciality">
                  </div>
                  <p>Urology</p>
                </div>	
              </div>

              <!-- Repeat Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-02.png" class="img-fluid" alt="Speciality">
                  </div>
                  <p>Neurology</p>	
                </div>	
              </div>

              <!-- Repeat Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-03.png" class="img-fluid" alt="Speciality">
                  </div>	
                  <p>Orthopedic</p>	
                </div>	
              </div>

              <!-- Repeat Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-04.png" class="img-fluid" alt="Speciality">
                  </div>	
                  <p>Cardiologist</p>	
                </div>	
              </div>

              <!-- Repeat Slider Item -->
              <div class="item">
                <div class="speicality-item text-center">
                  <div class="speicality-img">
                    <img src="assets/img/specialities/specialities-05.png" class="img-fluid" alt="Speciality">
                  </div>	
                  <p>Dentist</p>
                </div>	
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>



  <!-- How Section -->
  <section class="home-sections" id="how-section" class="mt-5">
      <div class="container">
          <div class="max-width-section">

            <div class="row">
              <div class="col-lg-4 col-md-12 work-img-info aos" data-aos="fade-up">
              <div class="work-img">
              <img decoding="async" src="assets/img/sections/work-img.png" alt="" class="img-fluid">
              </div>
              </div>
              <div class="col-lg-8   work-details">
              <div class="section-header-one aos" data-aos="fade-up">
              <h5>How it Works</h5>
              <h2 class="section-title">4 easy steps to get your solution</h2>
              </div>
              <div class="row">
              <div class="col-lg-6 col-md-6 aos" data-aos="fade-up">
              <div class="work-info">
              <div class="work-icon">
              <span><img decoding="async" alt="" src="assets/img/sections/work-01.svg"></span>
              </div>
              <div class="work-content">
              <h5>Search Doctor </h5>
              <p>Find your ideal healthcare provider with ease, ensuring a tailored match for your needs.</p>
              </div>
              </div>
              </div>
              <div class="col-lg-6 col-md-6 aos" data-aos="fade-up">
              <div class="work-info">
              <div class="work-icon">
              <span><img decoding="async" alt="" src="assets/img/sections/work-02.svg"></span>
              </div>
              <div class="work-content">
              <h5>Check Doctor Profile </h5>
              <p>Verify the credentials and expertise of your chosen doctor effortlessly before making your appointment. </p>
              </div>
              </div>
              </div>
              <div class="col-lg-6 col-md-6 aos" data-aos="fade-up">
              <div class="work-info">
              <div class="work-icon">
              <span><img decoding="async" alt="" src="assets/img/sections/work-03.svg"></span>
              </div>
              <div class="work-content">
              <h5>Schedule Appointment </h5>
              <p>Book your consultation seamlessly, selecting a convenient time that fits your schedule in moments </p>
              </div>
              </div>
              </div>
              <div class="col-lg-6 col-md-6 aos" data-aos="fade-up">
              <div class="work-info">
              <div class="work-icon">
              <span><img decoding="async" alt="" src="assets/img/sections/work-04.svg"></span>
              </div>
              <div class="work-content">
              <h5>Get Your Solution </h5>
              <p>Experience personalized care and embark on your journey towards wellness with confidence. </p>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>





          </div>
        </div>

  </section>



  <!-- Doctors Section -->
  <section class="home-sections mt-5" id="doctors-section">
      <div class="container">
        <div class="max-width-section">

          <div class="section-header section-header-one" >
            <h2 class="section-title">Book Our Best Doctor</h2>
          </div>

          <div id="doctors-slider">
            <div class="doctors-carousel owl-carousel owl-theme">

              <!-- Slider Item -->
              <?php
              // Constructing the SQL query
              $sql = "SELECT * FROM doctors LIMIT 10";

              // Executing the query
              $result = $conn->query($sql);

              // Displaying search results
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "
                      <div class='item'>
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
      </div>
  </section>

    <script>
      $(document).ready(function(){
        $('#myCarousel').carousel({
          interval: false // Disable automatic cycling
        });

        $('#myCarousel').on('click', '.carousel-control-next', function () {
          $('#myCarousel').carousel('next');
        });

        $('#myCarousel').on('click', '.carousel-control-prev', function () {
          $('#myCarousel').carousel('prev');
        });
      });
    </script>



  <!-- Features Section -->
  <section class="home-sections" id="features-section" class="mt-5">
      <div class="container">
          <div class="max-width-section">

            <div class="section-header section-header-one" >
              <h2 class="section-title">Available Features in Our Clinic</h2>
              <div class="sub_title" style="text-align:left;">
                <p> Explore the range of services offered at our clinic, providing comprehensive care to meet your needs.</p>
             </div>

            </div>
            <div class="row clinic-row">
              <div class="col-lg-4 col-md-6 d-flex clinic-main-grid">
              <div class="clinic-grid w-100 hvr-bounce-to-right">
              <img decoding="async" src="assets/img/features/features-02.png">
              <h4>Medical</h4>
              </div>
              </div>
              <div class="col-lg-4 col-md-6 d-flex clinic-main-grid">
              <div class="clinic-grid w-100 hvr-bounce-to-right">
              <img decoding="async" src="assets/img/features/features-01.png">
              <h4>Operation</h4>
              </div>
              </div>
              <div class="col-lg-4 col-md-6 d-flex clinic-main-grid">
              <div class="clinic-grid w-100 hvr-bounce-to-right">
              <img decoding="async" src="assets/img/features/features-06.png">
              <h4>Laboratory</h4>
              </div>
              </div>
              <div class="col-lg-4 col-md-6 d-flex clinic-main-grid">
              <div class="clinic-grid w-100 hvr-bounce-to-right">
              <img decoding="async" src="assets/img/features/features-05.png">
              <h4>ICU</h4>
              </div>
              </div>
              <div class="col-lg-4 col-md-6 d-flex clinic-main-grid">
              <div class="clinic-grid w-100 hvr-bounce-to-right">
              <img decoding="async" src="assets/img/features/features-04.png">
              <h4>Test Room</h4>
              </div>
              </div>
              <div class="col-lg-4 col-md-6 d-flex clinic-main-grid">
              <div class="clinic-grid w-100 hvr-bounce-to-right">
              <img decoding="async" src="assets/img/features/features-03.png">
              <h4>Patient Ward</h4>
              </div>
              </div>
              </div>
          </div>
        </div>
  </section>



  <!-- Gallery Section -->
  <section class="home-sections mt-5" id="gallery-section">
      <div class="container">
        <div class="max-width-section">

          <div class="section-header section-header-one" >
            <h2 class="section-title">Gallery of Our Clinic
            </h2>
            <div class="sub_title">
           </div>
          </div>

          <div class="row">
            <div class="col-md-4">
              <img src="assets/img/gallery/gallery-1.jpg" class="img-fluid mb-3" alt="Image 1">
            </div>
            <div class="col-md-4">
              <img src="assets/img/gallery/gallery-2.jpg" class="img-fluid mb-3" alt="Image 2">
            </div>
            <div class="col-md-4">
              <img src="assets/img/gallery/gallery-3.jpg" class="img-fluid mb-3" alt="Image 3">
            </div>
            <div class="col-md-4">
              <img src="assets/img/gallery/gallery-4.jpg" class="img-fluid mb-3" alt="Image 4">
            </div>
            <div class="col-md-4">
              <img src="assets/img/gallery/gallery-5.jpg" class="img-fluid mb-3" alt="Image 5">
            </div>
            <div class="col-md-4">
              <img src="assets/img/gallery/gallery-6.jpg" class="img-fluid mb-3" alt="Image 6">
            </div>
          </div>
        </div>


        </div>
      </div>
  </section>



  <!-- Footer -->
  <?php require_once 'footer.php'; ?>
