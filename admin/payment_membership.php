<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
}
?>
<!-- Visit codeastro.com for more projects -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>

</head>

<body>

    <!--Header-part--><!-- Visit codeastro.com for more projects -->
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>
    <?php include 'includes/topheader.php' ?>
    
    <?php $page = 'payment_membership';
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="payment_membership.php" class="current">Member's Payment <i class="fa-solid fa-money-check-dollar"></i></a> </div>
            <!-- <h1 class="text-center">Membership Payment <i class="fa-solid fa-money-check-dollar"></i></h1> -->
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class='widget-box'>
                        <div class='widget-title'> <span class='icon'> <i class='fas fa-th'></i> </span>
                            <h5>Payment table</h5>
                            <form id="custom-search-form" role="search" method="POST" action="search-result.php" class="form-search form-horizontal pull-right">
                                <div class="input-append span12">
                                    <input type="text" class="search-query" placeholder="Search" name="search" required>
                                    <button type="submit" class="btn"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class='widget-content nopadding'>






                            <?php

                            include "dbcon.php";
                            $qry = "SELECT ps.*, p.*, s.name 
                                   FROM payments p 
                                   JOIN users s ON s.member_id = p.member_id 
                                   JOIN membership_plans ps ON ps.id = s.current_plan_id 
                                   WHERE p.payment_type = 'membership' 
                                   AND s.role = 'member_user' 
                                   AND s.plan_status = '1' and p.payment_status='1'";
                            $cnt = 1;
                            $result = mysqli_query($con, $qry);


                            echo "<table class='table table-bordered data-table table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Member ID</th>
                  <th>Transaction ID</th>
                  <th>Payment Date/Time</th>
                  <th>Amount</th>
                  <th>Payment Method</th>
                  <th>Payment Type</th>
                  <th>User Name</th>
                  <th>Payment Status</th>
                  <th></th>
                    </tr>
              </thead>";

                            while ($row = mysqli_fetch_array($result)) { ?>

                                <tbody>
                                    <td>
                                        <div class='text-center'><?php echo $cnt; ?></div>
                                    </td>
                                <td>
                                        <div class='text-center'><?php echo $row['member_id'] ?></div>
                                    </td>
                                    <td>
                                        <div class='text-center'><?php echo $row['transaction_id'] ?></div>
                                    </td>
                                    <td>
                                        <div class='text-center'><?php echo $row['payment_date']; ?></div>
                                    </td>

                                    <td>
                                        <div class='text-center'><?php echo '₹' . $row['amount'] ?></div>
                                    </td>
                                    <td>
                                        <div class='text-center'><?php echo $row['payment_method'] ?></div>
                                    </td>
                                    <td>
                                        <div class='text-center'><?php echo $row['payment_type'] ?></div>
                                    </td>
                                    

                                    <td>
                                        <div class='text-center'><?php echo $row['name'] ?></div>
                                    </td>
                                    <td><?php if ($row['payment_status'] == '1') {
                                            $status = "<span class='label label-success' style='background:#28a745; padding:5px 10px;'>Paid</span>";
                                        } else {
                                            $status = "<span class='label label-danger' style='background:#ffc107;'>Pending</span>";
                                        }
                                        ?>
                                        <b></b><?php echo $status; ?>
                                    </td>


                                    <!-- <td><div class='text-center'><a href='user-payment.php?id=<?php echo $row['user_id'] ?>'><button class='btn btn-success btn'><i class='fas fa-dollar-sign'></i> Make Payment</button></a></div></td>
                <td><div class='text-center'><a href='sendReminder.php?id=<?php echo $row['user_id'] ?>'><button class='btn btn-danger btn' <?php echo ($row['reminder'] == 1 ? "disabled" : "") ?>>Alert</button></a></div></td> -->
                                </tbody>
                            <?php $cnt++;
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

    <style>
        #custom-search-form {
            margin: 0;
            margin-top: 5px;
            padding: 0;
        }

        #custom-search-form .search-query {
            padding-right: 3px;
            padding-right: 4px \9;
            padding-left: 3px;
            padding-left: 4px \9;
            /* IE7-8 doesn't have border-radius, so don't indent the padding */

            margin-bottom: 0;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        #custom-search-form button {
            border: 0;
            background: none;
            /** belows styles are working good */
            padding: 2px 5px;
            margin-top: 2px;
            position: relative;
            left: -28px;
            /* IE7-8 doesn't have border-radius, so don't indent the padding */
            margin-bottom: 0;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        .search-query:focus+button {
            z-index: 3;
        }
    </style>


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