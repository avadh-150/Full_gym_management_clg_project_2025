<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:login.php'); 	
}
include "dbcon.php";
$qry="SELECT services, count(*) as number FROM members GROUP BY services";
$result=mysqli_query($con,$qry);
$qry="SELECT gender, count(*) as enumber FROM members GROUP BY gender";
$result3=mysqli_query($con,$qry);
$qry="SELECT designation, count(*) as snumber FROM staffs GROUP BY designation";
$result5=mysqli_query($con,$qry);
?>
<!DOCTYPE html>

<html lang="en">
<head>
<?php include "includes/header.php"?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Services', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["services"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      //is3D:true,  
                      pieHole: 0.4 ,
                      
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Services', 'Total Numbers'],
          // ["King's pawn (e4)", 44],
          // ["Queen's pawn (d4)", 31],
          // ["Knight to King 3 (Nf3)", 12],
          // ["Queen's bishop pawn (c4)", 10],
          // ['Other', 3]

          <?php
            $query="SELECT services, count(*) as number FROM members GROUP BY services";
            $res=mysqli_query($con,$query);
            while($data=mysqli_fetch_array($res)){
              $services=$data['services'];
              $number=$data['number'];
           ?>
           ['<?php echo $services;?>',<?php echo $number;?>],   
           <?php   
            }
           ?> 

          
        ]);

        var options = {
          // title: 'Chess opening moves',
          width: 710,
          legend: { position: 'none' },
          // chart: { title: 'Chess opening moves',
          //          subtitle: 'popularity by percentage' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Total'} // Top x-axis.
            }
          },
          bar: { groupWidth: "100%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };


      
    </script>

<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Terms', 'Total Amount',],
          
          <?php
          $query1 = "SELECT gender, SUM(amount) as numberone FROM members; ";

            $rezz=mysqli_query($con,$query1);
            while($data=mysqli_fetch_array($rezz)){
              $services='Earnings';
              $numberone=$data['numberone'];
              // $numbertwo=$data['numbertwo'];
           ?>
           ['<?php echo $services;?>',<?php echo $numberone;?>,],   
           <?php   
            }
           ?> 

      <?php
          $query10 = "SELECT quantity, SUM(amount) as numbert FROM equipment";
            $res1000=mysqli_query($con,$query10);
            while($data=mysqli_fetch_array($res1000)){
              $expenses='Expenses';
              $numbert=$data['numbert'];
              
           ?>
           ['<?php echo $expenses;?>',<?php echo $numbert;?>,],   
           <?php   
            }
           ?> 

          
        ]);

        var options = {
         
          width: "1050",
          legend: { position: 'none' },
          
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Total'} // Top x-axis.
            }
          },
          bar: { groupWidth: "100%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_y_div'));
        chart.draw(data, options);
      };


      
    </script>

