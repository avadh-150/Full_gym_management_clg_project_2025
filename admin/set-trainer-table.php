 <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('location:login.php');
    }
    $con = mysqli_connect("localhost", "root", "", "gymnsb");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <?php include "includes/header.php"; ?>
 </head>

 <body>

     <div id="header">
         <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
     </div>

     <?php include 'includes/topheader.php' ?>
     <?php $page = 'set-trainer-table';
        include 'includes/sidebar.php' ?>

     <div id="content">
         <div id="content-header">
             <div id="breadcrumb">
                 <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                 <a href="staffs.php" class="tip-bottom">Trainers</a>
                 <a href="#" class="current">Set Trainer Schedule</a>
             </div>
             <h1>Trainer Schedule Entry</h1>
         </div>

         <div class="container-fluid">
             <hr>
             <div class="row-fluid">
                 <!-- Plans Entry Section -->

                 <!-- Trainer Schedule Entry Section -->
                 <div class="span6">
                     <div class="widget-box">
                         <div class="widget-title">
                             <span class="icon"><i class="fas fa-align-justify"></i></span>
                             <h5>Trainer Schedule</h5>
                         </div>
                         <div class="widget-content nopadding">
                             <form action="" method="POST" class="form-horizontal">
                                 <div class="control-group">
                                     <label class="control-label">Select Trainer:</label>
                                     <div class="controls">
                                         <select name="trainer_id" id="trainerDropdown" required>
                                             <option value="">-- Choose a Trainer --</option>
                                             <?php
                                                $sql_trainers = "SELECT * FROM trainers";
                                                $result_trainers = mysqli_query($con, $sql_trainers);
                                                while ($trainer = mysqli_fetch_assoc($result_trainers)) {
                                                ?>
                                                 <option value="<?php echo $trainer['id']; ?>" data-image="uploads/trainers/<?php echo $trainer['image']; ?>">
                                                     <?php echo $trainer['name']; ?>
                                                 </option>
                                             <?php
                                                }
                                                ?>
                                         </select>
                                         <br>
                                         <!-- Trainer Image Preview -->
                                         <div id="trainerPreview">
                                             <img id="trainerImg" src="" alt="Trainer Image" width="50px" height="50px" style=" display: none;">
                                         </div>
                                         <script>
                                             document.getElementById("trainerDropdown").addEventListener("change", function() {
                                                 var selectedOption = this.options[this.selectedIndex];
                                                 var imgSrc = selectedOption.getAttribute("data-image");

                                                 if (imgSrc) {
                                                     document.getElementById("trainerImg").src = imgSrc;
                                                     document.getElementById("trainerImg").style.display = "block";
                                                 } else {
                                                     document.getElementById("trainerImg").style.display = "none";
                                                 }
                                             });
                                         </script>

                                     </div>
                                 </div>

                                 <div class="control-group">
                                     <label class="control-label">Select Schedule:</label>
                                     <div class="controls">
                                         <select name="schedule_id" required>
                                             <option value="">-- Choose a Schedule --</option>
                                             <?php
                                                $sql_schedules = "SELECT * FROM schedule";
                                                $result_schedules = mysqli_query($con, $sql_schedules);
                                                while ($schedule = mysqli_fetch_assoc($result_schedules)) {
                                                    echo "<option value='" . $schedule['schedule_id'] . "'>" . htmlspecialchars($schedule['schedule_name']) . " (" . $schedule['start_date'] . " - " . $schedule['end_date'] . ")</option>";
                                                }
                                                ?>
                                         </select>
                                     </div>
                                 </div>

                                 <div class="form-actions text-center">
                                     <button type="submit" name="assign_schedule" class="btn btn-success">Assign Schedule</button>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>

             </div>

             <!-- Feature Details -->
             <div class="widget-box">
                 <div class="widget-title"><span class="icon"><i class="fas fa-align-justify"></i></span>
                     <h5>Trainers Schedule Details</h5>
                 </div>
                 <div class="widget-content nopadding">
                 <?php
include "dbcon.php";

$qry = "SELECT t.name AS trainer_name, sd.schedule_name,s.*, sd.start_date, sd.end_date 
        FROM trainers t
        JOIN trainer_schedule s ON t.id = s.trainer_id 
        JOIN schedule sd ON sd.schedule_id = s.schedule_id 
        WHERE t.status = 'active'";

$cnt = 1;
$result = mysqli_query($con, $qry);

echo "<table class='table table-bordered table-hover'>
<thead>
  <tr>
    <th>#</th>
    <th>Trainer Name</th>
    <th>Available Day</th>
    <th>Time Slot</th>
    <th>Action</th>
  </tr>
</thead>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo "<tbody> 
            <tr>
                <td><div class='text-center'>" . $cnt . "</div></td>
                <td><div class='text-center'>" . $row['trainer_name'] . "</div></td>
                <td><div class='text-center'>" . $row['schedule_name'] . "</div></td>
                <td><div class='text-center'>" . date('l, d M Y h:i A', strtotime($row['start_date'])) . 
                    " - " . date('h:i A', strtotime($row['end_date'])) . "</div></td>
                <td>
                    <div class='text-center'>
                         
                        <a href='set-trainer-table.php?id=" . $row['schedule_id'] . "' style='color:red;' 
                           onclick='return confirm(\"Are you sure you want to delete this schedule?\");'>
                            <i class='fas fa-trash'></i> Remove
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>";
        $cnt++;
    }
} else {
    echo "<tr><td colspan='5'> <div class='text-center'> No schedule data available </div></td></tr>";
}

?>
              </table>
              <!-- mjasjhasbjhb -->
                 </div>
             </div>

         </div>
     </div>



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

 <?php
    include "dbcon.php";
    if (isset($_REQUEST['assign_schedule'])) {
        $trainer_id = $_POST['trainer_id'];
        $schedule_id = $_POST['schedule_id'];

        $sql = "INSERT INTO trainer_schedule (trainer_id, schedule_id) VALUES ('$trainer_id', '$schedule_id')";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Trainer schedule assigned successfully!'); window.location='set-trainer-table.php';</script>";
        } else {
            echo "<script>alert('Error assigning schedule!'); window.location='set-trainer-table.php';</script>";
        }
    }
    ?>
    <?php
include "dbcon.php";

if (isset($_GET['id'])) {
    $schedule_id = intval($_GET['id']); // Ensure it's an integer for security

    // Delete query
    $deleteQuery = "DELETE FROM trainer_schedule WHERE schedule_id = ?";
    
    // Prepare statement
    $stmt = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $schedule_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Schedule deleted successfully!');
                window.location.href = 'set-trainer-table.php'; // Redirect to schedule page
              </script>";
    } else {
        echo "<script>
                alert('Error deleting schedule.');
                window.location.href = 'set-trainer-table.php'; // Redirect back
              </script>";
    }

    // Close statement
    mysqli_stmt_close($stmt);
} 
?>
