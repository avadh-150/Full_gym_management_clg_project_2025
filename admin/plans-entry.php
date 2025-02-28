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
    <?php include "includes/header.php"; ?>

</head>

<body>

    <!--Header-part--><!-- Visit codeastro.com for more projects -->
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>
    <!--close-Header-part-->


    <!--top-Header-menu-->
    <?php include 'includes/topheader.php' ?>

    <?php $page = 'plans-entry';
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="plans.php" class="tip-bottom">Manamge Plans</a> <a href="#" class="current">Add Plans</a> </div>
            <h1>Plans Entry Form</h1>
        </div>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                            <h5>Plans-information</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="add-plan-req.php" method="POST" class="form-horizontal" enctype="multipart/form-data" onsubmit="updateNicEdit()">
                                <div class="control-group">
                                    <label class="control-label">Plan Name</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="name" placeholder="Plan Name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Duration :</label>
                                    <div class="controls">
                                        <input type="number" class="span11" name="duration" placeholder="Duration" min="1" />
                                        <span class="help-block">Note: please enter the duration of the plan in days <br> like 30 for 30 days, 365 for 365 days</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Price :</label>
                                    <div class="controls">
                                        <input type="number" class="span11" name="price" placeholder="Price" min="0" step="0.01" />
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                            <h5>Feature Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div class="form-horizontal">
                                <div class="control-group">
                                    <!-- <label for="normal" class="control-label">Plan Features:</label> -->
                                    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>

                                    <textarea name="feature" style="width: 100%;" id="feature" class="form-control" cols="20" rows="10">

                                        </textarea>
                                    <script type="text/javascript">
                                        bkLib.onDomLoaded(function() {
                                            new nicEditor({
                                                fullPanel: true
                                            }).panelInstance('feature');
                                        });

                                        function updateNicEdit() {
                                            document.getElementById('feature').value = nicEditors.findEditor('feature').getContent();
                                        }
                                    </script>

                                </div>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="form-horizontal">
                                    <div class="form-actions text-center">
                                        <!-- <input type="text" name="id" id="" values> -->
                                        <button type="submit" name="submit-btn" class="btn btn-success">Submit Plans Details</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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