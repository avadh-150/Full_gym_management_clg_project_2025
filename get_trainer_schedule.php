<?php
include 'connection.php';

if(isset($_POST['trainer_id'])) {
    $trainer_id = $_POST['trainer_id'];
    
    $query = "SELECT * FROM schedule WHERE trainer_id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $trainer_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $schedules = array();
    while($row = mysqli_fetch_assoc($result)) {
        $schedules[] = $row;
    }
    
    echo json_encode($schedules);
}
?>