<head>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />

</head>

<script>
    alertify.set('notifier', 'position', 'top-right');
    <?php

    if (isset($_SESSION['message'])) {
    ?>
        alertify.set('notifier', 'position', 'top-right');


        alertify.success('<?= $_SESSION['message'] ?>');
    <?php
        unset($_SESSION['message']);
    } ?>
</script>
<?php
session_start();
include "connection.php";
include "configuration.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Check if user is logged in
if (!isset($_SESSION['auth_user'])) {
    echo "<script>alert('User is not logged in'); window.location.href='../index.php';</script>";
    exit();
}
if (isset($_POST['app_date']) && isset($_POST['app_time']) && isset($_POST['app_trainerid']) && isset($_POST['app_service']) && isset($_POST['app_pay_method'])) {
    // Collect all details
    $app_date = mysqli_real_escape_string($con, $_POST['app_date']);
    $app_time = mysqli_real_escape_string($con, $_POST['app_time']);
    $app_trainerid = mysqli_real_escape_string($con, $_POST['app_trainerid']);
    $app_service = mysqli_real_escape_string($con, $_POST['app_service']);
    $app_pay_method = mysqli_real_escape_string($con, $_POST['app_pay_method']);

    // Fetch user details
    $app_sql = "SELECT * FROM appointments WHERE appointment_date = '$app_date' AND trainer_id = $app_trainerid AND service_type = '$app_service' AND  appointment_time='$app_time' AND payment_method='$app_pay_method'";
    $app_result = mysqli_query($con, $app_sql);

    if (!$app_result || mysqli_num_rows($app_result) == 0) {
        echo "<script>alert('Could not find user');</script>";
        exit();
    }

    $app_items = mysqli_fetch_assoc($app_result);
    $app_id = $app_items['id'];
    $app_name = $app_items['fullname'];
    $app_email = $app_items['email'];
    $user_id = $app_items['user_id'];
    $user_status = $app_items['status'];
    $price = 550;
    if (isset($_POST['stripeToken'])) {
        $token = $_POST['stripeToken'];

        echo "<script>
    alert('stripeToken is collected');
    </script>";
        try {
            // Process payment with Stripe
            $charge = \Stripe\Charge::create([
                "amount" => $price * 100, // Amount in paise
                // "amount" => $price * 100, // Amount in paise
                "currency" => "inr",
                "description" => "Appointment Payment",
                "source" => $token,
            ]);

            // Check if payment succeeded
            if ($charge->status === 'succeeded') {
                $txn_id = $charge->balance_transaction; // Stripe transaction ID
                $payment_status = '1'; // Payment success
                $amount_inr = $price * 100; // Amount in INR

                // payment process
                echo "<script>
              alert('Payment is Initiated');
              </script>";
                // Insert payment details
                $payment_date = date('Y-m-d H:i:s');
                $payment_query = "INSERT INTO payments (amount, payment_date, payment_method, transaction_id, payment_status, payment_type,appointment_id, user_id) 
                              VALUES ('$price', '$payment_date', '$app_pay_method', '$txn_id','$payment_status', 'appointment', '$app_id','$user_id')";
                $payment_result = mysqli_query($con, $payment_query);

                if (!$payment_result) {
                    echo "<script>alert('Payment insertion failed');</script>";
                    exit();
                }

                $payment_id = mysqli_insert_id($con);

                // Verify payment status
                $pay_sql = "SELECT * FROM payments WHERE id = '$payment_id' AND payment_status = '1'";
                $pay_result = mysqli_query($con, $pay_sql);
                $pay = mysqli_fetch_array($pay_result);
                $pay_txn = $pay['transaction_id'];
                $pay_txn = $pay['transaction_id'];
                if (!$pay_result || mysqli_num_rows($pay_result) == 0) {
                    echo "<script>alert('Payment status is invalid');</script>";
                    exit();
                }
                $update_user_app = "update appointments set payment_id = $payment_id , payment_status = '1' where id = '$app_id'";
                $update_user_plan_app = mysqli_query($con, $update_user_app);

                if ($update_user_plan_app) {

                    $update_user="select * from users where id=$user_id";
                    $update_query = mysqli_query($con, $update_user);
                    $user_result=mysqli_fetch_assoc($update_query);
                    $user_name = $user_result["name"];
                    echo "<div style='display: none;'>";
                    //Create an instance; passing `true` enables exceptions
                    // echo "<div id='loadingMsg'>Loading...</div>";

                    $mail = new PHPMailer(true);

                    try {
                        //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'avadhradadiya293@gmail.com';                     //SMTP username
                        $mail->Password   = 'nxvv aqtu igeh cytg';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('avadhradadiya293@gmail.com', $user_name);
                        $mail->addAddress($app_email);

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'no reply';
                        // Appointment details
                        $appointmentDetails = "
        <h2>Appointment Confirmation</h2>
        <p>Dear User $user_name,</p>
        <p>We are pleased to confirm your appointment details as follows:</p>

        <table style='width: 100%; border-collapse: collapse;'>
            <tr>
                <th style='border: 1px solid #ddd; padding: 10px;'>Client Name</th>
                <td style='border: 1px solid #ddd; padding: 10px;'>$app_name</td>
            </tr>
            <tr>
                <th style='border: 1px solid #ddd; padding: 10px;'>Appointment ID</th>
                <td style='border: 1px solid #ddd; padding: 10px;'>$app_id</td>
            </tr>
            <tr>
                <th style='border: 1px solid #ddd; padding: 10px;'>Appointment Date</th>
                <td style='border: 1px solid #ddd; padding: 10px;'>$app_date</td>
            </tr>
            <tr>
                <th style='border: 1px solid #ddd; padding: 10px;'>Appointment Time</th>
                <td style='border: 1px solid #ddd; padding: 10px;'>$app_time</td>
            </tr>
         
            <tr>
                <th style='border: 1px solid #ddd; padding: 10px;'>Service Type</th>
                <td style='border: 1px solid #ddd; padding: 10px;'>$app_service</td>
            </tr>
            <tr>
                <th style='border: 1px solid #ddd; padding: 10px;'>Appointment status</th>
                <td style='border: 1px solid #ddd; padding: 10px;'>$user_status</td>
            </tr>
               <tr>
                <th style='border: 1px solid #ddd; padding: 10px;'>transaction ID</th>
                <td style='border: 1px solid #ddd; padding: 10px;'>$pay_txn</td>
            </tr>
            <tr>
                <th style='border: 1px solid #ddd; padding: 10px;'>Payment Method</th>
                <td style='border: 1px solid #ddd; padding: 10px;'>$app_pay_method</td>
            </tr>
            <tr>
                <th style='border: 1px solid #ddd; padding: 10px;'>Amount Paid</th>
                <td style='border: 1px solid #ddd; padding: 10px;'>$price</td>
            </tr>
        </table><br>
        <a href='http://localhost/gymphp/my_appointment.php'> View the All Information about appointment</a>
        <br>

        <p>Thank you for choosing our services. If you have any questions or need further assistance, please do not hesitate to contact us.</p>
        <p>Best regards,</p>
        <p>Your Team</p>
    ";
    

                        $mail->Subject = 'Appointment Confirmation';
                        $mail->Body    = $appointmentDetails;

                        $mail->send();
                        echo 'Message has been sent';
                        // echo "<script>document.getElementById('loadingMsg').innerHTML = 'Message has been sent';</script>";
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                    // Wait for a few seconds before redirecting
                    echo "</div>";
                    $_SESSION['message'] = "Payment is successful!.";
                    echo "<script>alert('Payment is successful! Your appointment successfully booked.');
                          window.location.href='confim_msg_app.php';
                          </script>";
                    exit();
                    // $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                } else {
                    $msg = "<div class='alert alert-danger'>$email - This email address do not found.</div>";
                }

                // header("Location: member-view.php");


            } else {
                $_SESSION['message'] = "Something went wrong!";
                echo "<script>alert('Payment failed: Stripe status not succeeded');</script>";
                exit();
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            echo "<script>alert('Stripe error: " . $e->getMessage() . "');</script>";
            exit();
        }
    } else {
        echo "<script>alert('Stripe token is missing');</script>";
        exit();
    }
}
?>