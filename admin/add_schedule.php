<?php
require_once "dbcon.php";

// Prevent extra output
ob_clean();
header('Content-Type: application/json');

$title = $_POST['title'] ?? "";
$start = $_POST['start'] ?? "";
$end = $_POST['end'] ?? "";

if (!empty($title) && !empty($start) && !empty($end)) {
    $sqlInsert = "INSERT INTO schedule (schedule_name, start_date, end_date) VALUES ('$title', '$start', '$end')";
    $result = mysqli_query($con, $sqlInsert);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "The Schedule is Successfully Set Up.", "redirect" => "view_schedule.php"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "All fields are required!"]);
}

ob_end_flush();
?>
