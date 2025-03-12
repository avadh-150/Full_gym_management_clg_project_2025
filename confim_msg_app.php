<?php
// Assuming you have already connected to your database and have the booking details stored in variables.
// For demonstration purposes, let's assume we have the following variables:
$bookingId = "BK001";
$className = "Introduction to PHP";
$sessionDate = "2024-04-01";
$sessionTime = "10:00 AM";
$userEmail = "user@example.com";

// You can also fetch these details from your database if needed.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congratulations on Your Booking!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-family: "Poppins", sans-serif;
            display:flex;
            text-align: center;
            justify-content: center;
        }
       .contrainer{
           max-width: 500px;
           margin-top: 10   0px;
           padding: 20px;
           background-color: #fff;
           border-radius: 10px;
           box-shadow: 0 0 10px rgba(0,0,0,0.1);
           text-align: left;
           line-height: 1.6;
           
 
       }
    </style>
</head>
<body>

<div class="container">
    <h2>Congratulations on Your Booking!</h2>
    <p>We are thrilled to confirm that your booking for the following class/session has been successful:</p>

   

    <p>Please check your email (<a href="mailto:<?php echo $userEmail; ?>"><?php echo $userEmail; ?></a>) for further details and confirmation.</p>

    <p>Thank you for choosing us! If you have any questions, feel free to contact us.</p>

    <a href="contact.php">Contact Us</a>

    <br>
    <br>
    <a href="index.php">Continue to Explore</a>
    <br>
    <br>
    
    <a href="my_appointment.php">View your Appointment Status</a>

</div>

</body>
</html>
