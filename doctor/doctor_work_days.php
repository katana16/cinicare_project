<?php
    require_once 'check_doctor_login.php';
    $pageTitle = "Working days";
    require_once 'header.php';


$color = $msg = '';
?>


<?php
    $doctorid = $_SESSION['doctorid'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the doctor ID and checked days from the form
        $days = isset($_POST['days']) ? implode(', ', $_POST['days']) : '';
        
        // Update the working days for the doctor in the database
        $sql = "UPDATE doctors SET workdays = '$days' WHERE doctorid = '$doctorid'";

        if ($conn->query($sql) === TRUE) {
            $color = "#26af48";
            $msg = 'Working days updated successfully!';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }

    }
    $sql_doc = "SELECT * FROM doctors WHERE doctorid='$doctorid'";
    $result_doc = $conn->query($sql_doc);
    $doc = $result_doc->fetch_assoc();
    $workdays= $doc['workdays'];
?>


<div class="dashboard">
    <div class="row">

        <!-- SideBar -->
        <?php require_once 'doctor_menu.php'; ?>
        <!-- End SideBar -->

        <!-- Content -->
        <div class="col-lg-10 ">
            <section id="content">
                    <!-- Main -->
                    <main>
                        <div class="container">
                            <div class="head-title">
                                <h1>Working days</h1>
                            </div>
                            

                            <div class="all-list list box">
                                <div class="box-head head">
                                    <h3>Select Work Days:</h3> <p id="message" style="color: <?php echo $color; ?>;"><?php echo $msg; ?></p>
                                </div>
                                <div class="setting-form">


                                    <form action="" method="post" class="mt-4">
                                        <div class="form-group">
                                            <div class="d-flex flex-wrap justify-content-between">
                                                <div class="day-box flex-grow-1">
                                                    <input class="btn-check" type="checkbox" id="sunday" name="days[]" value="Sun" autocomplete="off">
                                                    <label class="btn btn-outline-secondary day-label w-100" for="sunday">Sunday</label>
                                                </div>
                                                <div class="day-box flex-grow-1">
                                                    <input class="btn-check" type="checkbox" id="monday" name="days[]" value="Mon" autocomplete="off">
                                                    <label class="btn btn-outline-secondary day-label w-100" for="monday">Monday</label>
                                                </div>
                                                <div class="day-box flex-grow-1">
                                                    <input class="btn-check" type="checkbox" id="tuesday" name="days[]" value="Tue" autocomplete="off">
                                                    <label class="btn btn-outline-secondary day-label w-100" for="tuesday">Tuesday</label>
                                                </div>
                                                <div class="day-box flex-grow-1">
                                                    <input class="btn-check" type="checkbox" id="wednesday" name="days[]" value="Wed" autocomplete="off">
                                                    <label class="btn btn-outline-secondary day-label w-100" for="wednesday">Wednesday</label>
                                                </div>
                                                <div class="day-box flex-grow-1">
                                                    <input class="btn-check" type="checkbox" id="thursday" name="days[]" value="Thu" autocomplete="off">
                                                    <label class="btn btn-outline-secondary day-label w-100" for="thursday">Thursday</label>
                                                </div>
                                                <div class="day-box flex-grow-1">
                                                    <input class="btn-check" type="checkbox" id="friday" name="days[]" value="Fri" autocomplete="off">
                                                    <label class="btn btn-outline-secondary day-label w-100" for="friday">Friday</label>
                                                </div>
                                                <div class="day-box flex-grow-1">
                                                    <input class="btn-check" type="checkbox" id="saturday" name="days[]" value="Sat" autocomplete="off">
                                                    <label class="btn btn-outline-secondary day-label w-100" for="saturday">Saturday</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                        <p class="info-show">Available on: <?php echo $workdays; ?></p>


                                </div>
                            </div>
                        </div>
                    </main>
            </section>
        </div>

        <!-- End Content -->
<script>
    function hideMessage() {
        const msgElement = document.getElementById('message');
        if (msgElement) {
            msgElement.style.display = 'none';
        }
    }
    window.onload = function() {
        setTimeout(hideMessage, 3000);
    };
</script>
</div>
</div>

<!-- Footer -->
<?php require_once 'footer.php'; ?>