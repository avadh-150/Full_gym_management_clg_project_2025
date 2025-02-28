<?php
session_start();
error_reporting(0);
include "connection.php"; 

$query = "SELECT * FROM schedule"; 
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

include "include/header.php";
?>

<style>
       .schedule {
        text-align: center;
        padding: 20px;
    }
    .schedule-table {
        width: 80%;
        margin: auto;
        border-collapse: collapse;
    }
    .schedule-table th, .schedule-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }
    .schedule-table th {
        background-color: #f2f2f2;
        color: #333;
    }
    .schedule-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .schedule-table tr:hover {
        background-color: #ddd;
    }
</style>

</head>
<body>

<?php include "include/nav.php"; ?>
<!-- END header -->

<section class="home-slider-loop-false inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('img/4.jpg');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-md-8 text-center col-sm-12 element-animate">
                    <h1>Schedule</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END slider -->

<section class="section element-animate">
    <div class="clearfix mb-5 pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center heading-wrap">
                    <h2>Schedule</h2>
                    <span class="back-text">Schedule</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<main>
<section class="schedule">
    <table class="schedule-table">
        <thead>
            <tr>
                <th>Day</th>
                <th>Time</th>
                <th>Class</th>
                <th>Instructor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    $day = date('l', strtotime($row['start_date'])); // Get day name (e.g., Monday)
                    $start_time = date('h:i A', strtotime($row['start_date'])); // 12-hour format
                    $end_time = date('h:i A', strtotime($row['end_date'])); // 12-hour format
            ?>
            <tr>
                <td><?= $day ?></td>
                <td><?= $start_time . " - " . $end_time ?></td>
                <td><?= $row['schedule_name'] ?></td>
                <td><?= isset($row['instructor']) ? $row['instructor'] : 'TWM Instructor' ?></td>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="4">No schedules found. Please ensure that data exists in the schedule table.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</section>
</main>

<?php include "include/footer.php"; ?>

</body>
</html>
