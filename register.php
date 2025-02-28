<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
if (isset($_SESSION['auth_user'])) {
    header("Location: welcome.php");
    die();
}

// Load Composer's autoloader
require 'vendor/autoload.php';

include 'connection.php';
$msg = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm-password']);
    $code = md5(rand());

    // Server-side password validation
    if (
        strlen($_POST['password']) < 8 ||
        !preg_match('/[A-Z]/', $_POST['password']) ||
        !preg_match('/[a-z]/', $_POST['password']) ||
        !preg_match('/[0-9]/', $_POST['password']) ||
        !preg_match('/[\W]/', $_POST['password'])
    ) {
        $msg = "<h3 class='alert alert-danger'>Password must be at least 8 characters long and include uppercase, lowercase, digit, and special character.</h3>";
    } elseif ($_POST['password'] !== $_POST['confirm-password']) {
        $msg = "<h3 class='alert alert-danger'>Passwords do not match.</h3>";
    } elseif (mysqli_num_rows(mysqli_query($con, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>{$email} - This email address already exists.</div>";
    } else {
        $sql = "INSERT INTO users (name, email, password, code) VALUES ('{$name}', '{$email}', '{$password}', '{$code}')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $_SESSION['message'] = "Registration successful. Please Login";
            header("Location: login.php");
        } else {
            $msg = "<div class='alert alert-danger'>Something went wrong. Please try again later.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Register - Gym Site</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_login.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>
    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Form Section -->
    <section class="w3l-mockup-form">
        <div class="container">
            <div class="workinghny-form-grid">
                <div class="main-mockup">

                    <div class="w3l_form align-self">

                        <img src="img/logo.png" alt="">

                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>
                        <p>Create Account And Get Starting Your Fitness Journey</p>
                        <?php echo $msg; ?>
                        <form action="" method="post" onsubmit="return validatePassword()">
                            <input type="text" class="name" name="name" placeholder="Enter Your Name" required>
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <div style="position: relative;">
                                <input type="password" id="password" class="password" name="password" placeholder="Enter Your Password" required>
                                <i class="fa-solid fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 40%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>

                            <span id="pass-error" style="color: red;"></span>

                            <div style="position: relative;">
                                <input type="password" id="confirm-password" class="confirm-password" name="confirm-password" placeholder="Enter Your Confirm Password" required>
                                <i class="fa fa-eye" id="toggleConfirmPassword" style="position: absolute; right: 10px; top: 40%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>

                            <button name="submit" class="btn" type="submit">Register</button>
                        </form>
                        <div class="social-icons">
                            <p>Have an account? <a href="login.php">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript for Client-Side Validation -->
    <script>
        function validatePassword() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const errorSpan = document.getElementById('pass-error');

            // Validate password length and character requirements
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}$/;
            if (!passwordRegex.test(password)) {
                errorSpan.textContent = "Password must be at least 8 characters long and include uppercase, lowercase, digit, and special character.";
                return false;
            }

            // Validate passwords match
            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }

        function togglePasswordVisibility(inputId, iconId) {
            let passwordField = document.getElementById(inputId);
            let eyeIcon = document.getElementById(iconId);

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        document.getElementById("togglePassword").addEventListener("click", function() {
            togglePasswordVisibility("password", "togglePassword");
        });

        document.getElementById("toggleConfirmPassword").addEventListener("click", function() {
            togglePasswordVisibility("confirm-password", "toggleConfirmPassword");
        });
    </script>


<script>

  alertify.set('notifier', 'position', 'top-right');
  <?php
 
  if (isset($_SESSION['message'])) 
  {
  ?>
  alertify.set('notifier', 'position', 'top-right');


    alertify.success('<?= $_SESSION['message'] ?>');
  <?php
  unset($_SESSION['message']);
  } ?>
</script>

</body>

</html>