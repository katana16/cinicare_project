<?php
    require_once 'check_patient_login.php';
    $pageTitle = "Turn Tracker";
    require_once 'header.php';


$doctorid = $_GET['doctorid'];
$appointmentid = $_GET['appointmentid'];
$photopath = $fullName = $speciality = "";
$sql_doc = "SELECT firstname, lastname, photo_path, speciality FROM doctors WHERE doctorid = $doctorid";
$result_doc = $conn->query($sql_doc);
$doc = $result_doc->fetch_assoc();
    $fullName = $doc["firstname"] . " " . $doc["lastname"];
    $photoPath = $doc["photo_path"];
    $speciality = $doc["speciality"];

$current_date = date("Y-m-d");
$patientid = $_SESSION['patientid'];
$sql_patapp = "SELECT * FROM `appointments` WHERE appointmentdate='$current_date' AND appointmentid='$appointmentid'";
$result_patapp = mysqli_query($conn,$sql_patapp);
$patapp = $result_patapp->fetch_assoc();
$patapp_status = $patapp['status'];
$patapp_turn = $patapp['turn'];


if ($patapp_status == "Pending" || $patapp_status == "Cancelled" || $patapp_status == "Completed" ) {
    $patapp_turn = '0';
   }


$sql_turn = "SELECT turn FROM appointments WHERE appointmentdate='$current_date' AND doctorid='$doctorid' AND status = 'Accepted' ORDER BY turn ASC LIMIT 1";
$result_turn = $conn->query($sql_turn);
$row_turn = $result_turn->fetch_assoc();
$first_accepted_turn = $row_turn["turn"];

?>



<style>
.track-content {
    background-color: #f8f9fa;
    padding: 40px 0;
}

.track-content .container {
    padding: 0;
    margin: 20px auto;
}
.track-content .turn-table {
    padding: 0;
}

.card-body {
    border-bottom: 1px solid #dbdbdb;
}
.track-content .col-auto img {
    border-radius: 4px;
    height: 130px;
    width: 130px;
    object-fit: cover;
    margin-right: 15px;
}



        .turn-table table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        .turn-table table th {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd; 
        }

        .turn-table table td {
            padding: 8px;
            border-bottom: 1px solid #ddd; 
        }




</style>


<div class="track-content">
<h1 class="text-center"><strong>Turn Tracker</strong></h1>

    <div class="container " style="max-width: 500px;">
        <!-- Doctor Card -->
        <div class="card text-center">
            <div class="card-header">
                <div class="row align-items-center">
                <!-- Picture on the left -->
                <div class="col-auto">
                    <img src="<?php echo $photoPath; ?>" alt="<?php echo $fullName; ?>" class="card-img-top">
                </div>
                <!-- Doctor name and specialty on the right -->
                <div class="col">
                    <h5 class="card-title">Dr. <?php echo $fullName; ?></h5>
                    <p class="card-text"><?php echo $speciality; ?></p>
                </div>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $current_date; ?></h5>
            </div>
            <div class="card-body">
                <div class="row">
                <!-- Your Turn on the left -->
                <div class="col">
                    <h5 class="card-title">Your N°: <?php echo $patapp_turn; ?></h5>
                </div>
                <!-- Current Turn on the right -->
                <div class="col">
                    <h5 class="card-title">Current N°: <?php echo $first_accepted_turn; ?></h5>
                </div>
                </div>
            </div>
            <!-- Table of Turn and Appointment Status -->
            <div class="turn-table mt-4">
                <?php 
                    $sql_app = "SELECT * FROM `appointments` WHERE appointmentdate='$current_date' AND doctorid='$doctorid' ORDER BY turn";
                    $result_app = mysqli_query($conn,$sql_app);
                    $appnumRows = mysqli_num_rows($result_app);       
                    if($appnumRows){
                        if($result_app){
                            echo '
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Turn</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            ';
                                while($user = mysqli_fetch_assoc($result_app)) {
                                    $turn = $user['turn'];
                                    $status = $user['status'];
                                    $style ='';
                                    if ($turn == $first_accepted_turn) {
                                        $style= 'style="background-color: #0fb76b42"';

                                    } else if ($turn == $patapp_turn &&  $status == 'Accepted') {
                                        $style= 'style="background-color: #9ce0ff"';
                                    }

                                    echo '
                                        <tr '.$style.'>
                                        <td>'.$turn.'</td>
                                        <td>'.$status.'</td>
                                        </tr>                                            
                                    ';
                                }

                            echo '
                                    </tbody>
                                </table>
                            ';
                        }
                    }   else {
                            echo'There is No Appointment This Day';
                        }

                    // Close connection
                    $conn->close();
                ?>
            </div>
        </div>


        <!-- Back Button -->
        <div class="mt-4">
        <button onclick="goBack()" class="btn btn-secondary w-100">Back</button>
        </div>
    </div>
</div>

<script type="text/javascript">
     // Back Script 
    function goBack() {
      window.history.back();
    }

    // Reload the page every 5 seconds (5000 milliseconds)
    setInterval(function() {
        location.reload();
    }, 5000);
</script>



<!-- Footer -->
<?php require_once 'footer.php'; ?>