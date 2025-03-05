<?php
session_start();
// Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        header('location:../index.php');
        exit();
    }

include "dbcon.php";

if (isset($_GET['id'])) {
    $memberId = $_GET['id'];

    // Updated query using JOIN for better readability
    $qry = "SELECT s.image as images,s.*, m.*, p.plan_name,p.*,pay.*
            FROM users s
            JOIN member_plans m ON s.member_id = m.member_id
            JOIN payments pay ON pay.id=m.payment_id
            JOIN membership_plans p ON s.current_plan_id = p.id
            WHERE s.role = 'member_user' 
            AND s.member_id = '$memberId'";

    $result = mysqli_query($con, $qry);
    if ($result) {
        $memberDetails = mysqli_fetch_assoc($result);
    } else {
        die("Query Error: " . mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Member Profile</title>
    <?php include "includes/header.php"; ?>
    
    <style>
        /* Layout for profile details */
        .member-profile-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }
        .left-column{
            width: 48%;
            margin-left: 20px;
            margin-top: 20px;
        }
        .right-column {
            width: 48%;
            margin-right: 300px;
            margin-top: 20px;
        }
        .img-thumbnail{
            float: right;
            margin-top: -200px;
            margin-right: 180px;
            border: 1px solid black;
            width: 150px;
            height: 150px;
        }
        .status-active {
    color: #27ae60;
    font-weight: 600;
}
.status-inactive {
    color: #e74c3c;
    font-weight: 600;
}
        /* Printing styles */
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .btn, .sidebar, .header, .footer {
                display: none !important;
            }
        }
    </style>
</head>
<body>

<!-- Header -->
<div id="header">
    <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
</div>
<?php include 'includes/topheader.php' ?>
<?php $page = "members"; include 'includes/sidebar.php' ?>

<!-- Main Content -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="#" class="tip-bottom"><i class="fas fa-home"></i> Home</a> 
            <a href="members.php" class="current">Registered Members</a>  
            <a href="#" class="current">Member's Profile</a>
        </div>
        <h1 class="text-center">Member's Profile <i class="fa-solid fa-user"></i></h1>
    </div>
    
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class='widget-box print-area'>
                    <div class='widget-title'>
                        <span class='icon'> <i class='fas fa-th'></i> </span>
                        <h5>Member Profile</h5>
                        
                    </div>

                    <div class='widget-content nopadding'>
                        <div class="card-body">
                            <div class="member-profile-container">
                                <!-- Left Column -->
                                <div class="left-column">
                                    <p><strong>Membership Number:</strong> <?php echo $memberDetails['member_id']; ?></p>
                                    <p><strong>Full Name:</strong> <?php echo $memberDetails['full_name']; ?></p>
                                    <p><strong>Date of Birth:</strong> <?php echo $memberDetails['join_date']; ?></p>
                                    <p><strong>Gender:</strong> <?php echo $memberDetails['gender']; ?></p>
                                    <p><strong>Contact Number:</strong> <?php echo $memberDetails['mobile']; ?></p>
                                    <p><strong>Email:</strong> <?php echo $memberDetails['email']; ?></p>
                                    <p><strong>Occupation:</strong> <?php echo $memberDetails['occupation']; ?></p>
                                    <p><strong>Address:</strong> <?php echo $memberDetails['address']; ?></p>
                                </div>

                                <!-- Right Column -->
                                <div class="right-column">
                                    <?php if($memberDetails['trainer_id']){?>
                                    <p><strong>Assign Trainer ID:</strong> <?php echo $memberDetails['trainer_id']; ?></p>
                                    <?php }else{?>
                                    <p><strong>Assign Trainer ID:</strong> N/A</p>
                                    <?php }?>
                                    <p><strong>Membership Type:</strong> <?php echo $memberDetails['plan_name']; ?></p>
                                    <p><strong>Amount:</strong> <?php echo $memberDetails['price'] ?></p>
                                    <p><strong>Membership Status:</strong> 
    <span class="<?php echo ($memberDetails['status'] == '1') ? 'status-active' : 'status-inactive'; ?>">
        <?php echo ($memberDetails['status'] == '1') ? 'Active' : 'Inactive'; ?>
    </span>
</p>
                                
                                </p>
                                    <p><strong>Start Date:</strong> <?php echo isset($memberDetails['start_date']) ? $memberDetails['start_date'] : "N/A"; ?></p>
                                    <p><strong>Expire At:</strong> <?php echo isset($memberDetails['end_date'])? $memberDetails['end_date'] : "N/A"; ?></p>
                                    <p><strong>Transaction ID:</strong> <?php echo $memberDetails['transaction_id'] ?></p>
                                    <p><strong>Payment At:</strong> <?php echo $memberDetails['payment_date'] ?></p>
                                    <p><strong>Payment Status:</strong> 
    <span class="<?php echo ($memberDetails['payment_status'] == '1') ? 'status-active' : 'status-inactive'; ?>">
        <?php echo ($memberDetails['payment_status'] == '1') ? 'Paid' : 'Unpaid'; ?>
    </span>
</p>
                                </div>
                            </div>

                            <!-- Photo Section -->
                            <div class="photo-section text-center">
                                <?php
                                if (!empty($memberDetails['images'])) {
                                    $photoPath =$memberDetails['images'];
                                    echo '<img src="../' . $photoPath . '" class="img-thumbnail" alt="Member Photo">';
                                } else {
                                    echo '<p>No photo available</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Print Button -->
                <div class="text-center">
                    <button onclick="window.print();" class="btn btn-info"><i class="fa-solid fa-print"></i> Print Member Info.</button>
                    <!-- <a href="" class="btn btn-info"><i class="fas fa-id-card"></i> Print Membership Card</a> -->
                    <a href="print_card.php?id=<?php echo $memberId; ?>" target="_blank" class="print-button"><button class="btn btn-info"><i class="fas fa-id-card"></i> Membership Card</button></a>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="row-fluid">
    <div id="footer" class="span12"> 
        <?php echo date("Y"); ?> &copy; Developed By GYM FITNESS CLUB CENTER
    </div>
</div>

<!-- Scripts -->
<script src="../js/jquery.min.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script>
    function printMembershipCard() {
        window.print();
    }
</script>

</body>
</html>
