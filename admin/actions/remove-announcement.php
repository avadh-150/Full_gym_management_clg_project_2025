<?php

session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}

if(isset($_GET['id'])){
$id=$_GET['id'];

include 'dbcon.php';


$qry="delete from announcements where id=$id";
$result=mysqli_query($con,$qry);

if($result){
    echo"DELETED";
    header('Location:../announcement.php');
}else{
    echo"ERROR!!";
}
}
if(isset($_GET['contact_id'])){
$id=$_GET['contact_id'];

$conn = mysqli_connect("localhost","root","","gymphp");


$qry="delete from contact where id=$id";
$result=mysqli_query($conn,$qry);

if($result){
    echo"DELETED";
    header('Location:../contact_replay.php');
}else{
    echo"ERROR!!";
}
}



?>