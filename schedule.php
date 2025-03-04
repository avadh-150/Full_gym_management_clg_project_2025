<?php
session_start();
error_reporting(0);
include "connection.php"; 

// Fetch schedules along with assigned trainers
$query = "
    SELECT s.schedule_name, s.start_date, s.end_date, 
           t.name AS trainer_name, t.image AS trainer_image
    FROM schedule s
    LEFT JOIN trainer_schedule ts ON s.schedule_id = ts.schedule_id
    LEFT JOIN trainers t ON ts.trainer_id = t.id
    ORDER BY s.start_date ASC"; // Order by schedule start time

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
    .trainer-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>

</head>
<body>

<?php include "include/nav.php"; ?>

<section class="home-slider-loop-false inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('img/4.jpg');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center">
                <div class="col-md-8 text-center col-sm-12 element-animate">
                    <h1>Trainer Schedule</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section element-animate">
    <div class="clearfix mb-5 pb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center heading-wrap">
                    <h2>Trainer Schedule</h2>
                    <span class="back-text">Schedules</span>
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
                <th>Trainer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $day = date('l', strtotime($row['start_date'])); // Get day name (e.g., Monday)
                    $start_time = date('h:i A', strtotime($row['start_date'])); // Format time
                    $end_time = date('h:i A', strtotime($row['end_date']));

                    // Check if trainer is assigned
                    $trainer_name = !empty($row['trainer_name']) ? $row['trainer_name'] : 'Unassigned';
                    $trainer_img = !empty($row['trainer_image']) ? 'uploads/trainers/' . $row['trainer_image'] : 'img/default-avatar.png';
            ?>
            <tr>
                <td><?= $day ?></td>
                <td><?= $start_time . " - " . $end_time ?></td>
                <td><?= $row['schedule_name'] ?></td>
                <td>
                    <img src="<?= $trainer_img ?>" class="trainer-img" alt="Trainer">
                    <br><?= $trainer_name ?>
                </td>
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="4">No schedules found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</section>
</main>

<?php include "include/footer.php"; ?>

</body>
</html>