<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result3))  
                          {  
                               echo "['".$row["gender"]."', ".$row["enumber"]."],";  
                          }  
                          ?>  
                     ]); 

        var options = {
          
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

    <script>
       google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([  
                          ['Designation', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result5))  
                          {  
                               echo "['".$row["designation"]."', ".$row["snumber"]."],";  
                          }  
                          ?>  
                     ]); 

        var options = {
          
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart2022'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>

<?php include 'includes/topheader.php'?>

  <?php $page='dashboard'; include 'includes/sidebar.php'?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="You're right here" class="tip-bottom"><i class="fa fa-home"></i> Home</a></div>
  </div>

  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ls span"> <a href="members.php" style="font-size: 16px;"> <i class="fas fa-user-check"></i> <span class="label label-important"><?php 
        include "dbcon.php";
        $sql = "SELECT COUNT(*) as active_members FROM users WHERE role = 'member_user' AND plan_status = '1'";
        $query = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($query);
        echo $row['active_members'];
        ?></span> Active Members </a> </li>

        <li class="bg_lo span3"> <a href="users.php" style="font-size: 16px;"> <i class="fas fa-users"></i></i><span class="label label-important"> <?php
          include "dbcon.php";
          $sql = "SELECT * FROM users";
          $query = $con->query($sql);
          echo "$query->num_rows"; ?></span> Registered Users</a> </li>

        <li class="bg_lg span3"> <a href="product_payments.php" style="font-size: 16px;"> <i class="fa fa-dollar-sign"></i> Total Products Earnings: ₹ <?php
          include "dbcon.php";
          $sql = "SELECT SUM(amount) as earning FROM payments where payment_type='product'";
          $query = mysqli_query($con,$sql);
          $row=mysqli_fetch_assoc($query);
          echo $row['earning'] ?? 0;

         ?></a> </li>
      
        <li class="bg_lb span2"> <a href="announcement.php" style="font-size: 16px;"> <i class="fas fa-bullhorn"></i><span class="label label-important"><?php include'actions/count-announcements.php'?></span>Announcements </a> </li>

        <li class="bg_lg span3"> <a href="" style="font-size: 16px;"> <i class="fa fa-dollar-sign"></i> Total membership Earnings: ₹ <?php
          include "dbcon.php";
          $sql = "SELECT SUM(amount) as earning FROM payments where payment_type='membership'";
          $query = mysqli_query($con,$sql);
          $row=mysqli_fetch_assoc($query);
          echo $row['earning'] ?? 0;

         ?></a> </li>
          <!-- <li class="bg_ls span2"> <a href="buttons.html"> <i class="fas fa-tint"></i> Buttons</a> </li>
          <li class="bg_ly span3"> <a href="form-common.html"> <i class="fas fa-th-list"></i> Forms</a> </li>
          <li class="bg_lb span2"> <a href="interface.html"> <i class="fas fa-pencil"></i>Elements</a> </li> 
          <li class="bg_lg"> <a href="calendar.html"> <i class="fas fa-calendar"></i> Calendar</a> </li>
          <li class="bg_lr"> <a href="error404.html"> <i class="fas fa-info-sign"></i> Error</a> </li> -->
<!-- Visit codeastro.com for more projects -->
      </ul>
    </div>
<!--End-Action boxes-->    

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="fas fa-file"></i></span>
          <h5>Services Report</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span8">
              <div id="top_x_div" style="width: 700px; height: 290px;"></div>
            </div>
            <div class="span4">
              <ul class="site-stats">

                <!-- Total products -->
                <li class="bg_lh"><i class="fa-solid fa-dumbbell"></i><strong><?php include "dbcon.php";
                $sql="select count(*) as count from products";
                $query=mysqli_query($con,$sql);
                $row=mysqli_fetch_assoc($query);
                echo $row['count'];
                
                ?></strong> <small>Available Products</small></li>

                <!-- total Adminb users -->
                <li class="bg_lg"><i class="fas fa-user-clock"></i> <strong>
                  <?php  include "dbcon.php";
                $sql="select count(*) as count from admin";
                $query=mysqli_query($con,$sql);
                $row=mysqli_fetch_assoc($query);
                echo $row['count'];?>
                </strong> <small>Admin Users</small></li>

<!-- total Orders -->
                <li class="bg_ls"><i class="fa-solid fa-truck-fast"></i> <strong><?php  include "dbcon.php";
                $sql="select count(*) as count from orders";
                $query=mysqli_query($con,$sql);
                $row=mysqli_fetch_assoc($query);
                echo $row['count'];  ?></strong> <small>Total Order</small></li>

                <li class="bg_ly"><i class="fas fa-file-invoice-dollar"></i> <strong><?php  include "dbcon.php";

                $sql="select count(*) as count from contact";
                $query=mysqli_query($con,$sql);
                $row=mysqli_fetch_assoc($query);
                echo $row['count'];?></strong> <small>Total Queries</small></li>
                
                <li class="bg_lr"><i class="fas fa-user-ninja"></i> <strong><?php include 'actions/count-trainers.php';?></strong> <small>Active Gym Trainers</small></li>
                <li class="bg_lb"><i class="fas fa-calendar-check"></i> <strong><?php  include "dbcon.php";
                $sql="select count(*) as count from membership_plans";
                $query=mysqli_query($con,$sql);
                $row=mysqli_fetch_assoc($query);
                echo $row['count'];?></strong> <small>OUR plans</small></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg"><span class="icon"><i class="fas fa-file"></i></span>
          <h5>Earnings & Expenses Reports</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span12">
              <div id="piechart"></div>  
              <div id="top_y_div" style="width: 700px; height: 180px;"></div>
            </div>
            
          </div>
        </div>
      </div>
    </div> -->

    <!-- <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="fas fa-chevron-down"></i></span>
            <h5>Registered Gym Members by Gender: Overview</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              
              <div id="donutchart" style="width: 600px; height: 300px;"></div>

            </ul>
          </div>
        </div>
      </div>

      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="fas fa-chevron-down"></i></span>
            <h5>Staff Members by Designation: Overview</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              
            <div id="donutchart2022" style="width: 600px; height: 300px;"></div>
            </ul>
          </div>
        </div>   
      </div>
      </div> -->
	
<!--End-Chart-box-->
    <!-- <hr/> -->
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title bg_ly" data-toggle="collapse" href="#collapseG2"><span class="icon"><i class="fas fa-chevron-down"></i></span>
            <h5>Gym Announcement</h5>
          </div>
          <div class="widget-content nopadding collapse in" id="collapseG2">
            <ul class="recent-posts">
              <li>

              <?php

                include "dbcon.php";
                $qry="SELECT * FROM announcements";
                $result=mysqli_query($conn,$qry);
                  
                while($row=mysqli_fetch_array($result)){
                  echo"<div class='user-thumb'> <img width='70' height='40' alt='User' src='../img/demo/av1.jpg'> </div>";
                  echo"<div class='article-post'>"; 
                  echo"<span class='user-info'> By: System Administrator / Date: ".$row['date']." </span>";
                  echo"<p><a href='#'>".$row['message']."</a> </p>";
                 
                }

                echo"</div>";
                echo"</li>";
              ?>

              <a href="manage-announcement.php"><button class="btn btn-warning btn-mini">View All</button></a>
              </li>
            </ul>
          </div>
        </div><!-- Visit codeastro.com for more projects -->
       
         
      </div>
      <div class="span6">
       
      <!-- <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="fas fa-tasks"></i></span>
            <h5>Customer's To-Do Lists</h5>
          </div>
          <div class="widget-content">
            <div class="todo">
              <ul>
              <?php

                // include "dbcon.php";
                // $qry="SELECT * FROM todo";
                // $result=mysqli_query($con,$qry);

                // while($row=mysqli_fetch_array($result)){ ?>

                <li class='clearfix'> 
                                                                        
                    <div class='txt'> <?php //echo $row["task_desc"]?> <?php //if ($row["task_status"] == "Pending") { echo '<span class="by label label-info">Pending</span>';} else { echo '<span class="by label label-success">In Progress</span>'; }?></div>
                
               <?php // }
              //echo"</ul>";
              ?>
            </div>
          </div>
        </div>
       
                </div>
       
      </div> End of ToDo List Bar
    </div>End of Announcement Bar
  </div>End of container-fluid
</div>End of content-ID -->

<!--end-main-container-part-->

<!--Footer-part-->

<div class="row-fluid">
  <div id="footer" class="span12"> <?php echo date("Y");?> &copy; Developed By GYM FITNESS CLUB CENTER</a> </div>
</div>

<style>
#footer {
  color: white;
}

#piechart {
  width: 800px; 
  height: 280px;  
  margin-left:auto; 
  margin-right:auto;
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
<!-- <script src="../js/matrix.interface.js"></script>  -->
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
