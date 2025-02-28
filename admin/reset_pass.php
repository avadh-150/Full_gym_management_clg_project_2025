<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            width: 350px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type="password"] {
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
            width: 100%;
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
        <h2>Reset Your Password</h2>
        <form action="" method="POST">
            <input type="password" name="new_password" placeholder="Enter New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
            <button type="submit" name="reset_password">Reset Password</button>
        </form>
    </div>
</body>
</html>
<?php
// Include database connection
require 'dbcon.php'; // Replace with your database connection file

if (isset($_POST['reset_password'])) {
   $otp= $_GET['otp'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords
    if ($new_password === $confirm_password) {
        // Hash the new password for security
        $hashed_password = md5( $new_password);

        // Update the password in the database
    //     session_start();
    // echo $_SESSION['EMAIL'];
        $query = "UPDATE admin SET password = '$hashed_password' WHERE OTP='$otp'"; // Clear OTP after resetting
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>
            alert('Password reset successfully. You can now log in.');
            window.location.href = 'login.php'; // Redirect to login page
            </script>";
        } else {
            echo "<script>
            alert('Failed to reset password. Please try again.');
            window.location.href = 'reset_pass.php'; // Redirect back to reset password page
            </script>";
        }
    } else {
        echo "<script>
        alert('Passwords do not match. Please try again.');
        window.location.href = 'reset_pass.php'; // Redirect back to reset password page
        </script>";
    }
} else {
    echo "Invalid request.";
}
?>
