<?php
session_start();
error_reporting(0);
// include '../admin/dbcon.php ';
$con = mysqli_connect("localhost", "root", "", "gymnsb");

// Check if user is logged in
// if (!isset($_SESSION['auth_user'])) {
//     header("Location: http://localhost/gymphp/login.php");
//     exit();
// }

// Fetch user data from database
$user_id = $_SESSION['auth_user']['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id' AND role='member_user'";
$result = $con->query($sql);
$user = $result->fetch_assoc();

$member_id = $user['member_id'];
$membership_query = "SELECT mp.*, p.plan_name as plan_name FROM member_plans mp JOIN membership_plans p ON mp.plan_id = p.id WHERE mp.member_id = '$member_id'";
$membership_result = $con->query($membership_query);
$membership = $membership_result->fetch_assoc();


?>

<!doctype html>
<html lang="en">

<head>
    <title>FITNESS CLUB

    </title>
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

    <!-- Theme Style -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- <link rel="stylesheet" href="../css/plan.css"> -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        <?php

        if (isset($_SESSION['message'])) {
        ?>
            alertify.set('notifier', 'position', 'top-right');


            alertify.success('<?= $_SESSION['message'] ?>');
        <?php
            unset($_SESSION['message']);
        } ?>
    </script>
</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="css/profile.css">

<body>
    <?php include "../include/nav.php" ?>
    <br>
    <br>
    <br>
    <div class="profile-container">
        <!-- Left Sidebar -->

        <div class="profile-sidebar">
            <img src="../admin/uploads/profiles/<?= $user['image'] ?>"
                alt="Profile Picture"
                class="profile-picture">
            <h2 class="user-name"><?= htmlspecialchars($user['full_name']) ?? $user['name'] ?></h2>


            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-label">Membership</div>
                    <div class="stat-value"><?= $membership['plan_name'] ?? '--' ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Height</div>
                    <div class="stat-value"><?= $user['Height'] ?? '--' ?> cm</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Weight</div>
                    <div class="stat-value"><?= $user['Weight'] ?? '--' ?> kg</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Member Since</div>
                    <div class="stat-value"><?= date('Y', strtotime($user['join_date'])) ?? '--' ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Start Date</div>
                    <div class="stat-value"><?= $membership['start_date'] ?? '--' ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Expire Date</div>
                    <div class="stat-value"><?= $membership['end_date'] ?? '--' ?></div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Status</div>
                    <div class="stat-value"><?= $membership['status'] == '1' ? 'Active' : 'Inactive' ?? '--' ?></div>
                </div>
            </div>
        </div>

        <!-- Right Content -->
        <div class="profile-content">
            <div class="col-md-12" style='text-align: center;'>
                <?php

                if ($user['Height'] == 0 || $user['Weight'] == 0 || $user['Age'] == 0) {
                    echo " <p class='bg-danger text-white p-2 rounded'>Please Complete Your Profile</p>";
                } else {
                    echo "<h6 class='bg-success text-white p-2 rounded'>Profile Complete</h6>";
                }

                ?>
            </div>
            <hr>
            <form method="POST" enctype="multipart/form-data" class="profile-form">

                <div class="form-group full-width">

                    <strong> <label for="profile_pic"><i class="fas fa-camera"></i> Update Profile Picture</label></strong>
                    <input type="file" id="profile_pic" name="profile_pic" accept="image/*">
                </div>

                <div class="form-group">
                    <strong><label for="name"><i class="fas fa-user"></i>Member ID</label></strong>
                    <input type="text" id="member_id" name="member_id" value="<?= $user['member_id'] ?>" readonly>
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
                    <strong><label for="gender"><i class="fas fa-venus-mars"></i> Gender</label></strong>
                    <input type="text" id="gender" name="gender" value="<?= htmlspecialchars($user['gender']) ?>">
                </div>
                <div class="form-group">
                    <strong><label for="phone"><i class="fas fa-phone"></i> Phone</label></strong>
                    <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user['mobile']) ?>">
                </div>

                <div class="form-group">
                    <strong><label for="address"><i class="fas fa-map-marker-alt"></i> Address </label></strong>
                    <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>">
                </div>


                <div class="form-group">
                    <strong><label for="occupation"><i class="fas fa-briefcase"></i> Occupation</label></strong>
                    <input type="text" id="occupation" name="occupation" value="<?= htmlspecialchars($user['occupation']) ?>">
                </div>
                <div class="form-group">
                    <strong><label for="join_date"><i class="fas fa-calendar-alt"></i> Join Date</label></strong>
                    <input type="date" value="<?= htmlspecialchars($user['join_date']) ?>" readonly>
                </div>
                <?php
                if ($user['Height'] == '0' || $user['Weight'] == '0' || $user['Age'] == '0') {
                ?>
                    <div class="form-group">
                        <strong><label for="height"><i class="fas fa-ruler-vertical"></i> Height (cm)</label></strong>
                        <input type="number" id="height" name="height">
                    </div>

                    <div class="form-group">
                        <strong><label for="weight"><i class="fas fa-weight"></i> Weight (kg)</label></strong>
                        <input type="number" id="weight" name="weight">
                    </div>
                    <div class="form-group">
                        <strong><label for="age"><i class="fa-solid fa-input-numeric"></i> Age</label></strong>
                        <input type="number" id="age" name="age">
                    </div>

                <?php
                } else {
                ?>
                    <div class="form-group">
                        <strong><label for="height"><i class="fas fa-ruler-vertical"></i> Height (cm)</label></strong>
                        <input type="number" id="height" name="height" value="<?= htmlspecialchars($user['Height']) ?>">
                    </div>

                    <div class="form-group">
                        <strong><label for="weight"><i class="fas fa-weight"></i> Weight (kg)</label></strong>
                        <input type="number" id="weight" name="weight" value="<?= htmlspecialchars($user['Weight']) ?>">
                    </div>
                    <div class="form-group">
                        <strong><label for="age"><i class="fa-solid fa-input-numeric"></i> Age</label></strong>
                        <input type="number" id="age" name="age" value="<?= htmlspecialchars($user['Age']) ?>">
                    </div>
                    <?php
                    if ($user['trainer_id']) {
                        $tid = mysqli_real_escape_string($con, $user['trainer_id']);
                        $sql = "SELECT * FROM trainers WHERE id = '$tid'"; // Ensure correct column name
                        $sql_query = mysqli_query($con, $sql);

                        $trainers = mysqli_fetch_assoc($sql_query);
                    ?>
                        <div class="form-group">
                            <a href="../trainers/profile.php?id=<?php echo $tid; ?>">
                                <strong><label for="trainer"><i class="fa-solid fa-input-numeric"></i>Your Trainer</label></strong>

                                <input type="text" value="<?= htmlspecialchars($trainers['name']) ?>" readonly>
                            </a>
                        </div>
                    <?php } ?>
                <?php
                }
                ?>
                <div class="button-group">
                    <button type="submit" name="update_profile" class="btn-update">
                        <i class="fas fa-save"></i> Update Profile
                    </button>
                </div>
            </form>

            <div class="profile-actions">
                <a href="reser_password.php" class="btn"><i class="fas fa-lock"></i> Password</a>
                <a href="chatbot.php" class="btn"><i class="fa-solid fa-comment"></i> Chat Support</a>

                <a href="membershipcard.php?id=<?php echo $user['member_id']; ?>" target="_blank" class="btn"><i class="fas fa-id-card"></i> Membership Card</a>
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
                    <!-- <br> -->
                    <p class="mb-5">our team of experienced trainers and staff are here to guide and support you every step of the way. join us today and bbecome a part of our fitness family!</p>
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
                    <!-- <br> -->
                    <ul class="list-unstyled footer-link">
                        <li class="d-block">
                            <span class="d-block">Address:</span>
                            <span class="text-white">02-second floor,
                                shyamdham chock, surat</span>
                        </li>
                        <li class="d-block"><span class="d-block">Telephone:</span><span class="text-white">+91 7567992211</span></li>
                        <li class="d-block"><span class="d-block">Email:</span><span class="text-white">khushianghan@gmail.com</span></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-5">
                    <br>
                    <h3>Quick Links</h3>
                    <!-- <br> -->
                    <ul class="list-unstyled footer-link">
                        <li><a href="about.php">About</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Disclaimers</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">

                </div>
            </div>
            <div class="row">
                <div class="col-10 text-md-center text-left">
                    <br>
                    <br>
                    <p>created by :- Gymme</p><br>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214" />
        </svg></div>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/owl.carousel.min.js"></script>
    <script src="../js/jquery.waypoints.min.js"></script>


    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        <?php

        if (isset($_SESSION['messsage'])) {
        ?>
            alertify.success('<?= $_SESSION['messsage'] ?>');
        <?php
            unset($_SESSION['messsage']);
        } ?>
    </script>

    <script src="../js/costom.js"></script>
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script src="../js/magnific-popup-options.js"></script>

    <script src="../js/main.js"></script>
