<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $age = $_POST['age'];
    $payment_method = $_POST['payment_method'];
    $trainer_id= $_POST['trainer'];
    $des= $_POST['fitness_goals'];
    $level= $_POST['fitness_level'];
    $stype=$_POST['session_type'];
    $price=$_POST['price'];
    $payment_method= $_POST['payment_method'];
    $userID= $_SESSION['auth_user']['user_id'];
    
    // Check if the selected time slot is available
    $check_availability = "SELECT * FROM appointments WHERE appointment_date = '$appointment_date' AND appointment_time = '$appointment_time' AND user_id = '$userID'";
    $result1 = mysqli_query($con,$check_availability);
    
    if (mysqli_num_rows($result1) > 0) {
        echo "This time slot is already booked. Please select another time.";
        exit;
    }
    $_SESSION['TrainersID']=$trainer_id;
    // Insert the appointment into the database
    // $sql = "INSERT INTO appointments (appointment_date, appointment_time, name, email, contact, payment_method, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')";
    $sql = "INSERT INTO appointments (trainer_id,user_id,appointment_date, appointment_time, fullname, email, contact,Age,service_type,amount,description,fitness_level,payment_method) VALUES ('$trainer_id','$userID','$appointment_date','$appointment_time', '$fullname','$email', '$contact',$age,'$stype','$price', '$des','$level','$payment_method')";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "success";
    } else {
        echo "Error booking appointment: " . mysqli_error($con);
    }

} else {
    echo "Invalid request method";
}

$con->close();
?>