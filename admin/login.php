<?php 
session_start();
if(isset($_SESSION['user_id']))
{
    header('location:http://localhost/gymphp/admin/index.php');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin Login</title>
    <style>
        /* admin-styles.css */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .admin-login-container {
            background-color: #ffffff;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .admin-login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
            color: #333;
            font-size: 24px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
            font-weight: 500;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-group input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        .input-group button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .input-group button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .admin-login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            transform: rotate(45deg);
            z-index: -1;
            animation: rotateBackground 10s linear infinite;
        }

        @keyframes rotateBackground {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>

    <div class="admin-login-container">
        <div class="admin-login-form">
            <h2>Admin Login</h2>
            <form action="login.php" method="post">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="user" placeholder="Enter Email" name="EMail" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="pass" placeholder="Enter Password" name="Password" required>
                </div>
                <div class="input-group">
                    <button type="submit" name="login">Login</button>
                </div>
                
                <div class="forgot-password">
                    <a href="forgot-password.php">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="js/login.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
include "dbcon.php";

if(isset($_REQUEST['login']))
{
    $uname = $_POST['EMail'];
    $pass = md5($_POST['Password']);

    $sql = "SELECT * FROM admin WHERE email='$uname' AND password='$pass'";
    $result = mysqli_query($con, $sql) or die("Query failed...");

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result))
        {
            session_start();
            $_SESSION['user_id'] = $row['a_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            echo "<script>alert('Login Successfully Done....');
            window.location.href='http://localhost/gymphp/admin/index.php';</script>";
        }
    }
    else{
        echo "<html><head><script>alert('Username OR Password is Invalid');</script></head></html>";
    }
}
?>