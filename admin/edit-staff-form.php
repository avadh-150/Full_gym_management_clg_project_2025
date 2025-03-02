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
<?php include "includes/header.php";?>

</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<!--close-Header-part--> 

<!-- Visit codeastro.com for more projects -->
<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>

<?php $page='staff-management'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<?php
include 'dbcon.php';
$id=$_GET['id'];
$qry= "select * from trainers where id='$id'";
$result=mysqli_query($conn,$qry);
while($row=mysqli_fetch_array($result)){
?> 

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="staffs.php" class="tip-bottom"> Trainers</a> <a href="edit-staff-form.php" class="current">Edit Trainer Records</a> </div>
  <h1 class="text-center">Update Trainer's Detail <i class="fas fa-users"></i></h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Trainer-Details</h5>
        </div>
        <div class="widget-content nopadding">

          <form action="edit-staff-req.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
          <div class="control-group">
              <label class="control-label">Full Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="fullname"  value="<?php echo $row['name']; ?>" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Qualification Certificate:</label>
              <div class="controls">
                <input type="file" class="span11" name="qualification" placeholder="Qualification" value="<?php echo $row['qualification']; ?>" />
                <?php if($row['qualification'] != ''): ?>
                <img src="uploads/trainers/qualifications/<?php echo $row['qualification']; ?>" width="100" height="100" />
                <?php endif; ?>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Specialization :</label>
              <div class="controls">
                <input type="text"  class="span11" name="specialization" placeholder="Specialization" value="<?php echo $row['specialization']; ?>" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Experience :</label>
              <div class="controls">
                <input type="text"  class="span11" name="experience" placeholder="e.g 2 for 2 years" value="<?php echo $row['experience']; ?>" />
                <span class="help-block">Note: Experience in years </span>

              </div>
            </div>
           
            <div class="control-group">
              <label class="control-label">Gender :</label>
              <div class="controls">
              <select name="gender" required="required" id="select">
                  <option value="Male" selected="selected">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">D.O.R :</label>
              <div class="controls">
                <input type="date" name="dor" value="<?php echo $row['joining_date']; ?>" class="span11" />
                <span class="help-block">Date of registration</span> </div>
            </div>
            
          
        </div>
     
        
        <div class="widget-content nopadding">
          <div class="form-horizontal">
          
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
            <div class="control-group">
              <label for="normal" class="control-label">Working Hours: </label>
              <div class="controls">
                <input type="text" class="span11" name="working_hours" placeholder="Working Hours" value="<?php echo $row['working_hours']; ?>"/>
              </div>
              

            </div>
            <div class="control-group">
              
              
            </div>
          </div>

          </div>



        </div>
      </div>
	  
	
    </div>

    
    
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Contact Details</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
            <div class="control-group">
              <label for="normal" class="control-label">Contact Number</label>
              <div class="controls">
                <input type="number" id="mask-phone" name="contact" placeholder="9876543210" class="span8 mask text" value="<?php echo $row['phone']; ?>">
                <span class="help-block blue span8">(999) 999-9999</span> 
                </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="text" class="span11" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Image :</label>
              <div class="controls">
                <?php if($row['image'] != ''): ?>
                  <input type="file" class="span11" name="image" placeholder="Image" value="<?php echo $row['image']; ?>" />
                <img src="uploads/trainers/<?php echo $row['image']; ?>" width="50" height="50" />
                <?php endif;?>
              </div>
            </div>
          </div>

              <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
          <h5>Service Details</h5>
        </div>
        <div class="widget-content nopadding">
          <div class="form-horizontal">
            
            
            

            <div class="control-group">
              <label class="control-label">Salary</label>
              <div class="controls">
                <div class="input-append">
                  <span class="add-on">₹</span> 
                  <input type="number" placeholder="e.g Salary in per month 10000" name="amount" class="span11" value="<?php echo $row['salary']; ?>">

                  </div>
              </div>
            </div>
            <div class="control-group">

              <label class="control-label">Status</label>
              <div class="controls">
                <select name="status" required="required" id="select">
                  <option value="1" selected="selected">Active</option>
                  <option value="0">Inactive</option>

                </select>
              </div>
          
            
            <div class="form-actions text-center">
              <input type="hidden" name="tid" value="<?php echo $row['id']; ?>">
              <button type="submit" name="submit" class="btn btn-success">Submit Trainer Details</button>
            </div>
            </form>

          </div>
<?php
}
?>


        </div>

        </div>
      </div>

	
  </div>
  
  <div class="row-fluid">
   
  </div>
</div>

<!-- Visit codeastro.com for more projects -->
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

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
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