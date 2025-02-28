<?php
require_once 'dbcon.php';

// Prevent extra output
ob_clean();
header('Content-Type: application/json');

if (!empty($_POST['id'])) {
    $eventId = $_POST['id'];
    $delete_query = "DELETE FROM schedule WHERE schedule_id = $eventId";

    if (mysqli_query($con, $delete_query)) {
        echo json_encode(["status" => "success", "message" => "Event has been deleted successfully.","redirect"=>"view_schedule.php"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request!"]);
}

ob_end_flush();
?>
