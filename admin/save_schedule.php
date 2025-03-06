<?php                
require 'dbcon.php'; 
if(isset($_REQUEST['assign_schedule'])){
    $title=$_POST['name'];
    $day=$_POST['days'];
    $stime=$_POST['stime'];
    $etime=$_POST['etime'];
    $tid=$_POST['trainer_id'];
$insert_query = "INSERT INTO schedule (schedule_day,schedule_name,trainer_id ,start_time, end_time) 
                VALUES ('$day', '$title', '$tid', '$stime', '$etime')";

if(mysqli_query($con, $insert_query))
{
    echo "<script>alert('Schedule Added Successfully')</script>";
    echo "<script>window.open('schedule.php','_self')</script>";
	
}
else{
    echo "<script>alert('Failed to Add Schedule')</script>";
    echo "<script>window.open('schedule.php','_self')</script>";
    
}
}
?>
