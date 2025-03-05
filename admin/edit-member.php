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

  <?php

$sql_trainers = "SELECT * FROM trainers WHERE status='active'";
$result_trainers = mysqli_query($con, $sql_trainers);

  include 'dbcon.php';
  $id = $_GET['id'];
  $qry = "select * from users where member_id='$id'";
  $result = mysqli_query($con, $qry);



  while ($row = mysqli_fetch_array($result)) {



  ?>

    <div id="content">
      <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="tip-bottom">Manamge Members</a> <a href="#" class="current">Add Members</a> </div>
        <h1>Update Member Details</h1>
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

                <form action="edit-member-req.php" method="POST" class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label">Member Number :</label>
                    <div class="controls">
                      <input type="text" class="span11" name="member_id" value='<?php echo $row['member_id']; ?>' readonly />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Member Name :</label>
                    <div class="controls">
                      <input type="text" class="span11" name="fullname" value='<?php echo $row['full_name']; ?>' />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Username :</label>
                    <div class="controls">
                      <input type="text" class="span11" name="username" value='<?php echo $row['name']; ?>' readonly />
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
                    <label class="control-label"> D.O.R :</label>
                    <div class="controls">
                      <input type="date" name="dor" class="span11" value='<?php echo $row['join_date']; ?>' />
                      <span class="help-block">Date of registration</span>
                    </div>
                  </div>


              </div>


              <div class="widget-content nopadding">
                <div class="form-horizontal">

                </div>
                <div class="widget-content nopadding">
                  <div class="form-horizontal">
                    <?php
                    $plan_id = $row['current_plan_id'];
                    $sql = "SELECT * FROM membership_plans WHERE id = $plan_id";
                    $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) <= 0) {
                      header("Location: plan.php");
                      exit();
                    }

                    $plan = mysqli_fetch_assoc($result);
                    ?>
                    <div class="control-group">
                      <label class="control-label">Plan :</label>
                      <div class="controls">
                        <input type="text" class="span11" name="plan" value="<?php echo $plan['plan_name'] ?>" disabled="" />
                      </div>
                    </div>

                    <div class="control-group">
                      <label class="control-label">Duration :</label>
                      <div class="controls">
                        <input type="text" class="span11" aria-disabled="false" name="plan" value="<?php echo $plan['duration'] ?> Day" disabled="" placeholder="**********" />
                        <span class="help-block">Note: The duration in plan is in Day's <br>
                          like 30 means 30 day's
                        </span>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Amount :</label>
                      <div class="controls">
                        <input type="numbers" class="span11" aria-disabled="false" name="plan" value= "₹ <?php echo $plan['price'] ?>" disabled="" />
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
                    <label for="normal" class="control-label">Occupation :</label>
                    <div class="controls">
                      <input type="text" id="mask-phone" name="Occupation" value='<?php echo $row['occupation']; ?>' class="span8 mask text">
                    </div>
                  </div>
                  <div class="control-group">
                    <label for="normal" class="control-label">Email :</label>
                    <div class="controls">
                      <input type="email" id="mask-phone" name="email" value='<?php echo $row['email']; ?>' class="span8 mask text">
                    </div>
                  </div>
                  <div class="control-group">
                    <label for="normal" class="control-label">Contact Number</label>
                    <div class="controls">
                      <input type="number" id="mask-phone" name="phone" value='<?php echo $row['mobile']; ?>' class="span8 mask text">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Address :</label>
                    <div class="controls">
                      <!-- <input type="text"  name="address" placeholder="Address" /> -->
                      <textarea class="span11" name="address" placeholder="Address" id="" value='<?php echo $row['address']; ?>'><?php echo $row['address']; ?></textarea>
                    </div>
                  </div>
                </div>

              
                <div class="widget-content nopadding">
    <div class="form-horizontal">
        <div class="control-group">
            <label class="control-label">Profile Image :</label>
            <div class="controls">
                <input type="file" name="image" class="span11">
                <img src="../<?php echo $row['image']; ?>" alt="" width="100" height="100">
            </div>
        </div>

        <div class="control-group">
            <label for="trainer" class="control-label">Your Personal Trainer</label>
            <div class="controls">
                <select name="trainer_id" id="trainer" >
                    <option value="">-- Choose a Trainer --</option>
                    <?php 
                    while ($trainer = mysqli_fetch_assoc($result_trainers)) :
                        $selected = ($trainer['id'] == $row['trainer_id']) ? 'selected' : ''; 
                    ?>
                        <option value="<?php echo $trainer['id']; ?>" <?php echo $selected; ?>>
                            <?php echo htmlspecialchars($trainer['name']) . " (" . $trainer['specialization'] . ")"; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </div>
</div>
                          



                    <div class="form-actions text-center">
                      <!-- user's ID is hidden here -->
                      <button type="submit" name="book_plan" class="btn btn-success">Update Member Details</button>
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


        </div>
      </div>


      <!--end-main-container-part-->

      <!--Footer-part-->

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