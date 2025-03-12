<?php
include "connection.php";

if (!empty($_POST['trainer']) && !empty($_POST['date']) && !empty($_POST['time']) && !empty($_POST['session'])) {
    $trainer = $_POST['trainer'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $session = $_POST['session'];

    // Use a prepared statement to prevent SQL injection
    // $sql = "SELECT * FROM schedule WHERE schedule_name = '$session' AND trainer_id = $trainer ";
    $sql = "SELECT * FROM schedule WHERE schedule_name = '$session' AND trainer_id = $trainer AND start_time = '$time' ";
            

    if ($result = mysqli_query($con, $sql)) {
       

        echo (mysqli_num_rows($result) > 0) ? "Available" : "Not Available";

    } else {
        echo "Error";
    }
} else {
    echo "Missing required fields";
}
?>
