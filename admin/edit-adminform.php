<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:login.php');	
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


<!--top-Header-menu-->
<?php include 'includes/topheader.php'?>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!-- <div id="search">
  <input type="hidden" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch-->

<!--sidebar-menu-->
<?php $page='admins-update'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<?php
include 'dbcon.php';
$id=$_GET['id'];
$qry= "select * from admin where a_id='$id'";
$result=mysqli_query($con,$qry);
while($row=mysqli_fetch_array($result)){
?> 
<!-- Visit codeastro.com for more projects -->
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="admins.php" class="tip-bottom">Manamge Admin</a> <a href="#" class="current">Update admin</a> </div>
  <h1>Update Admin Details</h1>
</div>
<div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                            <h5>Personal-info</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="edit-admin-req.php" method="POST" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">Name</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="name" placeholder="Fullname" value="<?php echo $row['username']?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email :</label>
                                    <div class="controls">
                                        <input type="email" class="span11" name="email" placeholder="email" value="<?php echo $row['email']?>"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Password :</label>
                                    <div class="controls">
                                        <input type="password" class="span11" name="password" placeholder="**********" value="<?php echo $row['password']?>" readonly/>
                                        <span class="help-block">Note: The given information will create an account for this particular admin</span>
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
                                        <input type="number" id="mask-phone" name="contact" value="<?php echo $row['contact']?>" class="span8 mask text">
                                        <span class="help-block blue span8">+91(999) 999-9999</span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Street :</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="street" value="<?php echo $row['street']?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">City :</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="city" value="<?php echo $row['city']?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">State :</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="state" value="<?php echo $row['state']?>" />
                                    </div>
                                </div>
                            </div>

            <div class="form-actions text-center">
             <!-- user's ID is hidden here -->
             <input type="hidden" name="id" value="<?php echo $row['a_id'];?>">
              <button type="submit" name="submit-btn" class="btn btn-success">Update Admin Details</button>
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
  
  
</div></div>


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