<?php

session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}

include('../dbcon.php');

 
 if (isset($_GET['id'])) {
     $id = $_GET['id'];
 
 
 
     $qry = "delete from schedule where schedule_id=$id";
     $result = mysqli_query($con, $qry);
 
     if ($result) {
         echo "DELETED";
         header('Location:../schedule.php');
     } else {
         echo "ERROR!!";
     }
 }
?>
<script>
// alert("Delete Successfully");
window.location = "../attendance.php";
</script>


 