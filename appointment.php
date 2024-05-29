<!-- Header -->
<?php 
    require_once 'check_patient_login.php';
    $pageTitle = "Book Appointment";
    require_once 'header.php'; 
    
$msg_error = "";
// Check if the doctorid parameter is set in the URL
if (isset($_GET['doctorid'])) {
    // Sanitize the input to prevent SQL injection
    $doctorid = mysqli_real_escape_string($conn, $_GET['doctorid']);

    // Query to retrieve the doctor's full name based on the doctorid
    $sql = "SELECT * FROM doctors WHERE doctorid = $doctorid";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $fullName = $row["firstname"] . " " . $row["lastname"];
            $photoPath = $row["photo_path"];
            $speciality = $row["speciality"];
            $workdays = $row["workdays"];
        }
    } else {
        echo "No doctor found with the provided ID.";
    }
} else {
    echo "Doctor ID parameter is missing in the URL.";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $appointmentdate = $_POST['appointmentdate'];
    $patientid = $_SESSION['patientid'];
    $comments = $_POST['comments'];

    // Check if there are any appointments for the same patient on the same date
    $check_sql = "SELECT * FROM appointments WHERE patientid = '$patientid' AND doctorid = '$doctorid' AND appointmentdate = '$appointmentdate'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        // If the user already has an appointment on the selected date
        $msg_error = 'You have already requested an appointment on that date.';
    } else {
        // If the user doesn't have an appointment on the selected date, proceed to book the appointment
        // Check if there are any appointments for the same doctor on the same date
        $check_doctor_sql = "SELECT COUNT(*) as num_doctor_appointments FROM appointments WHERE doctorid = '$doctorid' AND appointmentdate = '$appointmentdate'";
        $check_doctor_result = mysqli_query($conn, $check_doctor_sql);
        $row = mysqli_fetch_assoc($check_doctor_result);
        $turn = $row['num_doctor_appointments'] + 1; // Incrementing by 1 for the new appointment

        // Insert data into the appointments table
        $sql = "INSERT INTO appointments (patientid, doctorid, appointmentdate, turn, status, comments) 
                VALUES ('$patientid', '$doctorid', '$appointmentdate', '$turn', 'Pending', '$comments')";

        if (mysqli_query($conn, $sql)) {
            header('Location: booking-success.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
// Close the database connection
$conn->close();
?>


<!-- Main Content -->
<div class="container">
    <div class="appointment-content">
        <div class="form-container">
            <div class="card-body">
                <div class="booking-doc-info">
                        <img src="<?php echo $photoPath; ?>" alt="<?php echo $fullName; ?>">
                    <div class="booking-info">
                        <h4>Dr. <?php echo $fullName; ?></h4>
                        <p class="speciality"><?php echo $speciality; ?></p>
                        <p class="speciality"><i class='far fa-clock'></i> Available on <?php echo $workdays; ?></p>
                    </div>
                </div>
            </div>

            <form action="appointment.php?doctorid=<?php echo $doctorid; ?>" method="post">
                <label for="appointmentdate" class="form-label">Appointment Date:</label>
                <input type="date" id="appointmentdate" name="appointmentdate" min="<?php echo date('Y-m-d'); ?>" onkeydown="return false" onclick="this.focus()" required>
                <label for="comments">Comments:</label>
                <textarea id="comments" name="comments" rows="4" cols="50" style="resize: none;"></textarea>
                <input type="submit" value="Book">
                <p><?php echo $msg_error; ?></p>
            </form>
        </div>
        <div class="image-container">
            <img src="assets/img/appointment-banner.png" alt="Image">
        </div>

    </div>
</div>


<script>
  // Define PHP variable in JavaScript
  const dayString = "<?php echo $workdays;?>";

  // Function to get remaining days
  function getRemainingDays(dayString) {
    const dayMapping = {
      "Sun": 0,
      "Mon": 1,
      "Tue": 2,
      "Wed": 3,
      "Thu": 4,
      "Fri": 5,
      "Sat": 6
    };

    const selectedDays = dayString.split(',').map(day => day.trim());
    const selectedDayNumbers = selectedDays.map(day => dayMapping[day]);

    const allDays = [0, 1, 2, 3, 4, 5, 6];
    const remainingDays = allDays.filter(day => !selectedDayNumbers.includes(day));

    return remainingDays;
  }

  // Array of disabled days
  const disabledDays = getRemainingDays(dayString);

  // Function to check if a date is a disabled day
  function isDisabledDay(date) {
    const day = date.getDay(); // Using getDay directly, no need to create a new Date object
    return disabledDays.includes(day);
  }

  const inputDate = document.getElementById('appointmentdate');
  // Event listener for date change
  inputDate.addEventListener('change', function() {
    const selectedDate = new Date(this.value);
    if (isDisabledDay(selectedDate)) {
      alert("The doctor is not available on this date. Please choose another date.");
      this.value = ""; // Clear the input value
    }
  });
</script>


  <!-- Footer -->
  <?php require_once 'footer.php'; ?>