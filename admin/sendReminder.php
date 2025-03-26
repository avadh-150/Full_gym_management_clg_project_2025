<?php

session_start();
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}

if(isset($_GET['id'])){
$id=$_GET['id'];

include 'dbcon.php';


$qry="UPDATE users SET remainder = '1' where member_id='$id'";
$result=mysqli_query($con,$qry);

if($result){
    echo '<script>alert("Notification sent to selected customer!")</script>';
    echo '<script>window.location.href = "members.php";</script>';
    
}else{
    echo"ERROR!!";
}
}
?><!-- Visit codeastro.com for more projects -->