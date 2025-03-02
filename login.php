
<?php
session_start();
error_reporting(E_ALL);

include 'connection.php';
if (isset($_SESSION['auth_user'])) {
    header("location:http://localhost/gymphp/customer/pages/index.php");
}

$msg = "";

// Check for verification alert
if (isset($_SESSION['alert'])) {
    $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
    unset($_SESSION['alert']); // Clear the alert session
}

if (isset($_POST['submit'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql="SELECT * FROM users WHERE email = '$email' and password = '$password'";
       
        $result=mysqli_query($con,$sql);

        if (mysqli_num_rows($result)>0) {
            $row = mysqli_fetch_assoc($result);

           
                // $_SESSION['authenticated'] = true;
                $_SESSION['auth_user'] = [
                    "user_id" => $row['id'],
                    "username" => $row['username'],
                    "email" => $row['email']
                ];
                $_SESSION['message'] = "Login successful.";

                header("location:http://localhost/gymphp/index.php");
                exit();
           
           
        } else {
            $msg = "<div class='alert alert-danger'>Invalid email or password. Please try again.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>All fields are required.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Login Form - Brave Coder</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
        content="Login Form" />
    <!-- //Meta tag Keywords -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>
    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style_login.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <!-- -->
                    <div class="w3l_form align-self">
                    <img src="img/Gym-Logo.png" alt="">
                    </div>
                    <div class="content-wthree">
                        <h2>Login Now</h2>
                        <p>Here login to access the new features in our fitness club </p>
                        <?php echo $msg; ?>
                        <form action="" method="post">
                            <input type="email" class="email" name="email" placeholder="Enter Your Email" required>
                            <div style="position: relative;">
                                <input type="password" id="password" class="password" name="password" placeholder="Enter Your Password" required>
                                <i class="fa-solid fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 40%; transform: translateY(-50%); cursor: pointer;"></i>
                            </div>

                            <span id="pass-error" style="color: red;"></span>
                            <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; text-align: right;">Forgot Password?</a></p>
                            <button name="submit" name="submit" class="btn" type="submit">Login</button>
                        </form>
                        <div class="social-icons">
                            <p>Create Account! <a href="register.php">Register</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
   
<script>
function validatePassword() {
    const password = document.getElementById('password').value;
    const errorSpan = document.getElementById('pass-error');
    
    // Clear previous error message
    errorSpan.textContent = "";
    
    // Check minimum length
    if (password.length < 8) {
        errorSpan.textContent = "Password must be at least 8 characters long";
        return false;
    }
    
    // Check for uppercase letter
    if (!/[A-Z]/.test(password)) {
        errorSpan.textContent = "Password must contain at least one uppercase letter";
        return false;
    }
    
    // Check for lowercase letter
    if (!/[a-z]/.test(password)) {
        errorSpan.textContent = "Password must contain at least one lowercase letter";
        return false;
    }
    
    // Check for digit
    if (!/[0-9]/.test(password)) {
        errorSpan.textContent = "Password must contain at least one digit";
        return false;
    }
    
    // Check for special character
    if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        errorSpan.textContent = "Password must contain at least one special character";
        return false;
    }
    
    return true;
}

// Add form submit event listener
document.querySelector('form').addEventListener('submit', function(e) {
    if (!validatePassword()) {
        e.preventDefault(); // Prevent form submission if validation fails
    }
});
document.getElementById("togglePassword").addEventListener("click", function() {
        let passwordField = document.getElementById("password");
        let eyeIcon = document.getElementById("togglePassword");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
});
</script>
<!-- <script>
        function validatePassword() {
            const password = document.getElementById('password').value;
            const errorSpan = document.getElementById('pass-error');

            // Validate password length and character requirements
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W]).{8,}$/;
            if (!passwordRegex.test(password)) {
                errorSpan.textContent = "Password must be at least 8 characters long and include uppercase, lowercase, digit, and special character.";
                return false;
            }

            // Validate passwords match
           

            return true;
        }
    
        document.getElementById("togglePassword").addEventListener("click", function() {
        let passwordField = document.getElementById("password");
        let eyeIcon = document.getElementById("togglePassword");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    });
</script> -->

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