<?php
session_start();
error_reporting(0);
include "include/header.php";
include "connection.php";

// Ensure user is logged in
if (!isset($_SESSION['auth_user'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['auth_user']['email'];

// Fetch user details
$user_query = "SELECT * FROM users WHERE email = '$email'";
$user_result = mysqli_query($con, $user_query);
$user = mysqli_fetch_assoc($user_result);

// Fetch membership plan details
if ($user && $user['current_plan_id']) {
    $plan_id = $user['current_plan_id'];
    $plan_query = "SELECT * FROM membership_plans WHERE id = '$plan_id'";
    $plan_result = mysqli_query($con, $plan_query);
    $plan = mysqli_fetch_assoc($plan_result);
} else {
    $_SESSION['message'] = "No active membership found!";
    header("Location: plan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Details</title>
    <link rel="stylesheet" href="css/plan.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
        }
        .container {
            max-width: 900px;
            margin: 50px auto;
        }
        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .card-header {
            font-size: 18px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .detail-row {
            margin-bottom: 15px;
            font-size: 1rem;
        }
        .border-box {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
        }
        .confirm-btn {
            display: block;
            width: 100%;
            padding: 10px;
            text-align: center;
            background: #28a745;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: 0.3s;
        }
        .confirm-btn:hover {
            background: #218838;
        }
        .paid-status {
            color: green;
            font-weight: bold;
        }
        .pending-status {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php include "include/nav.php"; ?>

<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a> / </li>
        <li><a href="my_membership.php">My Membership</a> / </li>
        <li class="active">View Details</li>
    </ol>

    <div class="card">
        <div class="card-header">
            Membership Details
            <a href="my_membership.php" class="btn btn-info"><i class="fa fa-reply"></i> Back</a>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Side - User Details -->
                <div class="col-md-6">
                    <h4>User Details</h4>
                    <hr>
                    <div class="detail-row">
                        <label class="fw-bold">Full Name:</label>
                        <div class="border-box"><?= htmlspecialchars($user['full_name']); ?></div>
                    </div>
                    <div class="detail-row">
                        <label class="fw-bold">Email:</label>
                        <div class="border-box"><?= htmlspecialchars($user['email']); ?></div>
                    </div>
                    <div class="detail-row">
                        <label class="fw-bold">Phone:</label>
                        <div class="border-box"><?= htmlspecialchars($user['mobile']); ?></div>
                    </div>
                    <div class="detail-row">
                        <label class="fw-bold">Address:</label>
                        <div class="border-box"><?= htmlspecialchars($user['address']); ?></div>
                    </div>
                    <div class="detail-row">
                        <label class="fw-bold">Occupation:</label>
                        <div class="border-box"><?= htmlspecialchars($user['occupation']); ?></div>
                    </div>
                    <div class="detail-row">
                        <label class="fw-bold">Gender:</label>
                        <div class="border-box"><?= ucfirst($user['gender']); ?></div>
                    </div>
                </div>

                <!-- Right Side - Membership Plan Details -->
                <div class="col-md-6">
                    <h4>Membership Plan</h4>
                    <hr>
                    <div class="detail-row">
                        <label class="fw-bold">Plan Name:</label>
                        <div class="border-box"><?= htmlspecialchars($plan['plan_name']); ?></div>
                    </div>
                    <div class="detail-row">
                        <label class="fw-bold">Duration:</label>
                        <div class="border-box"><?= $plan['duration']; ?> Days</div>
                    </div>
                    <div class="detail-row">
                        <label class="fw-bold">Price:</label>
                        <div class="border-box">₹<?= number_format($plan['price'], 2); ?></div>
                    </div>
                    <div class="detail-row">
                        <label class="fw-bold">Uploaded Image:</label>
                        <div class="border-box">
                            <img src="<?= htmlspecialchars($user['image']); ?>" alt="User Image" width="100" style="border-radius: 10px;">
                        </div>
                    </div>
                    <hr>
                    <h5>Total Amount: <span class="float-end fw-bold" style="float:right;">₹<?= number_format($plan['price'], 2); ?></span></h5>
                    <hr>
                    <label class="fw-bold">Payment Status:</label>
                    <div class="border-box <?= $user['payment_status'] == 'Paid' ? 'paid-status' : 'pending-status'; ?>">
                        <?= $user['payment_status']; ?>
                    </div>
                    <?php if ($user['payment_status'] == 'Pending') : ?>
                        <a href="confirm_payment.php?plan_id=<?= $plan['id']; ?>" class="confirm-btn">Confirm Payment</a>
                    <?php else: ?>
                        <p style="text-align: center; font-weight: bold; color: green;">Payment Completed ✅</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "include/footer.php"; ?>

</body>
</html>
