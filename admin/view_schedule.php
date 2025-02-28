<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>
<!-- Visit codeastro.com for more projects -->
<!DOCTYPE html>
<html lang="en">
<head>
<title>Gym System Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/fullcalendar.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <!-- <link href="../font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="../css/jquery.gritter.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900|Montserrat:400,500,700,900" rel="stylesheet"> -->
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<!-- CSS for full calender -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />
<!-- JS for jQuery<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/> -->


</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<?php include 'includes/topheader.php'?>

<?php $page="schedules"; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="current">Schedules</a> </div>
    <h1 class="text-center">Schedule <i class="fa-solid fa-calendar-days"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Schedule Table</h5>
          </div>
          <div class='widget-content nopadding'>
	  
          <?php

include "dbcon.php";
$qry = "select * from schedule";
$cnt = 1;
$result = mysqli_query($con, $qry);
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Classes</th>
            <th>Starting Date / Time</th>
            <th>Ending Date / Time</th>
            <th>Created</th>
            <th>Edit / Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td>
                    <div class='text-center'><?= $row['schedule_id'] ?></div>
                </td>
                <td>
                    <div class='text-center'><?= htmlspecialchars($row['schedule_name']) ?></div>
                </td>
                <td>
                    <div class='text-center'><?= htmlspecialchars($row['start_date']) ?></div>
                </td>
                <td>
                    <div class='text-center'><?= htmlspecialchars($row['end_date']) ?></div>
                </td>
                <td>
                    <div class='text-center'><?= $row['created_at'] ?>
                </td>
                <td>
                <!--
                  <div class='text-center'><a href='schedules.php' style='color:#F66;'><i class='fas fa-trash'></i> </a></div> -->
                      <div class='text-center'><a href='schedules.php'><i class='fas fa-edit'></i> Take a action</a></div>
</td>
               
            </tr>
        <?php endwhile; ?>
        <?php if (mysqli_num_rows($result) === 0): ?>
            <tr>
                <td colspan="7" class="text-muted">No queries found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


          </div>
        </div>
   

		
	
      </div>
    </div>
  </div>
</div>

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Developed By GYM FITNESS CLUB CENTER</a> </div>
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
</body>

</html>
