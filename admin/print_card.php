<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:../index.php');
    exit();
}

include "dbcon.php";

if (isset($_GET['id'])) {
    $memberId = mysqli_real_escape_string($con, $_GET['id']); // Prevent SQL injection

    // Query to fetch member details
    $qry = "SELECT s.image AS images, s.*, m.*, p.plan_name, p.*, pay.*
            FROM users s
            JOIN member_plans m ON s.member_id = m.member_id
            JOIN payments pay ON pay.id = m.payment_id
            JOIN membership_plans p ON s.current_plan_id = p.id
            WHERE s.role = 'member_user' 
            AND s.member_id = '$memberId'";

    $result = mysqli_query($con, $qry);

    // Check if member exists
    if (!$result || mysqli_num_rows($result) === 0) {
        die("Member not found.");
    }

    $memberDetails = mysqli_fetch_assoc($result);
} else {
    die("No Member ID provided.");
}

// Calculate days remaining and status
$end_date = new DateTime($memberDetails['end_date']);
$current_date = new DateTime();
$days_remaining = $current_date->diff($end_date)->days;
$is_expired = $current_date > $end_date;
$status = ($memberDetails['status'] == '1' && !$is_expired) ? 'Active' : 'Inactive';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Membership Card - <?php echo htmlspecialchars($memberDetails['full_name']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        
        .card-container {
            width: 600px;
            height: 350px;
            perspective: 1000px;
            position: relative;
        }
        
        .membership-card {
            width: 100%;
            height: 100%;
            position: relative;
            background: linear-gradient(135deg, #f0e6f5 0%, #d9d9e6 100%);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        
        .card-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            width: 100px;
            height: auto;
        }
        
        .card-title {
            color: #666;
            font-size: 18px;
            font-weight: 500;
            text-align: right;
        }
        
        .membership-title {
            padding: 0 20px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #333;
            font-size: 18px;
        }
        
        .member-id {
            padding: 10px 20px;
            font-family: monospace;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        
        .member-info {
            display: flex;
            padding: 0 20px;
        }
        
        .member-details {
            flex: 7;
        }
        
        .member-name {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        
        .member-address {
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
        }
        
        .membership-type {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            display: flex;
            align-items: center;
            margin-top: -4px;
            gap: 10px;
        }
        
        .membership-type span.plan-name {
            color: #000;
            font-weight: bold;
        }
        
        .member-photo {
            flex: 3;
            text-align: right;
        }
        
        .photo {
            width: 120px;
            height: 120px;
            margin-top: -20px;
            border-radius: 5px;
            border: 2px solid #fff;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            object-fit: cover;
        }
        
        .card-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #001f3f;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            height: 30px;
        }
        
        .print-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 8px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .print-button:hover {
            background-color: #0056b3;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .status-active {
            background-color: #28a745;
        }

        .status-inactive {
            background-color: #dc3545;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
                /* Ensures colors are printed correctly */
                print-color-adjust: exact;
            }

            body,
            html {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
            }

            .card-container {
                width: 100%;
                height: 100vh;
                /* Full viewport height */
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .membership-card {
                width: 100%;
                height: 350px;
                border: none;
                box-shadow: none;
            }

            .print-button {
                display: none;
            }
        }
        </style>
</head>
<body>
    <div class="card-container">
        <div class="membership-card">
            <div class="card-header">
                <div class="logo">
                    <img src="../img/Gym-Logo.png" alt="Gym Logo" width="100px" height="70px">
                </div>
                <div class="card-title">MEMBERSHIP CARD</div>
            </div>
            
            <div class="membership-title">PERFECT GYM FITNESS CLUB</div>
            
            <div class="member-id">#<?php echo htmlspecialchars($memberDetails['member_id']); ?></div>
            
            <div class="member-info">
                <div class="member-details">
                    <div class="member-name"><?php echo htmlspecialchars($memberDetails['full_name']); ?></div>
                    <div class="member-address"><?php echo htmlspecialchars($memberDetails['address']); ?></div>
                    <div class="membership-type">
                        <span class="plan-name"><?php echo htmlspecialchars($memberDetails['plan_name']); ?></span>
                        <span class="status-badge <?php echo $status === 'Active' ? 'status-active' : 'status-inactive'; ?>">
                            <?php echo $status; ?>
                        </span>
                    </div>
                </div>
                <div class="member-photo">
                    <?php
                    if (!empty($memberDetails['images'])) {
                        echo '<img src="../' . htmlspecialchars($memberDetails['images']) . '" class="photo" alt="Member Photo">';
                    } else {
                        echo '<img src="/api/placeholder/120/120" class="photo" alt="Default Photo">';
                    }
                    ?>
                </div>
            </div>
            
            <div class="card-footer">
                VALID FROM: <?php echo date('F d, Y', strtotime($memberDetails['start_date'])); ?> TO 
                <?php echo date('F d, Y', strtotime($memberDetails['end_date'])); ?>
                <span class="status-badge <?php echo $is_expired ? 'status-inactive' : 'status-active'; ?>">
                    <?php echo $is_expired ? 'EXPIRED' : "$days_remaining DAYS LEFT"; ?>
                </span>
            </div>
        </div>
        <button class="print-button" onclick="printCard()">Print Card</button>
    </div>

    <script>
        function printCard() {
            window.print();
        }
    </script>
</body>
</html>