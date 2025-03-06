<?php
session_start();
error_reporting(0);
$con = mysqli_connect("localhost", "root", "", "gymnsb");

if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Ensure user is logged in
if (!isset($_SESSION['auth_user'])) {
    header("Location: http://localhost/gymphp/login.php");
    exit();
}

$user_id = $_SESSION['auth_user']['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id' AND role='normal_user'";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found in the database.");
}

// Handle form submission for updating the profile
if (isset($_POST['update_profile'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);

    // Verify that the user being updated matches the logged-in user
    if ($user['id'] != $id) {
        $_SESSION['message'] = "Unauthorized action.";
        header("Location: users.php");
        exit();
    }

    // Handle profile picture upload
    if (!empty($_FILES['profile_pic']['name'])) {
        $target_dir = "../admin/uploads/profiles/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
        }

        $file_name = time() . "_" . basename($_FILES['profile_pic']['name']); // Unique filename
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate image file
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            $_SESSION['message'] = "Invalid image format. Allowed formats: JPG, JPEG, PNG, GIF.";
            header("Location: users.php");
            exit();
        }

        if ($_FILES["profile_pic"]["size"] > 5000000) { // 5MB limit
            $_SESSION['message'] = "Image size too large. Max allowed size: 5MB.";
            header("Location: users.php");
            exit();
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            // Update the image in the database
            $update_image = "UPDATE users SET image = '$file_name' WHERE id = '$id'";
            if (mysqli_query($con, $update_image)) {
                $_SESSION['message'] = "Profile picture updated successfully!";
            } else {
                $_SESSION['message'] = "Error updating image: " . mysqli_error($con);
            }
        } else {
            $_SESSION['message'] = "Error uploading image.";
        }
    } else {
        $_SESSION['message'] = "No image selected for upload.";
    }

    // Redirect back to the profile page
    header("Location: users.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>FITNESS CLUB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/profile.css">

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        <?php if (isset($_SESSION['message'])) { ?>
            alertify.success('<?= $_SESSION['message'] ?>');
            <?php unset($_SESSION['message']); ?>
        <?php } ?>
    </script>
</head>

<body>
    <?php include "../include/nav.php" ?>
    <br><br><br>
    <div class="profile-container">
        <!-- Left Sidebar -->
        <div class="profile-sidebar">
            <img src="../admin/uploads/profiles/<?= htmlspecialchars($user['image'] ?? 'default.jpg') ?>" alt="Profile Picture" class="profile-picture">
            <h2 class="user-name"><?= htmlspecialchars($user['name'] ?? 'Unknown User') ?></h2>

            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-label">Join Date</div>
                    <div class="stat-value"><?= htmlspecialchars($user['join_date'] ?? 'N/A') ?></div>
                </div>
            </div>
        </div>

        <!-- Right Content -->
        <div class="profile-content">
            <hr>
            <form method="POST" enctype="multipart/form-data" class="profile-form">
                <div class="form-group full-width">
                    <strong><label for="profile_pic"><i class="fas fa-camera"></i> Update Profile Picture</label></strong>
                    <input type="file" id="profile_pic" name="profile_pic" accept="image/*">
                </div>

                <div class="form-group">
                    <strong><label for="name"><i class="fas fa-user"></i> User Name</label></strong>
                    <input type="hidden" id="id" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                    <input type="text" value="<?= htmlspecialchars($user['name']) ?>" readonly>
                </div>

                <div class="form-group">
                    <strong><label for="email"><i class="fas fa-envelope"></i> Email</label></strong>
                    <input type="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                </div>

                <div class="form-group">
                    <strong><label for="join_date"><i class="fas fa-calendar-alt"></i> Join Date</label></strong>
                    <input type="date" value="<?= htmlspecialchars($user['join_date']) ?>" readonly>
                </div>

                <div class="button-group">
                    <button type="submit" name="update_profile" class="btn-update">
                        <i class="fas fa-save"></i> Update Profile
                    </button>
                </div>
            </form>

            <div class="profile-actions">
                <a href="reser_password.php" class="btn"><i class="fas fa-lock"></i> Password</a>
                <a href="logout.php" class="btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>

    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="row mb-1">
                <div class="col-md-4 mb-5">
                    <br>
                    <h3>About us</h3>
                    <p class="mb-5">Our team of experienced trainers and staff are here to guide and support you every step of the way. Join us today and become a part of our fitness family!</p>
                    <ul class="list-unstyled footer-link d-flex footer-social">
                        <li><a href="https://x.com/" class="p-2"><span class="fa fa-twitter"></span></a></li>
                        <li><a href="https://www.facebook.com/facebook/" class="p-2"><span class="fa fa-facebook"></span></a></li>
                        <li><a href="https://www.linkedin.com/" class="p-2"><span class="fa fa-linkedin"></span></a></li>
                        <li><a href="https://www.instagram.com/" class="p-2"><span class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>
                <div class="col-md-5 mb-5">
                    <br>
                    <h3>Contact Info</h3>
                    <ul class="list-unstyled footer-link">
                        <li class="d-block">
                            <span class="d-block">Address:</span>
                            <span class="text-white">02-second floor, shyamdham chock, surat</span>
                        </li>
                        <li class="d-block"><span class="d-block">Telephone:</span><span class="text-white">+91 7567992211</span></li>
                        <li class="d-block"><span class="d-block">Email:</span><span class="text-white">khushianghan@gmail.com</span></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-5">
                    <br>
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled footer-link">
                        <li><a href="about.php">About</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Disclaimers</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-10 text-md-center text-left">
                    <br><br>
                    <p>created by :- Gymme</p><br>
                </div>
            </div>
        </div>
    </footer>

    <!-- Loader -->
    <div id="loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214" />
        </svg>
    </div>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>
    <script src="../js/costom.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/magnific-popup-options.js"></script>
    <script src="../js/main.js"></script>
</body>

</html>