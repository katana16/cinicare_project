<!-- Header -->
<?php 
    require_once 'check_patient_login.php';
    $pageTitle = "Book Success";
    require_once 'header.php'; 
?>

<div class="content">
  <div class="container">


  <div class="container-fluid">
				
					<div class="row justify-content-center">
						<div class="col-lg-6">
						
							<!-- Success Card -->
							<div class="card success-card">
								<div class="msg-body">
									<div class="success-cont">
										<i class="fas fa-check"></i>
										<h3>Appointment booked Successfully!</h3>
										<a href="patient_dashboard.php?patientid=<?php echo urlencode($_SESSION['patientid']); ?>" class="btn btn-primary view-inv-btn">View Details</a>
									</div>
								</div>
							</div>
							<!-- /Success Card -->
							
						</div>
					</div>
					
				</div>
</div>
</div>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>