<?php
session_start();
include 'connection.php';
require_once 'configuration.php';
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
if (!isset($_SESSION['auth_user'])) {
    echo "<script>alert('User is not logged in'); window.location.href='../index.php';</script>";
    exit();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';



$tra_id = $_SESSION['TrainersID'];
// echo "<script>alert('$tra_id');</script>";
$userID = $_SESSION['auth_user']['user_id'];
$sql = "SELECT a.*,a.email as aemail ,a.id as app_id, t.name as trainer_name, t.specialization 
        FROM appointments a, trainers t WHERE a.trainer_id = t.id AND a.user_id=$userID AND a.trainer_id=$tra_id";
$result = $con->query($sql);

if ($result) {

    if ($result->num_rows > 0) {
        $appointment = $result->fetch_assoc();
    } else {
        header("Location: appointment.php");
        exit();
    }
   

    // $stmt->close();
} else {
    header("Location: appointment.php");
    exit();
}

// Clear the session variable after retrieving the data
unset($_SESSION['appointment_ref']);
?>

<?php include "include/header.php"; ?>

<style>
    :root {
        --primary-color: #ff5722;
        --primary-dark: #e64a19;
        --primary-light: #ffccbc;
        --secondary-color: #2c3e50;
        --accent-color: #4CAF50;
        --light-color: #f8f9fa;
        --dark-color: #343a40;
        --gray-color: #6c757d;
        --success-color: #28a745;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --body-bg: #ffffff;
        --text-color: #333333;
        --border-color: #dee2e6;
        --border-radius: 8px;
        --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    .confirmation-section {
        padding: 80px 0;
        background-color: #f9f9f9;
    }

    .confirmation-container {
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        overflow: hidden;
    }

    .confirmation-header {
        padding: 40px 20px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
    }

    .confirmation-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        animation: pulse 2s infinite;
    }

    .confirmation-header h1 {
        color: white;
        margin-bottom: 10px;
    }

    .confirmation-header p {
        opacity: 0.9;
        font-size: 1.1rem;
    }

    .confirmation-details {
        padding: 40px;
    }

    .confirmation-reference {
        text-align: center;
        font-size: 1.2rem;
        margin-bottom: 30px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: var(--border-radius);
    }

    .confirmation-reference strong {
        font-size: 1.4rem;
        color: var(--primary-color);
        margin-left: 10px;
    }

    .confirmation-card {
        margin-bottom: 30px;
        border: 1px solid #e9ecef;
        border-radius: var(--border-radius);
        padding: 25px;
    }

    .confirmation-card h3 {
        margin-bottom: 20px;
        font-size: 1.3rem;
        color: var(--secondary-color);
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e9ecef;
    }

    .detail-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .detail-label {
        font-weight: 500;
        color: var(--gray-color);
    }

    .confirmation-info {
        margin-bottom: 30px;
    }

    .confirmation-info h3 {
        margin-bottom: 20px;
        font-size: 1.3rem;
    }

    .next-steps {
        list-style: none;
        padding: 0;
    }

    .next-steps li {
        margin-bottom: 15px;
        padding-left: 30px;
        position: relative;
    }

    .next-steps li i {
        position: absolute;
        left: 0;
        top: 3px;
        color: var(--primary-color);
    }

    .confirmation-actions {
        margin-top: 30px;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
    }

    .related-services-section {
        padding: 80px 0;
    }

    .service-card {
        text-align: center;
        padding: 30px;
        background-color: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        height: 100%;
        transition: var(--transition);
    }

    .service-card:hover {
        transform: translateY(-10px);
    }

    .service-icon {
        font-size: 3rem;
        color: var(--primary-color);
        margin-bottom: 20px;
    }

    .service-card h3 {
        margin-bottom: 15px;
    }

    .service-card p {
        margin-bottom: 20px;
        color: var(--gray-color);
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    @media print {

        .site-header,
        .related-services-section,
        .site-footer,
        .confirmation-actions {
            display: none;
        }

        .confirmation-header {
            background: #f1f1f1 !important;
            color: #333 !important;
        }

        .confirmation-header h1,
        .confirmation-header p {
            color: #333 !important;
        }
    }
</style>
</head>

<body>

    <?php
    // $userID=$_SESSION['auth_user']['user_id'];
    // $sql1 = "SELECT a.*,a.id as app_id ,t.name as trainer_name, t.specialization,t.*
    //     FROM appointments a, trainers t WHERE a.trainer_id = t.id AND a.user_id=$userID AND";
    // $result1 = $con->query($sql1);

    if ($appointment['payment_method'] == 'credit_card') {

    ?>
        <!-- Confirmation Section -->
        <section class="confirmation-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="confirmation-container">
                            <div class="confirmation-header text-center">
                                <div class="confirmation-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h1>Make Payment To Confirmed!</h1>
                                <!-- <p>Your appointment has been successfully scheduled</p> -->
                            </div>

                            <div class="confirmation-details">
                                <!-- <div class="confirmation-reference">
                                <span>Booking Reference:</span>
                                <strong><?php echo $appointment['id']; ?></strong>
                            </div>
                             -->
                                <div class="confirmation-card">
                                    <h3>Appointment Details</h3>
                                    <div class="detail-item">
                                        <span class="detail-label">Date:</span>
                                        <span class="detail-value"><?php echo date('l, F j, Y', strtotime($appointment['appointment_date'])); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Time:</span>
                                        <span class="detail-value"><?php echo date('g:i A', strtotime($appointment['appointment_time'])); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Trainer:</span>
                                        <span class="detail-value"><?php echo $appointment['trainer_name']; ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Session Type:</span>
                                        <span class="detail-value">
                                            <?php
                                            echo $appointment['service_type'];
                                            ?>
                                        </span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Payment Method:</span>
                                        <span class="detail-value">
                                            <?php
                                            echo isset($appointment['payment_method']) ? $appointment['payment_method'] : 'N/R';
                                            ?>
                                        </span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Amount:</span>
                                        <span class="detail-value">
                                            ₹<?php echo number_format($appointment['amount'] ?? $appointment['amount'], 2); ?>
                                        </span>
                                    </div>
                                </div>


                                <div class="confirmation-actions text-center">
                                    <!-- <a href="index.php" class="btn btn-outline-primary">Return to Home</a> -->
                                    <form action="appointment_payment.php" method="post" id="paymentButton" class="payment-button" style="display: block;">

                                        <input type="hidden" name="app_date" id="" value="<?php echo $appointment['appointment_date'] ?>">
                                        <input type="hidden" name="app_time" id="" value="<?php echo $appointment['appointment_time'] ?>">
                                        <input type="hidden" name="app_trainerid" id="" value="<?php echo $appointment['trainer_id'] ?>">
                                        <input type="hidden" name="app_service" id="" value="<?php echo $appointment['service_type'] ?>">
                                        <input type="hidden" name="app_pay_method" id="" value="<?php echo $appointment['payment_method'] ?>">
                                        <input type="hidden" name="price" id="" value="<?php echo $appointment['amount'] ?>">

                                        <button type="submit" name="place_order" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-size: 1.2rem;">
                                            Proceed to Payment
                                            <div id="stripe-container" style="display: none; width: 100%;">
                                                <script src="https://checkout.stripe.com/checkout.js"
                                                    class="stripe-button"
                                                    data-key="<?= htmlspecialchars($Publishable_key) ?>"
                                                    data-amount="<?php echo number_format($appointment['amount'] , 2) * 100; ?>"
                                                    data-name="Fitness Club"
                                                    data-description="Continue the Payment for Booking Session"
                                                    data-currency="inr"
                                                    data-email="<?php echo $appointment['aemail'] ?>">
                                                </script>
                                            </div>
                                        </button>
                                    </form>
                                    <!-- <a href="#" class="btn btn-outline-secondary" onclick="window.print()"><i class="fas fa-print"></i> Print Confirmation</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    } else  if ($appointment['payment_method'] == 'pay_at_gym') {

        $app_date = $appointment['appointment_date'];
        $app_time = $appointment['appointment_time'];
        $app_email = $appointment['aemail'];
        $app_name = $appointment['fullname'];
        $app_id = $appointment['app_id'];
        $price = $appointment['amount'];
        $app_service = $appointment['service_type'];
        $app_trainer = $appointment['trainer_name'];
        $app_status = $appointment['status'];
        // $app_status = $appointment['payment_method'];
        $userID = $appointment['user_id'];
        $update_user = "select * from users where id=$userID";
        $update_query = mysqli_query($con, $update_user);
        $user_result = mysqli_fetch_assoc($update_query);
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
    <th style='border: 1px solid #ddd; padding: 10px;'>Your Instructor</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>$app_trainer</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Service Type</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>$app_service</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Appointment status</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>$app_status</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Cost</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>$price</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Payment Mode</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>Pay At Gym</td>
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

        echo "<script>alert('Payment is successful! Your appointment successfully booked.');
                          window.location.href='confim_msg_app.php';
                          </script>";
        // exit();


    ?>


        <!-- Confirmation Section -->
        <!-- <section class="confirmation-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="confirmation-container">
                            <div class="confirmation-header text-center">
                                <div class="confirmation-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h1>Booking Confirmed!</h1>
                                <p>Your appointment has been successfully scheduled</p>
                            </div>

                            <div class="confirmation-details">
                                <div class="confirmation-reference">
                                    <span>Booking Reference:</span>
                                    <strong><?php echo $appointment['id']; ?></strong>
                                </div>

                                <div class="confirmation-card">
                                    <h3>Appointment Details</h3>
                                    <div class="detail-item">
                                        <span class="detail-label">Date:</span>
                                        <span class="detail-value"><?php echo date('l, F j, Y', strtotime($appointment['appointment_date'])); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Time:</span>
                                        <span class="detail-value"><?php echo date('g:i A', strtotime($appointment['appointment_time'])); ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Trainer:</span>
                                        <span class="detail-value"><?php echo $appointment['trainer_name']; ?></span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Session Type:</span>
                                        <span class="detail-value">
                                            <?php
                                            echo $appointment['service_type'];
                                            ?>
                                        </span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Payment Method:</span>
                                        <span class="detail-value">
                                            <?php
                                            echo isset($appointment['payment_method']) ? $appointment['payment_method'] : 'N/R';
                                            ?>
                                        </span>
                                    </div>
                                    <div class="detail-item">
                                        <span class="detail-label">Amount:</span>
                                        <span class="detail-value">
                                            $<?php echo number_format($appointment['price'] ?? 0, 2); ?>
                                        </span>
                                    </div>
                                </div>


                                <div class="confirmation-actions text-center">
                                    <a href="index.php" class="btn btn-outline-primary">Return to Home</a>
                                    <a href="my_appointment.php" class="btn btn-primary">View My Appointments</a>
                                    <a href="#" class="btn btn-outline-secondary" onclick="window.print()"><i class="fas fa-print"></i> Print Confirmation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    <?php } ?>
    <!-- Related Services Section -->
    <!-- <section class="related-services-section">
        <div class="container">
            <div class="section-header text-center">
                <h2>Enhance Your Training Experience</h2>
                <p>Explore these additional services to maximize your fitness results</p>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-apple-alt"></i>
                        </div>
                        <h3>Nutrition Consultation</h3>
                        <p>Get personalized nutrition advice to complement your training program and accelerate your results.</p>
                        <a href="services.php#nutrition" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Group Classes</h3>
                        <p>Join our energetic group classes for additional motivation and a fun workout experience.</p>
                        <a href="services.php#group-classes" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h3>Fitness Assessment</h3>
                        <p>Get a comprehensive fitness assessment to track your progress and optimize your training.</p>
                        <a href="services.php#fitness-assessment" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

     -->

</body>

</html>