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
<?php include 'includes/topheader.php'?>

<?php $page="active-members"; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="members.php" class="current"> Members</a><a href="#" class="current">Active Members <i class="fa-solid fa-user-group"></i></a> </div>
    <!-- <h1 class="text-center">Active Members List </h1> -->
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Members Table</h5>
          </div>
          <div class='widget-content nopadding'>
	      <!-- Search Form -->
        <form action="" role="search" method="POST">
                                <div id="search" class="p-3">
                                    <input type="text" placeholder="Search Here.." name="search_products"
                                        value="<?php echo isset($_POST['search_products']) ? htmlspecialchars($_POST['search_products']) : ''; ?>" />
                                    <button type="submit" class="tip-bottom" name="search_submit" title="Search">
                                        <i class="fas fa-search fa-white"></i>
                                    </button>
                                </div>
                            </form>
          <?php
include "dbcon.php";

// Updated query to avoid duplicates
$qry = "SELECT s.*, m.* 
        FROM users s 
        JOIN member_plans m ON s.member_id = m.member_id 
        WHERE s.role = 'member_user' AND m.status = '1'
        GROUP BY s.member_id 
        ORDER BY m.start_date DESC";

$cnt = 1;
$result = mysqli_query($con, $qry);

echo "<table class='table table-bordered table-hover'>
        <thead>
            <tr>
                <th>#Member ID</th>
              
                <th>Fullname</th>
                <th>Email</th>
              
                <th>Contact Number</th>
                <th>Address</th>
                
                <th>Plan</th>
                <th>Payment Status</th>
                <th>Action</th>
            </tr>
        </thead>";

        while ($row = mysqli_fetch_array($result)) {


          if($row['plan_status']== '1'){
          $plan_status=  "<p class='badge badge-success text-center'>Active</p>";
          }
          elseif($row['plan_status']== '0') {
            $plan_status= "<p class='badge badge-warning text-center'>Expire</p>";
          }
      
          if ($row['payment_status'] == '1') {
            $status = "<span class='label label-success' style='background:#28a745;'>Paid</span>";
        } else {
            $status = "<span class='label label-danger' style='background:#ffc107;'>Unpaid</span>";
        }
      
          echo "<tbody> 
                  <td><div class='text-center'>" . $row['member_id'] . "</div></td>
                  <td><div class='text-center'>" . $row['full_name'] . "</div></td>
                  <td><div class='text-center'>" . $row['email'] . "</div></td>
                  <td><div class='text-center'>" . $row['mobile'] . "</div></td>
                  <td><div class='text-center'>" . substr($row['address'],0,20) .'..'. "</div></td>
                 
                  <td><div class='text-center'>" . $plan_status . "</div></td>
                  <td><div class='text-center'>" . $status . "</div></td>
                                  <td style='font-size:13px'> <a href='memberProfile.php?id={$row['member_id']}' class='text-info'><i class='fas fa-id-card'></i></a> |
                              <a href='edit-member.php?id={$row['member_id']}' class='text-success'><i class='fas fa-edit'></i></a> | 
                    <button style='border:none;outline:none;color:red;' onclick='deleteMember({$row['member_id']})'><i class='fas fa-trash'></i></button></td>

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

<script>
    function deleteMember(id) {
        if (confirm("Are you sure you want to delete this member?")) {
            window.location.href = 'delete-members.php?id=' + id;
        }
    }
</script>