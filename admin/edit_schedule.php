<?php
include 'dbcon.php';

// Prevent unwanted output
ob_clean();
header('Content-Type: application/json');

$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

if (!empty($id) && !empty($title) && !empty($start) && !empty($end)) {
    $update_query = "UPDATE schedule SET schedule_name='$title', start_date='$start', end_date='$end' WHERE schedule_id='$id'";

    if (mysqli_query($con, $update_query)) {
        echo json_encode(["status" => "success", "message" => "Event updated successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "All fields are required!"]);
}

ob_end_flush();
?>
