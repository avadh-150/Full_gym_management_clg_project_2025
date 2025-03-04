<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "includes/header.php";?>

</head>
<body>
<!-- Header -->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>

<!-- Top Header Menu -->
<?php include 'includes/topheader.php'; ?>

<!-- Sidebar Menu -->
<?php $page = 'plans-entry'; include 'includes/sidebar.php'; ?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="plans.php" class="tip-bottom">Manage Plans</a>
            <a href="#" class="current">Add Plans</a>
        </div>
        <h1>Plans Entry Form</h1>
    </div>
    <form role="form" action="" method="POST" enctype="multipart/form-data">
    <?php
    if (isset($_POST['submit-btn']) ) {
        include 'dbcon.php';

        // Form data
        $pname = $_POST['name'];
        $duration = $_POST['duration'];
        $price = $_POST['price'];
        $feature = $_POST['feature'];
        $type = $_POST['type'];

        // File upload directory
       
                // Insert query
                $qry = "INSERT INTO membership_plans (plan_name,type, duration, price, features) 
                        VALUES ('$pname','$type','$duration', '$price','$feature')";
                $result = mysqli_query($con, $qry);

                if (!$result) {
                    // Error message
                    echo "
                    <div class='container-fluid'>
                        <div class='row-fluid'>
                            <div class='span12'>
                                <div class='widget-box'>
                                    <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                        <h5>Error Message</h5>
                                    </div>
                                    <div class='widget-content'>
                                        <div class='error_ex'>
                                            <h1 style='color:maroon;'>Error 404</h1>
                                            <h3>Error occurred while entering plan details</h3>
                                            <p>Please try again.</p>
                                            <a class='btn btn-warning btn-big' href='plans.php'>Go Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                } else {
                    // Success message
                    echo "
                    <div class='container-fluid'>
                        <div class='row-fluid'>
                            <div class='span12'>
                                <div class='widget-box'>
                                    <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                        <h5>Message</h5>
                                    </div>
                                    <div class='widget-content'>
                                        <div class='error_ex'>
                                            <h1>Success</h1>
                                            <h3>Plan details have been added!</h3>
                                            <p>The requested details are added. Please click the button to go back.</p>
                                            <a class='btn btn-inverse btn-big' href='plans.php'>Go Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";
                }
            
    }
    ?>
</form>

</div>

<!-- Footer -->
<div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y"); ?> &copy; Developed By GYM FITNESS CLUB CENTER </div>
</div>

<style>
#footer {
    color: white;
}
</style>

<script src="../js/excanvas.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.ui.custom.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.flot.min.js"></script>
<script src="../js/jquery.flot.resize.min.js"></script>
<script src="../js/jquery.peity.min.js"></script>
<script src="../js/fullcalendar.min.js"></script>
<script src="../js/matrix.js"></script>
<script src="../js/matrix.dashboard.js"></script>
<script src="../js/jquery.gritter.min.js"></script>
<script src="../js/matrix.interface.js"></script>
<script src="../js/matrix.chat.js"></script>
<script src="../js/jquery.validate.js"></script>
<script src="../js/matrix.form_validation.js"></script>
<script src="../js/jquery.wizard.js"></script>
<script src="../js/jquery.uniform.js"></script>
<script src="../js/select2.min.js"></script>
<script src="../js/matrix.popover.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/matrix.tables.js"></script>
<script>
function resetMenu() {
    document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
