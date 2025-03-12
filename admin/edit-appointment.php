<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

include "dbcon.php";

if (isset($_GET['app_id'])) {
    $app_id = $_GET['app_id'];

    // Updated query using JOIN for better readability
    $qry = "select a.*,a.id as app_id,a.status as astatus,a.email as aemail,t.name as tname,t.email as temail,t.*,t.id as tid from appointments a,trainers t where a.trainer_id=t.id and a.id=$app_id and t.status='active'";;

    $result = mysqli_query($con, $qry);
    if ($result) {
        $app = mysqli_fetch_assoc($result);
    } else {
        die("Query Error: " . mysqli_error($con));
    }
    $pay="select * from payments where appointment_id=$app_id";
    $pay_result= mysqli_query($con, $pay);
    if ($pay_result) {
        $pay_row = mysqli_fetch_assoc($pay_result);
    } else {
        die("Error from query". mysqli_error($con));
}}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Appointment Details</title>
    <?php include "includes/header.php"; ?>

    <style>
        /* Layout for profile details */
        .member-profile-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .left-column {
            width: 48%;
            margin-left: 20px;
            margin-top: 20px;
        }

        .right-column {
            width: 48%;
            margin-right: 300px;
            margin-top: 20px;
        }

        .img-thumbnail {
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

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .btn,
            .sidebar,
            .header,
            .footer {
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
    <?php $page = "members";
    include 'includes/sidebar.php' ?>

    <!-- Main Content -->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="#" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="appointments.php" class="current">Appointments</a>
                <a href="#" class="current">client's Appointment <i class="fa-solid fa-calendar-check"></i></a>
            </div>
            <!-- <h1 class="text-center">Member's Profile</h1> -->
        </div>

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class='widget-box print-area'>
                        <div class='widget-title'>
                            <span class='icon'> <i class='fas fa-th'></i> </span>
                            <h5>Appointments Details</h5>

                        </div>

                        <div class='widget-content nopadding'>
                            <div class="card-body">
                                <div class="member-profile-container">
                                    <!-- Left Column -->
                                    <div class="left-column">
                                        <h4><strong>Client Details:</strong></h4>
                                        <br>
                                        <p><strong>Client Full Name:</strong> <?php echo $app['fullname']; ?></p>
                                        <p><strong>Booking At:</strong> <?php echo $app['created_at']; ?></p>
                                        <p><strong>Client Email:</strong> <?php echo $app['aemail']; ?></p>
                                        <p><strong>Contact Number:</strong> <?php echo $app['contact']; ?></p>
                                        <p><strong>Client Age:</strong> <?php echo $app['Age']; ?></p>
                                        <p><strong>Fitness Level:</strong> <?php echo $app['fitness_level']; ?></p>
                                        <p><strong>Type of Service:</strong> <?php echo $app['service_type']; ?></p>
                                    </div>
                                    <div class="left-column">
                                        <h4><strong>Trainer Details:</strong></h4>
                                        <br>
                                        <p><strong>Trainer ID:</strong> <?php echo $app['tid']; ?></p>
                                        <p><strong>Name:</strong> <?php echo $app['tname']; ?></p>
                                        <p><strong>Email:</strong> <?php echo $app['temail']; ?></p>
                                        <p><strong>Specialization:</strong> <?php echo $app['specialization']; ?></p>
                                        <p><strong>Join Date:</strong> <?php echo $app['joining_date']; ?></p>
                                        <p><strong>Fitness Level:</strong> <?php echo $app['fitness_level']; ?></p>
                                        <p><strong>Type of Service:</strong> <?php echo $app['service_type']; ?></p>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="right-column" style="float: right; margin:20px -2px 0 0;">
                                        <h4><strong>Appointments Details:</strong></h4>
                                        <br>
                                        <p><strong>Appointment ID:</strong> <?php echo $app['app_id']; ?></p>
                                        <p><strong>Appointment Date:</strong> <?php echo $app['appointment_date']; ?></p>


                                        <p><strong>Appointment Time:</strong> <?php echo $app['appointment_time']; ?></p>
                                        
                                        
                                        <p><strong>Appointment Status:</strong> <?php
                                                                                if ($app['astatus'] == "scheduled") {
                                                                                    // echo '<label class="bg bg-danger" style="color:#fff; padding:5px 10px; border-radius:3px;">scheduled</label>';
                                                                                    echo '<label style=" background:yellow;color:#000; padding:5px 10px; border-radius:3px;width:70px">scheduled</label>';
                                                                                } else if ($app['astatus'] == 'completed') {
                                                                                    echo '<label class="bg bg-success" style="background:green;color:#000; padding:5px 10px; width:70px; border-radius:3px;">completed</label>';
                                                                                } else if ($app['astatus'] == 'cancelled') {
                                                                                    echo '<label class="bg bg-danger" style="background:red;color:#000; padding:5px 10px; width:70px; border-radius:3px;">cancelled</label>';
                                                                                }
                                                                                ?></p>
                                        <p><strong>Payment Mode:</strong> <?php echo $app['payment_method'] =='pay_at_gym' ?'Cash Manual':'Online' ?></p>
                                        <!-- <p><strong>Payment Status:</strong> <?php if ($app['payment_status'] == "0") {
                                                                                        echo '<label style=" background:yellow;color:red; padding:5px 10px; border-radius:3px;width:40px">Unpaid</label>';
                                                                                    } else if ($app['payment_status'] == '1') {
                                                                                        echo '<label class="bg bg-success" style="background:green;color:#000; padding:5px 10px; width:70px; border-radius:3px;">Paid</label>';
                                                                                    }
                                                                                    ?></p> -->

                                        <!-- <p><strong>Transaction ID:</strong> <?php echo isset($pay_row['transaction_id']) ? $pay_row['transaction_id'] : "N/A" ?></p>
                                        <p><strong>Payment At:</strong> <?php echo isset($pay_row['payment_date']) ? $pay_row['payment_date'] : "N/A" ?></p>
                                        <p><strong>Payment Status:</strong>
                                            <span class="<?php echo ($app['payment_status'] == '1') ? 'status-active' : 'status-inactive'; ?>">
                                                <?php echo ($app['payment_status'] == '1') ? 'Paid' : 'Unpaid'; ?>
                                            </span>
                                        </p> -->
                                        <p><strong>Amount: </strong> <?php echo isset($pay_row['amount']) ? $pay_row['amount'] : 'N/A'; ?></p>

                                    </div>
                                    
                                    <!-- Payment Section -->
                                    <div class="right-column1" style="float: right; margin: 20px;">
                                        <h4><strong>Payment Details:</strong></h4>
                                        <br>
                                        <p><strong>Transaction ID:</strong> <?php echo isset($pay_row['transaction_id']) ? $pay_row['transaction_id'] : "N/A" ?></p>

                                                                               <p><strong>Payment Method:</strong><?php echo isset($pay_row['payment_method']) ? $pay_row['payment_method'] : 'N/A' ?></p>
                                        <!-- <p><strong>Payment Status:</strong> <?php if ($pay_row['payment_status'] == "0") {
                                                                                        echo '<label style=" background:yellow;color:red; padding:5px 10px; border-radius:3px;width:40px">Unpaid</label>';
                                                                                    } else if ($pay_row['payment_status'] == '1') {
                                                                                        echo '<label class="bg bg-success" style="background:green;color:#000; padding:5px 10px; width:70px; border-radius:3px;">Paid</label>';
                                                                                    }
                                                                                    ?></p> -->

                                        <p><strong>Payment At:</strong> <?php echo isset($pay_row['payment_date']) ? $pay_row['payment_date'] : "N/A" ?></p>
                                        <p><strong>Payment Status:</strong>
                                            <span class="<?php echo ($app['payment_status'] == '1') ? 'status-active' : 'status-inactive'; ?>">
                                                <?php echo ($app['payment_status'] == '1') ? 'Paid' : 'Unpaid'; ?>
                                            </span>
                                        </p>
                                    </div>
                                    
                                </div>


                                <!-- Photo Section -->
                                <!-- <div class="photo-section text-center">
                                <?php
                                if (!empty($app['images'])) {
                                    $photoPath = $app['images'];
                                    echo '<img src="uploads/profiles/' . $photoPath . '" class="img-thumbnail" alt="Member Photo">';
                                } else {
                                    echo '<p>No photo available</p>';
                                }
                                ?>
                            </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Print Button -->
                    <div class="text-center">
                        <button onclick="window.print();" class="btn btn-info"><i class="fa-solid fa-print"></i> Print Member Info.</button>
                        <!-- <a href="" class="btn btn-info"><i class="fas fa-id-card"></i> Print Membership Card</a> -->
                        <a href="edit-status.php?id=<?php echo $app['app_id']; ?>&&appointment_status=<?php echo $app['astatus'] ?>&&payment_status=<?php echo $app['payment_status'] ?>" target="_blank" class="print-button"><button class="btn btn-info"> Update</button></a>

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