<?php
session_start();
include 'dbcon.php'; // Include your database connection file

if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
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

                            <?php

                            include "dbcon.php";
                            if ($_GET['id']) {
                                $schedule_id = $_GET['id'];
                                $query = "SELECT * FROM schedule WHERE schedule_id = '$schedule_id'";
                                $result = mysqli_query($con, $query);
                                $schedule = mysqli_fetch_assoc($result);
                            }


                            ?>

                            <form action="edit-schedule-req.php" method="POST" class="form-horizontal">
                                <input type="hidden" name="schedule_id" value="<?php echo $schedule['schedule_id']; ?>">

                                <div class="control-group">
                                    <label class="control-label">Schedule Name:</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="name" value="<?php echo $schedule['schedule_name']; ?>" required />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Select Day:</label>
                                    <div class="controls">
                                        <select name="days" required>
                                            <option value="Monday" <?php if ($schedule['schedule_day'] == 'Monday') echo 'selected'; ?>>Monday</option>
                                            <option value="Tuesday" <?php if ($schedule['schedule_day'] == 'Tuesday') echo 'selected'; ?>>Tuesday</option>
                                            <option value="Wednesday" <?php if ($schedule['schedule_day'] == 'Wednesday') echo 'selected'; ?>>Wednesday</option>
                                            <option value="Thursday" <?php if ($schedule['schedule_day'] == 'Thursday') echo 'selected'; ?>>Thursday</option>
                                            <option value="Friday" <?php if ($schedule['schedule_day'] == 'Friday') echo 'selected'; ?>>Friday</option>
                                            <option value="Saturday" <?php if ($schedule['schedule_day'] == 'Saturday') echo 'selected'; ?>>Saturday</option>
                                            <option value="Sunday" <?php if ($schedule['schedule_day'] == 'Sunday') echo 'selected'; ?>>Sunday</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Start Time:</label>
                                    <div class="controls">
                                        <input type="time" class="span11" name="stime" value="<?php echo $schedule['start_time']; ?>" required />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">End Time:</label>
                                    <div class="controls">
                                        <input type="time" class="span11" name="etime" value="<?php echo $schedule['end_time']; ?>" required />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Select Trainer:</label>
                                    <div class="controls">
                                        <select name="trainer_id" required>
                                            <option value="">-- Choose a Trainer --</option>
                                            <?php
                                            $sql_trainers = "SELECT * FROM trainers";
                                            $result_trainers = mysqli_query($con, $sql_trainers);
                                            while ($trainer = mysqli_fetch_assoc($result_trainers)) {
                                                $selected = ($trainer['id'] == $schedule['trainer_id']) ? 'selected' : '';
                                                echo "<option value='{$trainer['id']}' $selected>{$trainer['name']} ({$trainer['specialization']})</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-actions text-center">
                                    <button type="submit" name="update_schedule" class="btn btn-primary">Update Schedule</button>
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