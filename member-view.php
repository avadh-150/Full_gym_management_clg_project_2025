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
    header("Location: login.php");
    exit();
}

// Check for member_id before including header/nav
if(!isset($_GET['member_id']) || empty($_GET['member_id'])) {
    $_SESSION['message'] = "Invalid member ID provided";
echo "<script>

    window.location.href = 'my_membership.php';
</script>";
    exit();
}

$member_id = mysqli_real_escape_string($con, $_GET['member_id']);

// Fetch user details with prepared statement
$user_query = "SELECT * FROM users WHERE member_id = ?";
$stmt = mysqli_prepare($con, $user_query);
mysqli_stmt_bind_param($stmt, "s", $member_id);
mysqli_stmt_execute($stmt);
$user_result = mysqli_stmt_get_result($stmt);

if (!$user_result || mysqli_num_rows($user_result) == 0) {
    $_SESSION['message'] = "Member not found!";
    echo "<script>

    window.location.href = 'my_membership.php';
</script>";
    exit();
}

$user = mysqli_fetch_assoc($user_result);

// Fetch membership plan details
if ($user['current_plan_id']) {
    $plan_id = $user['current_plan_id'];
    
    // Use prepared statement for plan query
    $plan_query = "SELECT * FROM membership_plans WHERE id = ?";
    $stmt = mysqli_prepare($con, $plan_query);
    mysqli_stmt_bind_param($stmt, "i", $plan_id);
    mysqli_stmt_execute($stmt);
    $plan_result = mysqli_stmt_get_result($stmt);
    $plan = mysqli_fetch_assoc($plan_result);

    // Use prepared statement for payment query
    $pay_user = "SELECT p.member_id, p.amount as price, p.*, m.end_date as edate, 
                 m.start_date as sdate, m.status 
                 FROM payments p 
                 JOIN member_plans m ON p.plan_id = m.plan_id 
                 WHERE p.payment_type='membership' AND m.member_id = ?";
    
    $stmt = mysqli_prepare($con, $pay_user);
    mysqli_stmt_bind_param($stmt, "i", $member_id);
    mysqli_stmt_execute($stmt);
    $pay_result = mysqli_stmt_get_result($stmt);
    $pay_row = mysqli_fetch_assoc($pay_result);

    if (!$plan || !$pay_row) {
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

<div class="container">
    <ol class="breadcrumb">
        <li><a href="index.php">Home</a> / </li>
        <li><a href="my_membership.php">My Membership</a> / </li>
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
                    <h4>Member Details</h4>
                    <!-- <hr width="200px" color="#000" style="float:left;"> -->
                     <hr color="#000">
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Member id:</label>
                        <div class="border p-1"><?= htmlspecialchars($user['member_id']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Full Name:</label>
                        <div class="border p-1"><?= htmlspecialchars($user['full_name']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Email:</label>
                        <div class="border p-1"><?= htmlspecialchars($user['email']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Phone:</label>
                        <div class="border p-1"><?= htmlspecialchars($user['mobile']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Address:</label>
                        <div class="border p-1"><?= htmlspecialchars($user['address']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Occupation:</label>
                        <div class="border p-1"><?= htmlspecialchars($user['occupation']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Gender:</label>
                        <div class="border p-1"><?= ucfirst($user['gender']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Uploaded Image:</label>
                        <div class="border p-1">
                            <img src="<?= htmlspecialchars($user['image']); ?>" alt="User Image" width="50" style="border-radius: 10px;">
                        </div>
                    </div>
                </div>

                <!-- Right Side - Membership Plan Details -->
                <div class="col-md-4">
                    <h4>Membership Plan</h4>
                    <hr color="#000">
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Plan Name:</label>
                        <div class="border p-1"><?= htmlspecialchars($plan['plan_name']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Duration:</label>
                        <div class="border p-1"><?= $plan['duration']; ?> Days</div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Start Date:</label>
                        <div class="border p-1"><?= $pay_row['sdate']; ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Expiry Date:</label>
                        <div class="border p-1"><?= $pay_row['edate']; ?></div>
                    </div>
                    
                    <hr>
                    <h5>Total Amount: <span class="float-end fw-bold" style="float:right;">₹<?= number_format($plan['price'], 2); ?></span></h5>
                    <hr>
                    <label style="font-weight:bold;">Membership Status</label>
<div class="border p-1 mb-3">
    <?php 
        if ($pay_row['status'] == 0) {
            echo '<span class="badge bg-danger text-white" style="font-size:15px">Inactive</span>'; // Red for inactive
        } else if ($pay_row['status'] == 1) {
            echo '<span class="badge bg-success text-white" style="font-size:15px">Active</span>'; // Green for active
        } else if ($pay_row['status'] == 2) {
            echo '<span class="badge bg-secondary text-white" style="font-size:15px">Expired</span>'; // Gray for expired
        }
    ?>
</div>



                        <!-- <a href="confirm_payment.php?plan_id=" name="place_order" class="btn btn-primary">Proceed to Payment</a> -->
                    </div>   

                <div class="col-md-4">
                    <h4>Payment Details</h4>
                    <hr color="#000" >
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Member id:</label>
                        <div class="border p-1"><?= htmlspecialchars($pay_row['member_id']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Date</label>
                        <div class="border p-1"><?= $pay_row['payment_date']; ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Paid Amount</label>
                        <div class="border p-1">₹<?= number_format($pay_row['price'], 2); ?></div>
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
                    <label style="font-weight:bold;">Payment Status</label>
                    <div class="border p-1 mb-3">
    <?php 
        if ($pay_row['payment_status'] == 0) {
            echo '<span class="badge bg-danger text-white" style="font-size:15px">Pending ❌</span>'; // Red for inactive
        } else if ($pay_row['payment_status'] == 1) {
            echo '<span class="badge bg-success text-white" style="font-size:15px">Paid </span>'.'✅'; // Green for active
        }
        //  else if ($pay_row['payment_status'] == 2) {
        //     echo '<span class="badge bg-secondary text-white" style="font-size:15px">Expired</span>'; // Gray for expired
        // }
    ?>
</div>

                    <!-- <h5>Paid Amount: <span class="float-end fw-bold" style="float:right;">₹<?= number_format($plan['price'], 2); ?></span></h5> -->
                    <hr>


                        <!-- <a href="confirm_payment.php?plan_id=" name="place_order" class="btn btn-primary">Proceed to Payment</a> -->
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
<?php //} ?>











