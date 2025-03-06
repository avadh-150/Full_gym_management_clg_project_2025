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
<?php $page = 'schedule'; include 'includes/sidebar.php'; ?>

<div id="content">
    <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="current">Schedules <i class="fa-solid fa-calendar-days"></i></a> </div>

        <h1>Schedule Updated</h1>
    </div>
    <form role="form" action="" method="POST" enctype="multipart/form-data">
    <?php
   if (isset($_POST['update_schedule'])) {
    $schedule_id = $_POST['schedule_id'];
    $schedule_name = mysqli_real_escape_string($con, $_POST['name']);
    $schedule_day = mysqli_real_escape_string($con, $_POST['days']);
    $trainer_id = mysqli_real_escape_string($con, $_POST['trainer_id']);
    $start_time = mysqli_real_escape_string($con, $_POST['stime']);
    $end_time = mysqli_real_escape_string($con, $_POST['etime']);

    $query = "UPDATE schedule SET 
                schedule_name = '$schedule_name', 
                schedule_day = '$schedule_day', 
                trainer_id = '$trainer_id', 
                start_time = '$start_time', 
                end_time = '$end_time' 
              WHERE schedule_id = '$schedule_id'";

                $result = mysqli_query($con, $query);

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
                                            <h3>Error occurred while Update Schedule details</h3>
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
                                            <h3>Schedule details have been Updated!</h3>
                                            <p>The requested details are updates. Please click the button to go back.</p>
                                            <a class='btn btn-inverse btn-big' href='schedule.php'>Go Back</a>
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
