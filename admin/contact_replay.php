<?php
session_start();
include "dbcon.php";
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

if (isset($_GET['mark_as_read'])) {
    $query_id = intval($_GET['mark_as_read']);
    $sql_mark_as_read = "UPDATE contact SET is_read = 1 WHERE id = $query_id";
    mysqli_query($con, $sql_mark_as_read);
    echo "<script>alert('Message is Successfully Marked As Read');
     </script>";
    // header("Location: contact.php"); // Redirect back to prevent resubmission
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

    <?php $page = "reply";
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->

    <div id="content">
        
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a><a href="contact_replay.php">reply to member</a> <a href="#" class="current">Manage Queries</a> </div>
            <h1 class="text-center">Manage Queries <i class="fas fa-question"></i></h1>
        </div>
        
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">

                    <div class='widget-box'>
                        <div class='widget-title'> <span class='icon'> <i class='fas fa-question'></i> </span>
                            <h5>Reply member query table</h5>
                        </div>
                        <div class='widget-content nopadding'>

                            <?php

                            include "dbcon.php";
                            $qry = "select * from contact";
                            $cnt = 1;
                            $result = mysqli_query($con, $qry);
                            ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                        <tr>
                                            <td>
                                                <div class='text-center'><?= $row['id'] ?></div>
                                            </td>
                                            <td>
                                                <div class='text-center'><?= htmlspecialchars($row['name']) ?></div>
                                            </td>
                                            <td>
                                                <div class='text-center'><?= htmlspecialchars($row['email']) ?></div>
                                            </td>
                                            <td>
                                                <div class='text-center'><?= htmlspecialchars($row['phone'] ?: 'N/A') ?></div>
                                            </td>
                                            <td>
                                                <div class='text-center'><?= htmlspecialchars($row['message']) ?></div>
                                            </td>
                                            <td>
                                                <div class='text-center'><?= $row['created_at'] ?>
                                            </td>
                                            <td>
                                                <?php if ($row['is_read'] == 0): ?>
                                                    <a href="contact_ans.php?mark_as_read=<?= $row['id'] ?>" class="btn btn-mark-read btn-sm">Mark as Read</a>
                                                <?php else: ?>
                                                    <span class="badge bg-success">Read</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                    <?php if (mysqli_num_rows($result) === 0): ?>
                                        <tr>
                                            <td colspan="7" class="text-muted">No queries found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>

    <!--end-main-container-part-->

    <!--Footer-part-->



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