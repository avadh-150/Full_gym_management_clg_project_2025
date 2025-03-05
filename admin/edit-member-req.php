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

  <!-- Visit codeastro.com for more projects -->
  <!--top-Header-menu-->
  <?php include 'includes/topheader.php' ?>
  <!--close-top-Header-menu-->
  <!--start-top-serch-->
  <!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
  <!--close-top-serch-->

  <!--sidebar-menu-->
  <?php $page = 'members-update';
  include 'includes/sidebar.php' ?>
  <!--sidebar-menu-->
  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Manamge Members</a> <a href="#" class="current">Add Members</a> </div>
      <h1>Update Member Details</h1>
    </div>
    <form role="form" action="index.php" method="POST">
      <?php

      include 'dbcon.php';

      if (isset($_POST["book_plan"])) {
        $member_id = mysqli_real_escape_string($con, $_POST['member_id']);
        $full_name = mysqli_real_escape_string($con, $_POST['fullname']);
        $dor = mysqli_real_escape_string($con, $_POST['dor']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $occupation = mysqli_real_escape_string($con, $_POST['Occupation']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $trainer_id = mysqli_real_escape_string($con, $_POST['trainer_id']);

        // Fetch existing image path
        $query_get_image = "SELECT image FROM users WHERE member_id = '$member_id'";
        $result_image = mysqli_query($con, $query_get_image);
        $row = mysqli_fetch_assoc($result_image);
        $existing_image = $row['image'];

        // Handle File Upload
        if (!empty($_FILES['image']['name'])) {
          $image = $_FILES['image']['name'];
          $image_tmp = $_FILES['image']['tmp_name'];
          $upload_dir = "admin/uploads/profiles/";
          $image_path = $upload_dir . basename($image);

          // Ensure upload directory exists
          if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
          }

          if (move_uploaded_file($image_tmp, $image_path)) {
            $final_image = $image_path; // Use new image
          } else {
            $final_image = $existing_image; // Keep old image if upload fails
          }
        } else {
          $final_image = $existing_image; // No new image uploaded, keep old one
        }

        // Update Query
        $query = "UPDATE users SET 
                    full_name = '$full_name',
                    mobile = '$phone', 
                    gender = '$gender', 
                    address = '$address', 
                    image = '$final_image', 
                    occupation = '$occupation',
                    trainer_id = '$trainer_id',
                    join_date = '$dor',
                    email = '$email'
                    WHERE member_id = '$member_id'";

        $result = mysqli_query($con, $query);

        if (!$result) {
          echo "<div class='container-fluid'>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='widget-box'>
                                        <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                            <h5>Error Message</h5>
                                        </div>
                                        <div class='widget-content'>
                                            <div class='error_ex'>
                                                <h1 style='color:maroon;'>Error 404</h1>
                                                <h3>Error occurred while updating details</h3>
                                                <p>Please Try Again</p>
                                                <a class='btn btn-warning btn-big' href='edit-member.php'>Go Back</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>";
        } else {
          echo "<div class='container-fluid'>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='widget-box'>
                                        <div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>
                                            <h5>Message</h5>
                                        </div>
                                        <div class='widget-content'>
                                            <div class='error_ex'>
                                                <h1>Success</h1>
                                                <h3>Member details updated successfully!</h3>
                                                <p>The requested details have been updated.</p>
                                                <a class='btn btn-inverse btn-big' href='members.php'>Go Back</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>";
        }
      } else {
        echo "<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='index.php'>DASHBOARD</a></h3>";
      } ?>


    </form>
  </div>
  </div>
  </div>
  </div>

  <!--end-main-container-part-->

  <!--Footer-part-->
  <!-- Visit codeastro.com for more projects -->
  <div class="row-fluid">
    <div id="footer" class="span12"> <?php echo date("Y"); ?> &copy; Developed By GYM FITNESS CLUB CENTER</a> </div>
  </div>

  <style>
    #footer {
      color: white;
    }
  </style>

  <!--end-Footer-part-->

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

  <script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage(newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

        // if url is "-", it is this page -- reset the menu:
        if (newURL == "-") {
          resetMenu();
        }
        // else, send page to designated URL            
        else {
          document.location.href = newURL;
        }
      }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
      document.gomenu.selector.selectedIndex = 2;
    }
  </script>
</body>

</html>