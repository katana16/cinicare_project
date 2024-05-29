<?php
    $pageTitle = "Contact Us";
    require_once 'header.php';
    
    $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
    unset($_SESSION['msg']);
?>

        <!-- Content -->
<div class="container-fluid content-wrapper">
    <div class="container">



        <div class="record-content">
            <h1 class="text-center"><strong>Contact Us</strong></h1>

            <form id="contactForm" action="send_email_fonction.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!-- Popup message -->
<?php if (!empty($msg)): ?>
    <div id="popup" class="alert <?php echo strpos($msg, 'Failed') !== false ? 'alert-danger' : 'alert-success'; ?> position-fixed end-0 m-3" style="top: 100px; opacity: 1; transition: opacity 0.5s ease-in-out;" role="alert">
    <?php echo $msg; ?>
</div>
<?php endif; ?>

<script>
    // Hide the popup after 5 seconds
    setTimeout(function() {
        var popup = document.getElementById('popup');
        if (popup) {
            popup.style.opacity = '0';
            // Remove the popup from the DOM after the fade-out animation is complete
            setTimeout(function() {
                popup.remove();
            }, 1000);
        }
    }, 4000);
</script>




<!-- Footer -->
<?php require_once 'footer.php'; ?>

