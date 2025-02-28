<?php
include 'dbcon.php';

// Prevent extra output
ob_clean();
header('Content-Type: application/json');

$display_query = "SELECT * FROM schedule";
$results = mysqli_query($con, $display_query);

if (!$results) {
    echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
    exit;
}

$events = [];
while ($row = mysqli_fetch_assoc($results)) {
    $events[] = [
        'id'    => $row['schedule_id'],
        'title' => $row['schedule_name'],
        'start' => $row['start_date'],
        'end'   => $row['end_date'],
        'color' => '#' . substr(md5(rand()), 0, 6)
    ];
}

// Send JSON response with success message
ob_end_clean();
echo json_encode([
    "status" => "success",
    "message" => "Events loaded successfully.",
    "events" => $events
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
