<?php
include "include/header.php";
require_once 'configuration.php';


?>

    <!-- <link rel="stylesheet" href="css/plan.css"> -->
    <?php include "include/nav.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
         .checkout-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .checkout-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        
        .cart-item {
            padding: 1rem;
            border: 1px solid #eee;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
            border: none;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
            border: none;
        }
        
        .total-amount {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 1rem 0;
            padding: 1rem 0;
            border-top: 2px solid #eee;
        }
    </style>
<body>

 <!-- Navigation -->
<?php
// session_start();
error_reporting(0);
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
<br>
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
                <div class="col-md-6">
                    <h4>Member Details</h4>
                    <hr>
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
                <div class="col-md-6">
                    <h4>Membership Plan</h4>
                    <hr>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Plan Name:</label>
                        <div class="border p-1"><?= htmlspecialchars($plan['plan_name']); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Duration:</label>
                        <div class="border p-1"><?= $plan['duration']; ?> Days</div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">Price:</label>
                        <div class="border p-1">₹<?= number_format($plan['price'], 2); ?></div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="fw-bold">features:</label>
                        <div class="border p-1"><?= $plan['features']; ?></div>
                    </div>
                    
                    <hr>
                    <h5>Total Amount: <span class="float-end fw-bold" style="float:right;">₹<?= number_format($plan['price'], 2); ?></span></h5>
                    <hr>
                    
                        <!-- <a href="confirm_payment.php?plan_id=" name="place_order" class="btn btn-primary">Proceed to Payment</a> -->
                        <div class="checkout-actions">
                            <form action="member_payment.php" method="post" id="checkout-form">
                                <input type="hidden" name="pid" id="" value="<?= $plan['id']; ?>">
                                <input type="hidden" name="uid" id="" value="<?= $user['id']; ?>">
                                

                                <!-- <a href="cart.php" class="btn btn-secondary">Back to Cart</a> -->
                                <button type="submit" name="place_order" class="btn btn-primary">
                                    Proceed to Payment
                                    <div id="stripe-container" style="display: none; width: 100%;">
                                <script src="https://checkout.stripe.com/checkout.js" 
                                        class="stripe-button"
                                        data-key="<?= htmlspecialchars($Publishable_key) ?>"
                                        data-amount="<?= $plan['price']*100 ?>"
                                        data-name="Fitness Club"
                                        data-description="Continue the payment for Membership"
                                        data-currency="inr"
                                        data-email="<?= $user['email']; ?>">
                                </script>
                            </div>

                                </button>
                                <?php if(!$plan['id']=="1"){?>
                                <a href="member_payment.php?pid=<?= $plan['id']; ?>&uid=<?= $user['id']; ?>" class="btn btn-info" style="float:right;">Cash Payment</a>
                                <br>
                                <br>
                                <?php }?>
                                <p style="float:right;" class="text-danger">*Cash Payment is 
                                    <br>available only in our office</p>
                            </div>
                            
                            <!-- Stripe Integration -->
                           
                        </form>
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
