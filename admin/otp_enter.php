<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 10px;
            font-size: 14px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>OTP Verification</h2>
        <form action="" method="POST">
            <input type="text" name="otp" placeholder="Enter OTP" required>
            <button type="submit" name="verify_otp">Verify OTP</button>
        </form>
    </div>
</body>
</html>
<?php
// Include database connection
require 'dbcon.php'; // Replace with your database connection file

if (isset($_POST['verify_otp'])) {
    $otp = $_POST['otp'];

    // Check if the OTP exists in the database
    $query = "SELECT * FROM admin WHERE OTP = '$otp'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // OTP is valid
        echo "<script>
        alert('OTP verified successfully. You can now reset your password.');
        window.location.href = 'reset_pass.php?otp=$otp'; // Redirect to password reset page
        </script>";
    } else {
        // OTP is invalid
        echo "<script>
        alert('Invalid OTP. Please try again.');
        window.location.href = 'otp_enter.php'; // Redirect back to OTP form
        </script>";
    }
} else {
    echo "Invalid request.";
}
?>
