<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #9face6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .forgot-password-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .forgot-password-container:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        .forgot-password-container h2 {
            margin-bottom: 25px;
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }
        .forgot-password-container input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            transition: border 0.3s ease;
        }
        .forgot-password-container input[type="email"]:focus {
            border-color: #28a745;
        }
        .forgot-password-container input[type="submit"] {
            background: linear-gradient(135deg, #28a745, #218838);
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .forgot-password-container input[type="submit"]:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
        }
        .message {
            margin-top: 20px;
            color: #28a745;
            font-size: 14px;
            font-weight: bold;
        }
        .error {
            margin-top: 20px;
            color: #dc3545;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Enter your email" required>
            <input type="submit" value="Verify Email">
        </form>
        <?php
        if (isset($_GET['message'])) {
            echo '<div class="message">' . htmlspecialchars($_GET['message']) . '</div>';
        }
        if (isset($_GET['error'])) {
            echo '<div class="error">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        ?>
    </div>
</body>
</html>

<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');

require('PHPMailer/SMTP.php');

require('PHPMailer/PHPMailer.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            include "dbcon.php";
            $email = trim($_POST['email']);

            // Database connection

            // Check connection
            if (!$con) {
                die("<div class='error'>Connection failed: " . mysqli_connect_error() . "</div>");
            }

            // Check if email exists
            $query = "SELECT * FROM admin WHERE email = '" . mysqli_real_escape_string($con, $email) . "'";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {

                $_SESSION['EMAIL'] = mysqli_real_escape_string($con, $email) ;
                echo "<script>alert('".$_SESSION['EMAIL']."');</script>";

                $otp = rand(100000, 999999);
        
                // Save the OTP in the database
                $update_query = "UPDATE admin SET OTP = '$otp' WHERE email = '$email'";
                if (mysqli_query($con, $update_query)){


                    $mail = new PHPMailer(true);

                    try {
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'avadhradadiya293@gmail.com';
                        $mail->Password = 'nxvv aqtu igeh cytg';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                        $mail->Port = 465;
                   
                        $mail->setFrom('avadhradadiya293@gmail.com', $name);
                        $mail->addAddress($email);
                   
                        $mail->isHTML(true);
                        $mail->Subject = 'OTP CODE for Gym admin';
                        $email_template = " <br> Email: $email <br> OTP: $otp";
                        $mail->Body = $email_template;
                   
                        $mail->send();
                        echo "<script>alert('email verify successfully. OTP has been sent')
                        window.location.href='otp_enter.php'
                        </script>";
                   
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                   
                }                
                // You can integrate email sending logic here
            } else {
                echo '<script>alert("Email does not exist in our records");</script>';

                echo '<div class="error">.</div>';
            }

            mysqli_close($conn);
        }





        ?>