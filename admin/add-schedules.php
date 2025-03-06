<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
}
?>
<?php include "includes/header.php" ?>
</head>

<body>

    <!--Header-part-->
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>
    <?php include 'includes/topheader.php' ?>

    <?php $page = "add-schedules";
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a> <a href="#" class="current">Schedules <i class="fa-solid fa-calendar-days"></i></a> </div>
        </div>
        <!-- <hr> -->
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

                            <form action="save_schedule.php" method="POST" class="form-horizontal">
                                <div class="control-group">
                                    <label class="control-label">Schedule Name :</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="name" placeholder="Add the title" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Select Day:</label>
                                    <div class="controls">
                                        <select name="days" required>
                                            <option value="">-- Choose a Day --</option>
                                            <option value="Monday">Monday</option>
                                            <option value="Tuesday">Tuesday</option>
                                            <option value="Wednesday">Wednesday</option>
                                            <option value="Thursday">Thursday</option>
                                            <option value="Friday">Friday</option>
                                            <option value="Saturday">Saturday</option>
                                            <option value="Sunday">Sunday</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="control-group">
                                <label class="control-label">Date Of Schedule</label>
                                <div class="controls">
                                    <input type="date" class="span11" name="sdate" value="<?php echo date('Y-m-d') ?>" placeholder="Add the title" />
                                </div>
                            </div> -->
                                <div class="control-group">
                                    <label class="control-label">Start Time</label>
                                    <div class="controls">
                                        <input type="time" class="span11" name="stime" placeholder="Add Starting Time" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">End Time</label>
                                    <div class="controls">
                                        <input type="time" class="span11" name="etime" placeholder="Add Ending title" />
                                    </div>
                                </div>
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
                                                    <?php echo $trainer['name'] . '(' . $trainer['specialization'] . ')'; ?>
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



                                <div class="form-actions text-center">
                                    <button type="submit" name="assign_schedule" class="btn btn-success">Make Schedule</button>
                                </div>
                            </form>
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
</body>

</html>