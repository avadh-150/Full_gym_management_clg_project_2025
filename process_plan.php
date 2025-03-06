
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
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
<?php
session_start();
include "connection.php";
include "include/header.php";

// Ensure user is logged in
if (!isset($_SESSION['auth_user'])) {
    header("Location: login.php");
    exit();
}
if (isset($_POST["book_plan"])) {
    // Collect form data safely
    $full_name = mysqli_real_escape_string($con, $_POST['full_name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $membership_type = mysqli_real_escape_string($con, $_POST['membership_type']);
    $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $duration = mysqli_real_escape_string($con, $_POST['duration']);
    $plan_id = mysqli_real_escape_string($con, $_POST['plan_id']);
    $trainer_id = mysqli_real_escape_string($con, $_POST['trainer_id']);

    // Verify Email is same as logged-in email
    $sql_query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql_query);

    if (mysqli_num_rows($result) == 0) {
        $_SESSION['message'] = "Your Email ID is Not Associated With Your Login Email.";
        header("Location: plan_view.php");
        exit();
    }

    // Handle File Upload
    if (!empty($_FILES['image']['name'])) {
        $upload_dir = "admin/uploads/profiles/";
        $image_name = time() . "_" . basename($_FILES['image']['name']); // Ensure unique file names
        $image_tmp = $_FILES['image']['tmp_name'];
        $target_file = $upload_dir . $image_name;

        // Ensure upload directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($image_tmp, $target_file)) {
            $_SESSION['message'] = "Failed to upload image.";
            header("Location: plan_view.php");
            exit();
        }
    } else {
        $image_name = ""; // No image uploaded
    }

    // Generate a Unique Member ID securely
    $member_id = substr(hash('sha256', $phone . uniqid(mt_rand(), true)), 0, 12); 

    // Update User Information
    $query = "UPDATE users 
              SET full_name = '$full_name',
                  member_id = '$member_id', 
                  mobile = '$phone', 
                  gender = '$gender', 
                  address = '$address', 
                  image = '$image_name',  -- Only save image name, not full path
                  current_plan_id = '$plan_id', 
                  occupation = '$occupation',
                  role = 'member_user',
                  trainer_id = '$trainer_id'
              WHERE email = '$email'";

    if (mysqli_query($con, $query)) {
        $_SESSION['message'] = "Membership Added Successfully!";
        header("Location: plan_payment.php"); // Redirect to payment page
        exit();
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($con);
        header("Location: plan_view.php"); // Redirect back to form
        exit();
    }
} else {
    $_SESSION['message'] = "Failed to Collect the Details! Please try again.";
    header("Location: plan.php");
    exit();
}

?>
