<?php
// session_start();
include "include/header.php";
// require_once 'configuration.php';


?>

<!-- <link rel="stylesheet" href="css/plan.css"> -->
<?php include "include/nav.php"; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<body>

    <!-- Navigation -->
    <?php
    // error_reporting(0);
    include "connection.php";

    // Check login status before any output
    if (!isset($_SESSION['auth_user'])) {
        echo "<script>alert('Please login firsr to access this side');
window.location.href = 'login.php';
exit();
</script>";
    }

    // Check for member_id before including header/nav
    if (!isset($_GET['appointmentId']) || empty($_GET['appointmentId'])) {
        $_SESSION['message'] = "Invalid member ID provided";
        echo "<script>

    window.location.href = 'my_appointment.php';
</script>";
        exit();
    }

    $app_id = mysqli_real_escape_string($con, $_GET['appointmentId']);

    // Fetch user details with prepared statement
    $app_user = "select a.*,a.status as status_app,a.id as app_id,t.name as name,t.id as trainer_id from appointments a,trainers t where a.trainer_id=t.id and a.id='$app_id'";
    $user_result = mysqli_query($con, $app_user);

    if (!$user_result || mysqli_num_rows($user_result) == 0) {
        $_SESSION['message'] = "Appointment is not found!";
        echo "<script>

    window.location.href = 'my_appointment.php';
</script>";
        exit();
    }

    $user = mysqli_fetch_assoc($user_result);

    // Fetch membership plan details
    if ($user['trainer_id']) {
        $t_id = $user['trainer_id'];

        // Use prepared statement for plan query
        $t_query = "SELECT * FROM trainers WHERE id = ?";
        $stmt = mysqli_prepare($con, $t_query);
        mysqli_stmt_bind_param($stmt, "i", $t_id);
        mysqli_stmt_execute($stmt);
        $t_result = mysqli_stmt_get_result($stmt);
        $plan = mysqli_fetch_assoc($t_result);

        $USERID = $user['user_id'];
        $user_query = "select * from users where id = $USERID";
        $users_result = mysqli_query($con, $user_query) or die($con->error);

        $users_details = mysqli_fetch_assoc($users_result);


        // // Use prepared statement for payment query
        $pay_user = "SELECT * FROM payments WHERE appointment_id = $app_id";

       $pay_sql=mysqli_query($con,$pay_user);

       $pay_row = mysqli_fetch_assoc($pay_sql);

       if (!$plan) {
           // if (!$plan || !$pay_row) {
            echo '<div class="container mt-5">
            <div class="alert alert-danger">
            No membership plan details found for this member.
            <br><a href="my_membership.php" class="btn btn-primary mt-2">Back to Membership List</a>
            </div>
            </div>';
            include "include/footer.php";
            exit();
        }
    } else {
        echo '<div class="container mt-5">
            <div class="alert alert-warning">
                No active membership found!
                <br><a href="my_membership.php" class="btn btn-primary mt-2">Back to Membership List</a>
            </div>
          </div>';
        include "include/footer.php";
        exit();
    }
    ?>
    <br>
    <br>
    <br>
    <br>

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a> / </li>
            <li><a href="my_appointment.php">My Appointments</a> / </li>
            <li class="active">View Details</li>
        </ol>
        <div class="card">
            <div class="card-header">
                Membership Details
                <!-- <a href="my_membership.php" class="btn btn-info"><i class="fa fa-reply"></i> Back</a> -->
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Left Side - User Details -->
                    <div class="col-md-4">
                        <h4>Appointment Details</h4>
                        <!-- <hr width="200px" color="#000" style="float:left;"> -->
                        <hr color="#000">
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Appointment ID:</label>
                            <div class="border p-1"><?= htmlspecialchars($user['app_id']); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Client Full Name:</label>
                            <div class="border p-1"><?= htmlspecialchars($user['name']); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Client Email:</label>
                            <div class="border p-1"><?= htmlspecialchars($user['email']); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Client Phone:</label>
                            <div class="border p-1"><?= htmlspecialchars($user['contact']); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Client Age:</label>
                            <div class="border p-1"><?= htmlspecialchars($user['Age']); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Current Fitness Level:</label>
                            <div class="border p-1"><b>

                                    <?= htmlspecialchars($user['fitness_level']); ?></div>
                            </b>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">User Name:</label>
                            <div class="border p-1"><?= htmlspecialchars($users_details['name']); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Join_date:</label>
                            <div class="border p-1"><?= htmlspecialchars($users_details['join_date']); ?>
                            </div>
                        </div>
                        

                    </div>
                    <div class="col-md-4">
                        <h4>Date/Time/Other Details</h4>
                        <!-- <hr width="200px" color="#000" style="float:left;"> -->
                        <hr color="#000">
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Appointment Date:</label>
                            <div class="border p-1"><?php echo date('l, F j, Y', strtotime($user['appointment_date'])); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Appointment Time:</label>
                            <div class="border p-1"><?php echo date('g:i A', strtotime($user['appointment_time'])); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold"><b>Trainer</b></label>
                            <div class="border p-1">
                                <a href="trainers/profile.php?id=<?php echo $user['trainer_id'] ?>">

                                    <?= htmlspecialchars($user['name']); ?>
                            </div>
                            </a>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Service Type:</label>
                            <div class="border p-1"><?= htmlspecialchars($user['service_type']); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Goal Of description:</label>
                            <div class="border p-1"><?= htmlspecialchars($user['Age']); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Occupation:</label>
                            <div class="border p-1"><?= htmlspecialchars($user['description']); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Booking Date:</label>
                            <div class="border p-1"><?= htmlspecialchars($user['created_at']); ?></div>
                        </div>
                        <hr>
                        <label style="font-weight:bold;">Booking Status</label>
                        <div class="border p-1 mb-3">
                            <?php

                            if ($user['status_app'] == "scheduled") {
                                // echo '<label class="bg bg-danger" style="color:#fff; padding:5px 10px; border-radius:3px;">scheduled</label>';
                                echo '<label class="bg bg-warning" style="color:#fff; padding:5px 10px; border-radius:3px;">scheduled</label>';
                            } else if ($user['status_app'] == 'completed') {
                                echo '<label class="bg bg-success" style="color:#fff; padding:5px 10px; border-radius:3px;">completed</label>';
                            } else if ($user['status_app'] == 'cancelled') {
                                echo '<label class="bg bg-danger" style="color:#fff; padding:5px 10px; border-radius:3px;">cancelled</label>';
                            }
                            ?>
                        </div>

                    </div>





                    <!-- <a href="confirm_payment.php?plan_id=" name="place_order" class="btn btn-primary">Proceed to Payment</a> -->

                    <div class="col-md-4">
                        <h4>Payment Details</h4>
                        <hr color="#000">
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Payment Mode</label>
                            <div class="border p-1"><?= htmlspecialchars($user['payment_method']); ?></div>
                        </div>
                        <hr>
                        <label style="font-weight:bold;">Payment Status</label>
                        <div class="border p-1 mb-3">
                            <?php
                            if ($user['payment_status'] == 0) {
                                echo '<span class="badge bg-danger text-white" style="font-size:15px">Pending ❌</span>'; // Red for inactive
                            } else if ($user['payment_status'] == 1) {
                                echo '<span class="badge bg-success text-white" style="font-size:15px">Paid </span>' . '✅'; // Green for active
                            }
                            ?>
                        </div>
<?php 
    if($user['payment_method'] == 'credit_card')
    {
?>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Date</label>
                            <div class="border p-1"><?= $pay_row['payment_date']; ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Paid Amount</label>
                            <div class="border p-1">₹<?= number_format($pay_row['amount'], 2); ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Method:</label>
                            <div class="border p-1"><?= $pay_row['payment_method']; ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Payment_Type:</label>
                            <div class="border p-1"><?= $pay_row['payment_type']; ?></div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="fw-bold">Transaction ID:</label>
                            <div class="border p-1"><?= $pay_row['transaction_id']; ?></div>
                        </div>
                        <hr>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <?php include "include/footer.php"; ?>
    
</body>
<script>
    // Form validation
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        const form = e.target;
        if (!form.checkValidity()) {
            e.preventDefault();
            alert('Please fill all required fields correctly.');
        }
    });
</script>

</html>
<?php //} 
?>