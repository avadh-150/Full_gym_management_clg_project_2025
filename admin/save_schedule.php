<?php                
require 'dbcon.php'; 
$event_name = $_POST['schedule_name'];
$event_start_date = date("y-m-d", strtotime($_POST['start_date'])); 
$event_end_date = date("y-m-d", strtotime($_POST['end_date'])); 
			
$insert_query = "INSERT INTO `schedule` (`schedule_name`, `start_date`, `end_date`) 
                VALUES ('$event_name', '$event_start_date', '$event_end_date')";

if(mysqli_query($con, $insert_query))
{
	$data = [
                'status' => true,
                'msg' => 'Event added successfully!'
            ];
}
else
{
	$data = [
                'status' => false,
                'msg' => 'Sorry, Event not added.'				
            ];
}
echo json_encode($data);	
?>
