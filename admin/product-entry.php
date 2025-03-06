<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

include "dbcon.php"; // Make sure dbcon.php has your database connection

// Fetch categories to display in the dropdown
$categories = [];
$result = $con->query("SELECT id, name FROM product_categories WHERE status = 1");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Handle form submission for adding a product
if (isset($_POST['submit-btn'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    // $quality = $_POST['quality'];
    $quantity = $_POST['qty'];  // New field for quantity
    $status = isset($_POST['status']) ? 1 : 0;

    // Image upload logic
    $image = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $image_name = $_FILES['image']['name'];
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

    // Generate a unique name for the image
    $image_new_name = uniqid('', true) . '.' . $image_extension;

    // Define the path where the image will be uploaded
    $upload_directory = 'uploads/products/';
    $image_path = $upload_directory . $image_new_name;

    // Move the uploaded file to the "uploads" folder
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
        // Save only the image name, not the full path
        $image = $image_new_name;
    }
}

    if (!empty($name) && !empty($price) && !empty($category_id)) {
        // Insert the product into the database, including quantity
        $query = "INSERT INTO products (name, image,description, price, category_id,  quantity, status) 
                  VALUES ('$name', '$image','$description', '$price', '$category_id', '$quantity', '$status')";
        
        if (mysqli_query($con, $query)) {
            echo "<script>alert('Product added successfully!'); window.location.href = 'products.php';</script>";
        } else {
            $message = "Error adding product: " . mysqli_error($con);
        }
    } else {
        $message = "Please fill in all required fields.";
    }
}

?>
<!-- Visit codeastro.com for more projects -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/header.php" ?>
</head>

<body>

    <!--Header-part--><!-- Visit codeastro.com for more projects -->
    <div id="header">
        <h1><a href="dashboard.html">Perfect Gym Admin</a></h1>
    </div>
    <!--close-Header-part-->


    <!--top-Header-menu-->
    <?php include 'includes/topheader.php' ?>

    <?php $page = 'product-entry';
    include 'includes/sidebar.php' ?>
    <!--sidebar-menu-->
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="products.php" class="current">Product List</a><a href="#" class="current">Products Entry</a>
            </div>
            <!-- <h1>Products Entry Form</h1> -->
        </div>
        <!-- Message Display -->
        <?php if (isset($message)): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                            <h5>Plans-information</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="" id="createProduct" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <div class="controls">
                                        <input type="text" class="span11" name="name" placeholder="product Name" />

                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Add Category :</label>
                                    <div class="controls">
                                        <select id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <span class="help-block">Note: please enter the duration of the plan in days <br> like 30 for 30 days, 365 for 365 days</span> -->
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Price :</label>
                                    <div class="controls">
                                        <input type="number" class="span11" name="price" placeholder="Price" min="0" step="0.01" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="control-group">
                                        <label class="control-label">Image :</label>
                                        <div class="controls">
                                            <input type="file" id="imageInput" class="span11" name="image" placeholder="Image" onchange="previewImage(event)" />
                                            <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px; margin-top: 10px;" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function previewImage(event) {
                                        const input = event.target;
                                        const preview = document.getElementById('imagePreview');

                                        if (input.files && input.files[0]) {
                                            const reader = new FileReader();

                                            reader.onload = function(e) {
                                                preview.src = e.target.result;
                                                preview.style.display = 'block';
                                            }

                                            reader.readAsDataURL(input.files[0]);
                                        } else {
                                            preview.src = '#';
                                            preview.style.display = 'none';
                                        }
                                    }
                                </script>
                                <div class="control-group">
                                    <div class="control-group">
                                        <label class="control-label">Available Quantity :</label>
                                        <div class="controls">
                                            <input type="Number" class="span11" name="qty" placeholder="Quantity" />
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="control-group">
                                        <label class="control-label">Display Status :</label>
                                        <div class="controls">

                                            <input type="checkbox" id="status" name="status" checked><label for="status">Check to Display</label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="fas fa-align-justify"></i> </span>
                            <h5>Description Details</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <div class="form-horizontal">
                                <div class="control-group">
                                    <!-- <label for="normal" class="control-label">Product description:</label> -->
                                    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
                                    <textarea name="description" id="description"></textarea>
                                    <script>
                                        CKEDITOR.replace('description');
                                    </script>
                                </div>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="form-horizontal">
                                    <div class="form-actions text-center">
                                        <button type="submit" name="submit-btn" class="btn btn-success">Submit Product Details</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

   

    <!--end-main-container-part-->

    <!--Footer-part-->
    <?php include "includes/footer.php" ?>
</body>

</html>