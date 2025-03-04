<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
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
  <?php include 'includes/topheader.php' ?>

  <!--sidebar-menu-->
  <?php $page = "plans";
  include 'includes/sidebar.php' ?>
  <!--sidebar-menu-->

  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="current">Plans</a> </div>
      <h1 class="text-center">Plans List <i class="fas fa-group"></i></h1>
    </div>
    <div class="container-fluid">
      <hr>
      <div class="row-fluid">
        <div class="span12">

          <div class='widget-box'>
            <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
              <h5>Plan table</h5>
            </div>
            <div class='widget-content nopadding'>

              <?php

              include "dbcon.php";
              $qry = "select * from membership_plans";
              $cnt = 1;
              $result = mysqli_query($con, $qry);


              echo "<table class='table table-bordered table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Plan_name</th>
                  <th>Plan Type</th>
                  <th>Duration</th>
                   <th>Price</th>
                  <th>Features</th>
                  <th>Action</th>
             
                
                </tr>
              </thead>";
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {

                  echo "<tbody> 
                  <td><div class='text-center'>" . $cnt . "</div></td>
                  <td><div class='text-center'>" . $row['plan_name'] . "</div></td>
                  <td><div class='text-center'>" . (isset($row['type']) && !empty($row['type']) ? $row['type'] : 'None') . "</div></td>
                  <td><div class='text-center'>" . $row['duration'] . " Days</div></td>
                  <td><div class='text-center'>₹ " . $row['price'] . "</div></td>
                  <td><div class='text-center'>" . substr($row['features'], 0, 100) . "...</div></td>
                  <td>
                      <div class='text-center'>
                          <a href='actions/delete-member.php?plans_id=" . $row['id'] . "' style='color:#F66;'>
                              <i class='fas fa-trash'></i> Remove
                          </a>
                      </div>
                      <br>
                      <div class='text-center'>
                          <a href='edit-plans.php?id=" . $row['id'] . "'>
                              <i class='fas fa-edit'></i> Edit
                          </a>
                      </div>
                  </td>
                </tbody>";
          
          $cnt++;
          
                }
              } else {
                echo "<td colspan='10px'> <div class='text-center'> the data is not available</div></td>";
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