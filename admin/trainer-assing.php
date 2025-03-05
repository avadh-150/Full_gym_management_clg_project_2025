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
<?php include "includes/header.php"; ?>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!-- Visit codeastro.com for more projects -->
<!--sidebar-menu-->
<?php $page='trainer-assing'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> 
            <a href="#" class="tip-bottom"><i class="fas fa-home"></i> Home</a> 
            <a href="staffs.php" class="current">Members</a>  
            <a href="#" class="current">Assing Trainer to Members</a>
        </div>
            <h1 class="text-center">GYM's Assing Trainers List <i class="fas fa-briefcase"></i></h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <!-- <a href="staffs-entry.php"><button class="btn btn-primary">Add Trainers</button></a> -->
      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Trainers table</h5>
          </div>
          <div class='widget-content nopadding'>
	  
	  <?php

      include "dbcon.php";
      $qry="select t.*,t.name as fullname,t.image as img,u.* from trainers t ,users u where t.id=u.trainer_id ";
      $cnt=1;
        $result=mysqli_query($con,$qry);

        
          echo"<table class='table table-bordered table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Trainer Name</th>
                  <th>Member ID</th>
                  <th>Member Name</th>
                 
                  <th>Specialization</th>
                
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>";
              
            while($row=mysqli_fetch_array($result)){
            
            echo"<tbody> 
                <tr class=''>
                <td><div class='text-center'>".$cnt."</div></td>
                <td><img src='uploads/trainers/".$row['img']."' width='50' height='50' class='text-center'/></td>
                <td><div class='text-center'>".$row['fullname']."</div></td>
                <td><div class='text-center'>".$row['member_id']."</div></td>
                <td><div class='text-center'>".$row['full_name']."</div></td>

                <td><div class='text-center'>".$row['specialization']."</div></td>
               
                <td><div class='badge badge-success text-center'>".$row['status']."</div></td>
             
                <td><div class='text-center'><a href='edit-staff-form.php?id=".$row['id']."'><i class='fas fa-edit' style='color:#28b779'></i>  <br></a> <a href='r-staff.php?id=".$row['id']."' style='color:#F66;'><i class='fas fa-trash'></i> </a></div></td>
                </tr>
                
              </tbody>";
              $cnt++;
          }
            ?>

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
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>
</body>
</html>
