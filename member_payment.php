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

// Check if user is logged in
if (!isset($_SESSION['auth_user'])) {
    echo "<script>alert('User is not logged in'); window.location.href='../index.php';</script>";
    exit();
}
if(isset($_POST['pid'])&& isset($_POST['uid'])){
// Collect all details
$planID = mysqli_real_escape_string($con, $_POST['pid']);
$userID = mysqli_real_escape_string($con, $_POST['uid']);

// Fetch user details
$user_sql = "SELECT * FROM users WHERE current_plan_id = $planID AND id = $userID";
$user_result = mysqli_query($con, $user_sql);

if (!$user_result || mysqli_num_rows($user_result) == 0) {
    echo "<script>alert('Could not find user');</script>";
    exit();
}

$user_items = mysqli_fetch_assoc($user_result);
$member_id = $user_items['member_id'];

// Fetch plan details
$plan_sql = "SELECT * FROM membership_plans WHERE id = $planID";
$plan_result = mysqli_query($con, $plan_sql);

if (!$plan_result || mysqli_num_rows($plan_result) == 0) {
    echo "<script>alert('Could not find plan');</script>";
    exit();
}

$plan_items = mysqli_fetch_assoc($plan_result);
$price = $plan_items['price'];
$duration_date = $plan_items['duration'];

// Check if Stripe token exists
if (isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken'];

    echo "<script>
    alert('stripeToken is collected');
    </script>";
    try {
        // Process payment with Stripe
        $charge = \Stripe\Charge::create([
            "amount" => $price * 100, // Amount in paise
            "currency" => "inr",
            "description" => "Membership Payment",
            "source" => $token,
        ]);

        // Check if payment succeeded
        if ($charge->status === 'succeeded') {
            $txn_id = $charge->balance_transaction; // Stripe transaction ID
            $payment_status = '1'; // Payment success
            $amount_inr = $price*100; // Amount in INR

              // payment process
              echo "<script>
              alert('Payment is Initiated');
              </script>";
            // Insert payment details
            $payment_date = date('Y-m-d H:i:s');
            $payment_query = "INSERT INTO payments (member_id, amount, payment_date, payment_method, transaction_id,plan_id, payment_status, payment_type, user_id) 
                              VALUES ('$member_id', '$price', '$payment_date', 'Visa Card', '$txn_id','$planID' ,'$payment_status', 'membership', '$userID')";
            $payment_result = mysqli_query($con, $payment_query);

            if (!$payment_result) {
                echo "<script>alert('Payment insertion failed');</script>";
                exit();
            }

            $payment_id = mysqli_insert_id($con);

            // Verify payment status
            $pay_sql = "SELECT * FROM payments WHERE id = '$payment_id' AND payment_status = '1'";
            $pay_result = mysqli_query($con, $pay_sql);

            if (!$pay_result || mysqli_num_rows($pay_result) == 0) {
                echo "<script>alert('Payment status is invalid');</script>";
                exit();
            }

            // Calculate start and end dates
            $sdate = date('Y-m-d H:i:s'); // Start date
            $edate = date('Y-m-d', strtotime($sdate . " + $duration_date days")); // End date

            // Insert member plan
            $member_status = '1';
            $member_plan = "INSERT INTO member_plans (member_id, plan_id, start_date, end_date, status, payment_id) 
                            VALUES ('$member_id', '$planID', '$sdate', '$edate', '$member_status', '$payment_id')";
            $member_plan_result = mysqli_query($con, $member_plan);

            if (!$member_plan_result) {
                echo "<script>alert('Member plan insertion failed');</script>";
                exit();
            }
            $update_user_plan="update users set plan_status = '1',payment_status = '1' where member_id = '$member_id'";
            $update_user_plan_result = mysqli_query($con, $update_user_plan);

            // Redirect to member view page
            $_SESSION['member_id']=$member_id;
            $_SESSION['message'] = "Payment is successful! Welcome to our gym membership.";
            echo "<script>alert('Payment is successful! Welcome to our gym membership');
            window.location.href='my_membership.php';
            </script>";
            // header("Location: member-view.php");

            exit();
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
