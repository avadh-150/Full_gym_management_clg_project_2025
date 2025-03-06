<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>
<?php include "includes/header.php"?>
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
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="current">Schedules <i class="fa-solid fa-calendar-days"></i></a> </div>
    <!-- <h1 class="text-center">Schedule </h1> -->
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Schedule Table</h5>
            <a href="add-schedules.php" style="float: right; margin:5px 40px;"><button class="btn btn-primary">
        <b>
          Add<i class="fa-solid fa-plus"></i>
          
        </b>
      </button></a>

          </div>
          <div class='widget-content nopadding'>
	  
          <?php

include "dbcon.php";
$qry = "select s.*,t.* from schedule s,trainers t where s.trainer_id=t.id ORDER BY schedule_id desc";
$cnt = 1;
$result = mysqli_query($con, $qry);
?>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Day</th>
            <th>Classes</th>
            <th>Trainer</th>
            <th>Start Time</th>
            <th>Ending Time</th>
            <th>Posted Date</th>
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
                    <div class='text-center'><?= htmlspecialchars($row['schedule_day']) ?></div>
                </td>
                <td>
                    <div class='text-center'><?= htmlspecialchars($row['schedule_name']) ?></div>
                </td>
                <td>
                    <div class='text-center'><?= htmlspecialchars($row['name']) ?></div>
                </td>
                <td>
                    <div class='text-center'><?= htmlspecialchars($row['start_time']) ?></div>
                </td>
                <td>
                    <div class='text-center'><?= htmlspecialchars($row['end_time']) ?></div>
                </td>
                <td>
                    <div class='text-center'><?= $row['created_at'] ?>
                </td>
                <td>
                
                  <div class='text-center'><a href='edit-schedule.php?id=<?php echo $row['schedule_id']?>' class="text-success"><i class='fas fa-edit'></i> </a> | <a href='schedules.php' style='color:#F66;'><i class='fas fa-trash'></i> </a></div>
                      <!-- <div class='text-center '><a href='schedules.php' class="text-success"><i class='fas fa-edit'></i> </a></div> -->
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
