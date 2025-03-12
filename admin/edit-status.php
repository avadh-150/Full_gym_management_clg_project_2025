<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

include "dbcon.php";

$success_message = '';
$error_message = '';

// Get appointment details if ID is provided
if (isset($_GET['id'])) {
    $app_id = $_GET['id'];
    $query = "SELECT * FROM appointments WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $app_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $appointment = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$appointment) {
        die("Appointment not found");
    }
} else {
    die("No appointment ID provided");
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_id = $_POST['app_id'];
    $appointment_status = $_POST['appointment_status'];
    $payment_status = $_POST['payment_status'];

    echo "<script> alert('get all fields of updated'); 
        </script>";
    // Update query
    $update_query = "UPDATE appointments SET status = ?, payment_status = ? WHERE id = ?";
    $stmt = mysqli_prepare($con, $update_query);
    mysqli_stmt_bind_param($stmt, 'ssi', $appointment_status, $payment_status, $app_id);

    if (mysqli_stmt_execute($stmt)) {
        
                echo "<script> alert('enter in email section'); 
                </script>";
        // echo "<div style='display: none;'>";

        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Enable verbose debug output - REMOVE FOR PRODUCTION
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'avadhradadiya293@gmail.com';                     // SMTP username
            $mail->Password   = 'nxvv aqtu igeh cytg';                               // SMTP password - STORE SECURELY!
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
            $mail->Port       = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('avadhradadiya293@gmail.com', 'From Fitness Club');
            $mail->addAddress($appointment['email'], $appointment['fullname']); // Send to the client's email


            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Appointment Confirmation';

            // Appointment details
            $appointmentDetails = "
<h2>Appointment Confirmation</h2>
<p>Dear {$appointment['fullname']},</p>
<p>We are pleased to confirm your appointment details as follows:</p>

<table style='width: 100%; border-collapse: collapse;'>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Client Name</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>{$appointment['fullname']}</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Appointment ID</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>{$appointment['id']}</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Appointment Date</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>{$appointment['appointment_date']}</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Appointment Time</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>{$appointment['appointment_time']}</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Service Type</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>{$appointment['service_type']}</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Appointment status</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>{$appointment_status}</td>
</tr>
<tr>
    <th style='border: 1px solid #ddd; padding: 10px;'>Payment Status</th>
    <td style='border: 1px solid #ddd; padding: 10px;'>";

            if ($appointment['payment_status'] == '1') {
                $appointmentDetails .= "Paid";
            } else {
                $appointmentDetails .= "Unpaid";
            }

            $appointmentDetails .= "</td>
</tr>
</table><br>
        <a href='http://localhost/gymphp/my_appointment.php'> View all information about your appointment</a>
        <br>

<p>Thank you for choosing our services. If you have any questions or need further assistance, please do not hesitate to contact us.</p>
<p>Best regards,</p>
<p>Your Team</p>
";

            $mail->Body = $appointmentDetails;

            $mail->send();
            echo 'Message has been sent';

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // echo "</div>";

        $success_message = "Status updated successfully!";
        echo "<script> alert('Status updated successfully'); 
            window.location.href = 'edit-appointment.php?app_id=".$app_id."';
        </script>";
    } else {
        $error_message = "Error updating status: " . mysqli_error($con);
    }
    mysqli_stmt_close($stmt);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Appointment Status</title>
    <?php include "includes/header.php"; ?>
    <style>
        .status-form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .alert {
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
        }
        .alert-danger {
            background-color: #f2dede;
            border-color: #ebccd1;
            color: #a94442;
        }
    </style>
</head>
<body>

<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>

<?php include 'includes/topheader.php' ?>
<?php $page = "appointments"; include 'includes/sidebar.php' ?>

<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
            <a href="appointments.php">Appointments</a>
            <a href="#" class="current">Update Status</a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="status-form">
                    <h3>Update Appointment Status</h3>

                    <?php if ($success_message): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>

                    <?php if ($error_message): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <input type="hidden" name="app_id" value="<?php echo $app_id; ?>">

                        <div class="form-group">
                            <label for="appointment_status">Appointment Status:</label>
                            <select name="appointment_status" id="appointment_status" class="form-control">
                                <option value="scheduled" <?php echo ($appointment['status'] == 'scheduled') ? 'selected' : ''; ?>>Scheduled</option>
                                <option value="completed" <?php echo ($appointment['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                <option value="cancelled" <?php echo ($appointment['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="payment_status">Payment Status:</label>
                            <select name="payment_status" id="payment_status" class="form-control">
                                <option value="0" <?php echo ($appointment['payment_status'] == '0') ? 'selected' : ''; ?>>Unpaid</option>
                                <option value="1" <?php echo ($appointment['payment_status'] == '1') ? 'selected' : ''; ?>>Paid</option>
                            </select>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                            <a href="edit-appointment.php?app_id=<?php echo $app_id; ?>" class="btn">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/matrix.js"></script>

</body>
</html>
