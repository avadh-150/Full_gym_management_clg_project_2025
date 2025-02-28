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
    <!-- Visit codeastro.com for more projects -->
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
    <?php $page = 'users-entry';
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="users.php" class="tip-bottom">Manamge Users</a> <a href="#" class="current">Add Users</a> </div>
            <h1>Users Entry Form</h1>
        </div>
        <form role="form" action="index.php" method="POST">
            <?php

            if (isset($_REQUEST['submit'])) {
                $fullname = $_POST["fullname"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                $dor = $_POST["dor"];
                $gender = $_POST["gender"];
                //   $services = $_POST["services"];
                // $paid_date='$curr_date';
                //   $amount = $_POST["amount"];
                //   $p_year = date('Y');
                //   $paid_date = date("Y-m-d");
                //   $plan = $_POST["plan"];
                $address = $_POST["address"];
                $email = $_POST["email"];
                $contact = $_POST["contact"];

                $password = md5($password);

                //
                include 'dbcon.php';
                //code after connection is successfull
                $qry = "INSERT INTO users(full_name,name,email,mobile,password,gender,address,join_date) values ('$fullname','$username','$email','$contact','$password','$gender','$address','$dor')";
                $result = mysqli_query($con, $qry); //query executes

                if ($result && mysqli_affected_rows($con) > 0) {
            

                    echo "<div class='container-fluid'>";
                    echo "<div class='row-fluid'>";
                    echo "<div class='span12'>";
                    echo "<div class='widget-box'>";
                    echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
                    echo "<h5>Message</h5>";
                    echo "</div>";
                    echo "<div class='widget-content'>";
                    echo "<div class='error_ex'>";
                    echo "<h1>Success</h1>";
                    echo "<h3>users details has been added!</h3>";
                    echo "<p>The requested details are added. Please click the button to go back.</p>";
                    echo "<a class='btn btn-inverse btn-big'  href='users.php'>Go Back</a> </div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                } else {
                    echo "<div class='container-fluid'>";
                    echo "<div class='row-fluid'>";
                    echo "<div class='span12'>";
                    echo "<div class='widget-box'>";
                    echo "<div class='widget-title'> <span class='icon'> <i class='fas fa-info'></i> </span>";
                    echo "<h5>Error Message</h5>";
                    echo "</div>";
                    echo "<div class='widget-content'>";
                    echo "<div class='error_ex'>";
                    echo "<h1 style='color:maroon;'>Error 404</h1>";
                    echo "<h3>Error occured while entering your details</h3>";
                    echo "<p>Please Try Again</p>";
                    echo "<a class='btn btn-warning btn-big'  href='edit-users.php'>Go Back</a> </div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                    
                }
            } else {
                echo "<h3>YOU ARE NOT AUTHORIZED TO REDIRECT THIS PAGE. GO BACK to <a href='index.php'> DASHBOARD </a></h3>";
            }


            ?>




        </form>
    </div>
    </div>
    </div>
    </div>

    <!--end-main-container-part-->

    <!--Footer-part-->
    <!-- Visit codeastro.com for more projects -->
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