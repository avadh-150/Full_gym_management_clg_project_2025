<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
  header('location:../index.php');
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

    <form role="form" action="index.php" method="POST">
      <?php

      // include("db_connection.php"); // Ensure database connection
  include "dbcon.php";
      if (isset($_POST['submit'])) {
        // Retrieve and sanitize form data
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

        // Check if email already exists
        $check_query = "SELECT * FROM trainers WHERE email = '$email'";
        $result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($result) > 0) {
          echo "<script>alert('Error: Email already exists!'); window.location.href='staffs-entry.php';</script>";
          exit();
        } else {
          // File Upload Handling
          $upload_dir = "uploads/trainers/";
          $qualification_dir = "uploads/trainers/qualifications/";

          // Ensure directories exist
          if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
          }
          if (!is_dir($qualification_dir)) {
            mkdir($qualification_dir, 0777, true);
          }

          // Handle Image Upload
          $image_name = $_FILES["image"]["name"];
          $image_tmp_name = $_FILES["image"]["tmp_name"];
          $image_path = $upload_dir . $image_name;

          // Handle Qualification Upload
          $qualification_name = $_FILES["qualification"]["name"];
          $qualification_tmp_name = $_FILES["qualification"]["tmp_name"];
          $qualification_path = $qualification_dir . $qualification_name;

          // Move uploaded files
          if (move_uploaded_file($image_tmp_name, $image_path) && move_uploaded_file($qualification_tmp_name, $qualification_path)) {

            // Insert into database
            $insert_query = "INSERT INTO trainers (name, email, phone, specialization, experience, gender, joining_date, working_hours, qualification, image, salary, status) 
                           VALUES ('$fullname', '$email', '$phone', '$specialization', '$experience', '$gender', '$dor', '$hours', '$qualification_name', '$image_name', '$salary', '$status')";

            $result = mysqli_query($con, $insert_query);
            echo "<script>alert('Trainer added successfully!');</script>";
            if (!$result) {
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
            } else {

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
            }
          } else {
            echo "<script>alert('File upload failed!');</script>";
          }
        }

        mysqli_close($con);
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