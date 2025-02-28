<?php
session_start();
include 'config.php';

$msg = ''; // Initialize the message variable

if (isset($_GET['token'])) {
    // Sanitize the token
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Debugging: Print the token
    // echo "Token: " . $token;

    // Check if the token exists in the database
    $sql = "SELECT * FROM users WHERE code='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Check if the account is already verified
            if ($row['code_status'] == "0") {
                // Update the verification status
                $update_query = "UPDATE users SET code_status='1' WHERE code='$token' LIMIT 1";
                if (mysqli_query($conn, $update_query)) {
                    $_SESSION['alert'] = "<h3>Your account has been verified successfully!</h3>";
                    // Redirect to the login page
                    header("location:http://localhost/gymphp/login.php");
                    exit();
                } else {
                    $msg = "<h3>Something went wrong. Please try again later.</h3>";
                }
            } else {
                $msg = "<h3>Your email is already verified. Please log in.</h3>";
            }   
        } else {
            $msg = "<h3>The token does not exist or is invalid.</h3>";
        }
    } else {
        $msg = "<h3>Database query error: " . mysqli_error($conn) . "</h3>";
    }
} else {
    $msg = "<h3>No token found. Verification failed.</h3>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            margin: 100px auto;
            width: 50%;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h3 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php echo $msg; // Display the message ?>
    </div>
</body>
</html>