</body>

</html>


<?php
session_start();
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
if (isset($_POST['update_profile'])) {
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
    $height = mysqli_real_escape_string($con, $_POST['height']);
    $weight = mysqli_real_escape_string($con, $_POST['weight']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $id = mysqli_real_escape_string($con, $_POST['id']);

    // Handle profile picture upload
    if (!empty($_FILES['profile_pic']['name'])) {
        $target_dir = "../admin/uploads/profiles/";
        $file_name = time() . "_" . basename($_FILES['profile_pic']['name']); // Prevents duplicate names
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate image file
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            $_SESSION['message'] = "Invalid image format. Allowed formats: JPG, JPEG, PNG, GIF.";
            echo "<script>alert('Invalid image format. Allowed formats: JPG, JPEG, PNG, GIF');
            window.location.href = 'profile.php';
            exit();
            </script>";
        }

        if ($_FILES["profile_pic"]["size"] > 5000000) { // 5MB limit
            $_SESSION['message'] = "Image size too large. Max allowed size: 5MB.";
            echo "<script>alert('Image size too large. Max allowed size: 5MB');
            window.location.href = 'profile.php';
            exit();
            </script>";
        }

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            // Save only the file name in the database
            $update_image = "UPDATE users SET image = '$file_name' WHERE id = '$id'";
            mysqli_query($con, $update_image);
        } else {
            $_SESSION['message'] = "Error uploading image.";
            echo "<script>alert('Error: " . mysqli_error($con) . "');
            window.location.href = 'profile.php';
            </script>";
            exit();
        }
    }

    // Update user details
    $update_query = "UPDATE users SET 
                        gender = '$gender', 
                        mobile = '$phone', 
                        address = '$address', 
                        occupation = '$occupation', 
                        Height = '$height', 
                        Weight = '$weight', 
                        Age = '$age' 
                    WHERE id = '$id'";

    if (mysqli_query($con, $update_query)) {
        $_SESSION['message'] = "Profile Updated Successfully!";
        echo "<script>alert('Profile Updated Successfully!');
        window.location.href = 'profile.php';
        </script>";
    } else {
        $_SESSION['message'] = "Error updating profile: " . mysqli_error($con);
        echo "<script>alert('Error: " . mysqli_error($con) . "');
        window.location.href = 'profile.php';
        </script>";
    }
}


?>