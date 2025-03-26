<?php

use Stripe\Plan;

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

<?php $page="members"; include 'includes/sidebar.php'?>
<!--sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="current">Subscribe Members <i class="fa-solid fa-user-group"></i></a> </div>
    <!-- <h1 class="text-center"> Members List </h1> -->
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">

      <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
            <h5>Members Table</h5>
          </div>
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

          <div class='widget-content nopadding'>
	  
          <?php
include "dbcon.php";

// Updated query to avoid duplicates
$qry = "SELECT s.*, m.* 
        FROM users s 
        JOIN member_plans m ON s.member_id = m.member_id 
        WHERE s.role = 'member_user' 
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
                <th>Alert</th>
            </tr>
        </thead>";

while ($row = mysqli_fetch_array($result)) {
// Calculate days remaining and status
$end_date = new DateTime($row['end_date']);
$current_date = new DateTime();
$days_remaining = $current_date->diff($end_date)->days;
$is_expired = $current_date > $end_date;
$status_plan = ($row['status'] == '1' && !$is_expired) ? 'Active' : 'Inactive';
// Update status to 0 if membership is expired
if ($is_expired) {
  $esql = "UPDATE member_plans SET status='0' WHERE member_id = '" . $row['member_id'] . "' AND end_date = '" . $row['end_date'] . "'";
  $usql = "UPDATE users SET plan_status='0' WHERE member_id = '" . $row['member_id'] . "'";
    
  if (mysqli_query($con, $esql) && mysqli_query($con, $usql)) {
      error_log("Membership expired for member_id: " . $row['member_id'] . " - Status updated in both tables");
  }
}

// Set color for status_plan
$status_plan_display = ($status_plan === 'Active') 
    ? "<span class='label label-success' style='background:#28a745;'>Active</span>"
    : "<span class='label label-danger' style='background:#dc3545;'>Inactive</span>";

if ($row['payment_status'] == '1') {
    $status = "<span class='label label-success' style='background:#28a745;'>Paid</span>";
} else {
    $status = "<span class='label label-danger' style='background:#ffc107;'>Unpaid</span>";
}

echo "<tbody> 
        <td><div class='text-center'>" . htmlspecialchars($row['member_id']) . "</div></td>
        <td><div class='text-center'>" . $row['full_name'] . "</div></td>
        <td><div class='text-center'>" . $row['email'] . "</div></td>
        <td><div class='text-center'>" . $row['mobile'] . "</div></td>
        <td><div class='text-center'>" . substr($row['address'],0,20) .'..'. "</div></td>
        <td><div class='text-center'>" . $status_plan_display . "</div></td>";
            echo " 
            <td><div class='text-center'>" . $status . "</div></td>


            
                           <td style='font-size:13px'> <a href='memberProfile.php?id={$row['member_id']}' class='text-info'><i class='fas fa-id-card'></i></a> |
                              <a href='edit-member.php?id={$row['member_id']}' class='text-success'><i class='fas fa-edit'></i></a> | 
                    <button style='border:none;outline:none;color:red;' onclick='deleteMember({$row['member_id']})'><i class='fas fa-trash'></i></button></td>
                    <td>
                    <div class='text-center'>";
                    ?>
                    <a href='sendReminder.php?id=<?php echo $row['member_id']?>'><button class='btn btn-danger btn' <?php echo($row['remainder'] == 1 ? "disabled" : "")?>>Alert</button></a>
                    <?php 
                    
                    echo "</div>
                    </td>

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