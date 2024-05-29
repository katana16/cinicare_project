
<?php
    require_once 'check_admin_login.php'; 
    $pageTitle = "Secretary List";
    require_once 'header.php'; 
?>

<?php 
if(isset($_GET['action']) && ($_GET['action']=='del')){
    $id = $_GET['id'];

    $sql_delete = "DELETE FROM `secretary` WHERE secretaryid=$id";
    $res_delete = mysqli_query($conn,$sql_delete);
    if($res_delete){
            header("location:admin_secretary.php");
    }else {
        die(mysqli_error($conn));
    }
}

?>

<div class="dashboard">
    <div class="row">

        <?php require_once 'admin_menu.php'; ?>

        <!-- Content -->
        <div class="col-lg-10 ">
            <section id="content">
                <!-- Main -->
                <main>
                    <div class="container">
                        <div class="head-title">
                            <h1>Our Secretary</h1>
                        </div>

                        <div class="all-list secretary-list">
                            <div class="list">
                                <div class="head">
                                    <h3>Secretary</h3>
                                        <a href="admin_add_sec.php" title="Add Secretary" class="add"><i class="fa-solid fa-user-plus"></i></a>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php   
                                $sql_read = "SELECT * FROM `secretary`";
                                $res_read = mysqli_query($conn,$sql_read);
                                if($res_read){
                                    while($secretary = mysqli_fetch_assoc($res_read)){
                                        $id = $secretary['secretaryid'];
                                        $name = $secretary['firstname'] . ' ' . $secretary['lastname'];

                                        echo '
                                        <tr>
                                            <td>'.$id.'</td>
                                            <td>'.$name.'</td>
                                            <td>
                                                <button class="edit"><a href="admin_update_sec.php?updateid='.$id.'">
                                                <i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                                </button>
                                                
                                                <button onclick="confirme_delete('.$id.')" class="delete">
                                                <i class="fa-regular fa-trash-can"></i> Delete
                                                </button>

                                                <button class="info"><a href="admin_information_sec.php?infoid='.$id.'">
                                                <i class="fa-regular fa-circle-user"></i> Info</a>
                                                </button>
                                            </td>
                                        </tr>
                                        
                                        ';
                                    }
                                }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- End Main -->
            </section>
        <script src="assets/js/alert_sec.js"></script>
        </div>
        <!-- End Content -->

    </div>
</div>

  <!-- Footer -->
  <?php require_once 'footer.php'; ?>