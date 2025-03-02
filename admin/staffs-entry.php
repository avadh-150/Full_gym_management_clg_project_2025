<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>
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


<!--sidebar-menu-->
<?php $page='staff-management'; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Manamge Trainers</a> <a href="#" class="current">Add trainer</a> </div>
  <h1>Trainers Entry Form</h1>
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
          <form action="added-staffs.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <div class="control-group">
              <label class="control-label">Full Name :</label>
              <div class="controls">
                <input type="text" class="span11" name="fullname" placeholder="Fullname" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Qualification Certificate:</label>
              <div class="controls">
                <input type="file" class="span11" name="qualification" placeholder="Qualification" />
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Specialization :</label>
              <div class="controls">
                <input type="text"  class="span11" name="specialization" placeholder="Specialization"  />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Experience :</label>
              <div class="controls">
                <input type="text"  class="span11" name="experience" placeholder="e.g 2 for 2 years"  />
                <span class="help-block">Note: Experience in years </span>

              </div>
            </div>
            <!-- <div class="control-group">
              <label class="control-label">Password :</label>
              <div class="controls">
                <input type="password"  class="span11" name="password" placeholder="**********"  />
                <span class="help-block">Note: The given information will create an account for this particular member</span>
              </div>
            </div> -->
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
                <input type="date" name="dor" value="<?php echo date('Y-m-d'); ?>" class="span11" />
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
                <input type="text" class="span11" name="working_hours" placeholder="Working Hours" />
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
                <input type="number" id="mask-phone" name="contact" placeholder="9876543210" class="span8 mask text">
                <span class="help-block blue span8">(999) 999-9999</span> 
                </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="text" class="span11" name="email" placeholder="Email" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Image :</label>
              <div class="controls">
                <input type="file" class="span11" name="image" placeholder="Image" />
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
                  <input type="number" placeholder="e.g Salary in per month 10000" name="amount" class="span11">

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
              <button type="submit" name="submit" class="btn btn-success">Submit Trainer Details</button>
            </div>
            </form>

          </div>



        </div>

        </div>
      </div>

	</div>
  </div>
  
  
</div></div>

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
<script src="../js/jquery.validate.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.wizard.js"></script>
</body>
</html>
