<?php
session_start();
error_reporting(0);
$con = mysqli_connect("localhost", "root", "", "gymnsb");

// Check if user is logged in
if (!isset($_SESSION['auth_user'])) {
    header("Location: http://localhost/gymphp/login.php");
    exit();
}

// Fetch user data from database
$user_id = $_SESSION['auth_user']['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $con->query($sql);
$user = $result->fetch_assoc();

$member_id = $user['member_id'];
$membership_query = "SELECT mp.*, p.plan_name as plan_name FROM member_plans mp 
                    JOIN membership_plans p ON mp.plan_id = p.id 
                    WHERE mp.member_id = '$member_id'";
$membership_result = $con->query($membership_query);
$membership = $membership_result->fetch_assoc();

// Calculate days remaining
$end_date = new DateTime($membership['end_date']);
$current_date = new DateTime();
$days_remaining = $current_date->diff($end_date)->days;
$is_expired = $current_date > $end_date;
?>

<!doctype html>
<html lang="en">

<head>
    <title>FITNESS CLUB - Membership Card</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
        .membership-card-container {
            max-width: 800px;
            margin: 4rem auto;
            padding: 0 15px;
        }

        .membership-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .card-header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .gym-logo {
            width: 80px;
            height: auto;
        }

        .card-title {
            font-size: 1.5rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-align: right;
        }

        .card-body {
            padding: 30px;
            display: flex;
            background-color: #f8f9fa;
        }

        .member-info {
            flex: 2;
        }

        .member-picture {
            flex: 1;
            text-align: right;
        }

        .member-id {
            font-size: 1.2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            font-family: monospace;
        }

        .member-name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            text-transform: uppercase;
        }

        .member-detail {
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: #555;
        }

        .membership-type {
            font-weight: bold;
            font-size: 1.3rem;
            margin: 10px 0;
            color: #3498db;
            text-transform: uppercase;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .card-footer {
            padding: 15px 30px;
            background-color: #e9ecef;
            color: #2c3e50;
            text-align: center;
            font-weight: bold;
            border-top: 1px solid #dee2e6;
        }

        .qr-code {
            position: absolute;
            bottom: 20px;
            right: 30px;
            width: 80px;
            height: 80px;
        }

        .validity {
            color: <?php echo $is_expired ? '#dc3545' : '#28a745'; ?>;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
            background-color: <?php echo $membership['status'] == '1' ? '#28a745' : '#dc3545'; ?>;
            color: white;
            margin-left: 10px;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-action {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-print {
            background-color: #3498db;
            color: white;
        }

        .btn-renew {
            background-color: #28a745;
            color: white;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            color: white;
        }

        @media (max-width: 768px) {
            .card-body {
                flex-direction: column;
            }

            .member-picture {
                text-align: center;
                margin-bottom: 20px;
                order: -1;
            }
        }
    </style>
</head>

<body>
    <?php include "../include/nav.php" ?>
    <br>
    <br>
    <br>

    <div class="membership-card-container">
        <h2 class="text-center mb-4">Your Membership Card</h2>

        <?php if(isset($membership) && $membership): ?>
        <div class="membership-card">
            <div class="card-header">
                <!-- <p alt="Gym Logo" class="gym-logo"> Fitness Club.org</p> -->
                 <img src="../img/Gym-Logo.png" alt="Gym Logo" class="gym-logo">
                <div class="card-title">MEMBERSHIP CARD</div>
            </div>

            <div class="card-body">
                <div class="member-info">
                    <div class="member-id">#<?php echo htmlspecialchars($user['member_id']); ?></div>
                    <div class="member-name"><?php echo htmlspecialchars($user['full_name'] ?? $user['name']); ?></div>
                    <div class="member-detail"><?php echo htmlspecialchars($user['address']); ?></div>
                    <div class="member-detail">Phone: <?php echo htmlspecialchars($user['mobile']); ?></div>
                    <div class="member-detail">Email: <?php echo htmlspecialchars($user['email']); ?></div>
                    <div class="membership-type">
                        <?php echo htmlspecialchars($membership['plan_name']); ?>
                        <span class="status-badge">
                            <?php echo $membership['status'] == '1' ? 'ACTIVE' : 'INACTIVE'; ?>
                        </span>
                    </div>
                </div>

                <div class="member-picture">
                    <img src="../<?php echo $user['image'] ? $user['image'] : 'images/default-profile.png'; ?>" 
                         alt="Member Photo" class="profile-img">
                </div>
            </div>

            <div class="card-footer">
                <div class="validity">
                    VALID FROM: <?php echo date('F d, Y', strtotime($membership['start_date'])); ?> TO 
                    <?php echo date('F d, Y', strtotime($membership['end_date'])); ?>
                    <?php if($is_expired): ?>
                        <span class="badge bg-danger">EXPIRED</span>
                    <?php else: ?>
                        (<?php echo $days_remaining; ?> days remaining)
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="profile.php" class="btn-action btn-back"><i class="fas fa-arrow-left"></i> Back to Profile</a>
            <a href="javascript:window.print();" class="btn-action btn-print"><i class="fas fa-print"></i> Print Card</a>
            <?php if($is_expired || $days_remaining < 10): ?>
            <a href="renew.php" class="btn-action btn-renew"><i class="fas fa-sync-alt"></i> Renew Membership</a>
            <?php endif; ?>
        </div>

        <?php else: ?>
        <div class="alert alert-warning text-center">
            <h4><i class="fa fa-exclamation-triangle"></i> No active membership found</h4>
            <p>You don't have an active membership plan. Please purchase a membership plan to continue.</p>
            <a href="plans.php" class="btn btn-primary mt-3">View Membership Plans</a>
        </div>
        <?php endif; ?>
    </div>

    <?php include "../include/footer.php" ?>

    <!-- loader -->
    <!-- <div id="loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214" />
        </svg>
    </div> -->

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/magnific-popup-options.js"></script>
    <script src="../js/main.js"></script>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        <?php if (isset($_SESSION['message'])): ?>
            alertify.success('<?= $_SESSION['message'] ?>');
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        
        // Print styles
        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');
            mediaQueryList.addListener(function(mql) {
                if (mql.matches) {
                    document.querySelector('.action-buttons').style.display = 'none';
                    document.querySelector('nav').style.display = 'none';
                    document.querySelector('footer').style.display = 'none';
                } else {
                    document.querySelector('.action-buttons').style.display = 'flex';
                    document.querySelector('nav').style.display = 'block';
                    document.querySelector('footer').style.display = 'block';
                }
            });
        }
    </script>
</body>
</html>