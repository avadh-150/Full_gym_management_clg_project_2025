<?php
session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php"; ?>
</head>

<body>
    <!-- Header -->
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>

    <!-- Top Header Menu -->
    <?php include 'includes/topheader.php'; ?>

    <!-- Sidebar Menu -->
    <?php 
    $page = 'plans-entry';
    include 'includes/sidebar.php'; 
    ?>

    <div id="content">
        <div id="content-header">
            <div id="breadcrumb">
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="products.php" class="current">Product List</a>
                <a href="#" class="current">Products Update</a>
            </div>
            <h1>Product Update</h1>
        </div>

        <form role="form" action="" method="POST" enctype="multipart/form-data">
            <?php
            if (isset($_POST['submit-btn'])) {
                include 'dbcon.php';

                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category_id = $_POST['category_id'];
                $quantity = $_POST['qty'];
                $status = isset($_POST['status']) ? 1 : 0;

                $upload_ok = true;
                $target_dir = "uploads/products/";
                $image = $_FILES['image']['name']; // Image filename
                $image_name = basename($_FILES['image']['name']);
                $target_file = $target_dir . $image_name;
                $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                
                // Ensure directory exists
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0755, true);
                }

                // Validate image upload
                if (!empty($image)) {
                    if ($_FILES['image']['error'] !== 0) {
                        echo "<p>Error: There was an issue uploading your file.</p>";
                        $upload_ok = false;
                    }

                    $check = getimagesize($_FILES['image']['tmp_name']);
                    if ($check === false) {
                        echo "<p>The file is not a valid image.</p>";
                        $upload_ok = false;
                    }

                    if ($_FILES['image']['size'] > 5242880) { // 5MB max
                        echo "<p>Sorry, your file is too large. Maximum size allowed is 5MB.</p>";
                        $upload_ok = false;
                    }

                    $allowed_file_types = ["jpg", "jpeg", "png", "gif"];
                    if (!in_array($image_file_type, $allowed_file_types)) {
                        echo "<p>Sorry, only JPG, JPEG, PNG, and GIF files are allowed.</p>";
                        $upload_ok = false;
                    }

                    // Attempt upload if validation passes
                    if ($upload_ok) {
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                            $image = $image_name;
                        } else {
                            echo "<p>Error: Unable to upload the file.</p>";
                            $upload_ok = false;
                        }
                    }
                }

                // If no new image is uploaded, retain the old one
                if (empty($image)) {
                    $image_query = "SELECT image FROM products WHERE id = $id";
                    $result = mysqli_query($con, $image_query);
                    if ($result && $row = mysqli_fetch_assoc($result)) {
                        $image = $row['image'];
                    }
                }

                if ($upload_ok) {
                    // Update the product in the database
                    $query = "UPDATE products SET 
                                name = '$name', 
                                image = '$image',
                                description = '$description', 
                                price = '$price', 
                                category_id = '$category_id', 
                                quantity = '$quantity', 
                                status = '$status'
                              WHERE id = $id";

                    $result = mysqli_query($con, $query);

                    if (!$result) {
                        echo "
                        <div class='container-fluid'>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='widget-box'>
                                        <div class='widget-title'> 
                                            <span class='icon'><i class='fas fa-info'></i></span>
                                            <h5>Error Message</h5>
                                        </div>
                                        <div class='widget-content'>
                                            <div class='error_ex'>
                                                <h1 style='color:maroon;'>Error 404</h1>
                                                <h3>Error occurred while updating product details</h3>
                                                <p>Please try again.</p>
                                                <a class='btn btn-warning btn-big' href='products.php'>Go Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    } else {
                        echo "
                        <div class='container-fluid'>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='widget-box'>
                                        <div class='widget-title'> 
                                            <span class='icon'><i class='fas fa-info'></i></span>
                                            <h5>Message</h5>
                                        </div>
                                        <div class='widget-content'>
                                            <div class='error_ex'>
                                                <h1>Success</h1>
                                                <h3>Product details have been updated!</h3>
                                                <p>Please click the button to go back.</p>
                                                <a class='btn btn-inverse btn-big' href='products.php'>Go Back</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                }
            }
            ?>
        </form>
    </div>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
</body>

</html>
