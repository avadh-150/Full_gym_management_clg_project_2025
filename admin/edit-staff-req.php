<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}
?>

<!-- Visit codeastro.com for more projects -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>

</head>

<body>

    <!--Header-part-->
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>
    <!--close-Header-part-->

    <!--top-Header-menu-->
    <?php include 'includes/topheader.php' ?>

    <!-- Visit codeastro.com for more projects -->
    <!--sidebar-menu-->
    <?php $page = 'staff-management';
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="staffs.php">Trainers</a> <a href="staffs-entry.php" class="current">Trainer Entry</a> </div>
            <h1 class="text-center">GYM's Trainers <i class="fas fa-users"></i></h1>
        </div>

        <form role="form" action="index.php" method="POST"></form>
        <?php
        include 'dbcon.php';

        if (isset($_POST['submit'])) {
            // Retrieve and sanitize form data
            $id = mysqli_real_escape_string($con, $_POST["tid"]);
            $fullname = mysqli_real_escape_string($con, $_POST["fullname"]);
            $email = mysqli_real_escape_string($con, $_POST["email"]);
            $specialization = mysqli_real_escape_string($con, $_POST["specialization"]);
            $experience = mysqli_real_escape_string($con, $_POST["experience"]);
            $gender = mysqli_real_escape_string($con, $_POST["gender"]);
            $phone = mysqli_real_escape_string($con, $_POST["contact"]);
            $salary = mysqli_real_escape_string($con, $_POST["amount"]);
            $dor = mysqli_real_escape_string($con, $_POST["dor"]);
            $status = mysqli_real_escape_string($con, $_POST["status"]);
            $hours = mysqli_real_escape_string($con, $_POST["working_hours"]);

            // Directories for uploads
            $upload_dir = "uploads/trainers/";
            $qualification_dir = "uploads/trainers/qualifications/";

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            if (!is_dir($qualification_dir)) {
                mkdir($qualification_dir, 0777, true);
            }

            $update_query = "UPDATE trainers SET 
                    name='$fullname', 
                    email='$email', 
                    specialization='$specialization', 
                    experience='$experience', 
                    gender='$gender', 
                    phone='$phone', 
                    salary='$salary', 
                    joining_date='$dor', 
                    working_hours='$hours', 
                    status='$status' 
                    WHERE id='$id'";

            // Execute the main update query
            if (!mysqli_query($con, $update_query)) {
                echo "<script>alert('Error updating trainer details.');</script>";
            }

            // File upload logic
            $file_updated = false;

            // Handle Image Upload
            if (!empty($_FILES["image"]["name"])) {
                $image_name = $_FILES["image"]["name"];
                $image_tmp_name = $_FILES["image"]["tmp_name"];
                $image_path = $upload_dir . $image_name;

                if (move_uploaded_file($image_tmp_name, $image_path)) {
                    $image_update = "UPDATE trainers SET image='$image_name' WHERE id='$id'";
                    mysqli_query($con, $image_update);
                    $file_updated = true;
                }
            }

            // Handle Qualification Upload
            if (!empty($_FILES["qualification"]["name"])) {
                $qualification_name = $_FILES["qualification"]["name"];
                $qualification_tmp_name = $_FILES["qualification"]["tmp_name"];
                $qualification_path = $qualification_dir . $qualification_name;

                if (move_uploaded_file($qualification_tmp_name, $qualification_path)) {
                    $qualification_update = "UPDATE trainers SET qualification='$qualification_name' WHERE id='$id'";
                    mysqli_query($con, $qualification_update);
                    $file_updated = true;
                }
            }

            // Success message
            if (mysqli_affected_rows($con) > 0 || $file_updated) {

                echo "<div class='container-fluid'>";
                echo "<div class='row-fluid'>";
                echo "<div class='span12'>";
                echo "<div class='widget-box'>";
                echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
                echo "<h5>Message</h5>";
                echo "</div>";
                echo "<div class='widget-content'>";
                echo "<div class='error_ex'>";
                echo "<h1>Success</h1>";
                echo "<h3>Trainer details has been added!</h3>";
                echo "<p>The requested trainer details are added to database. Please click the button to go back.</p>";
                echo "<a class='btn btn-inverse btn-big'  href='staffs.php'>Go Back</a> </div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            } else {


                echo "<div class='container-fluid'>";
                echo "<div class='row-fluid'>";
                echo "<div class='span12'>";
                echo "<div class='widget-box'>";
                echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
                echo "<h5>Error Message</h5>";
                echo "</div>";
                echo "<div class='widget-content'>";
                echo "<div class='error_ex'>";
                echo "<h1 style='color:maroon;'>Error 404</h1>";
                echo "<h3>Error occured while submitting your details</h3>";
                echo "<p>Please Try Again</p>";
                echo "<a class='btn btn-warning btn-big'  href='staffs.php'>Go Back</a> </div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<script>alert('Invalid request!');</script>";
        }
        ?>
        </form>
    </div>
    </div>
    </div>

    </div>
    <!--Footer-part-->
    <div class="row-fluid">
        <div id="footer" class="span12"> <?php echo date("Y"); ?> &copy; Developed By GYM FITNESS CLUB CENTER</a> </div>
    </div>

    <style>
        #footer {
            color: white;
        }
    </style><!-- Visit codeastro.com for more projects -->
    <!--end-Footer-part-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.ui.custom.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.validate.js"></script>
    <script src="../js/jquery.wizard.js"></script>
    <script src="../js/matrix.js"></script>
    <script src="../js/matrix.wizard.js"></script>
</body>

</html>