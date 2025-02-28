<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
}

include "dbcon.php";

// Fetch product details for editing
$product = null;
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $result = $con->query("SELECT * FROM products WHERE id = $product_id");
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("Product not found.");
    }
} else {
    die("Invalid product ID.");
}

// Fetch categories to display in the dropdown
$categories = [];
$result = $con->query("SELECT id, name FROM product_categories WHERE status = 1");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
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
            <div id="breadcrumb"> 
                <a href="index.php" title="Go to Home" class="tip-bottom"><i class="fas fa-home"></i> Home</a>
                <a href="products.php" class="current">Product List</a><a href="#" class="current">Products Update</a>
            </div>
            <h1>Products Entry Form</h1>
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
                            <h5>Product - Update - information</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="edit-product-req.php" id="createProduct" method="POST" class="form-horizontal" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <div class="controls">
                                        <input type="text" class="span11" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" />

                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Category</label>
                                    <div class="controls">
                                        <select name="category_id" id="category_id">
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category['id'] ?>"
                                                    <?= $product['category_id'] == $category['id'] ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($category['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Price :</label>
                                    <div class="controls">
                                        <input type="number" class="span11" name="price" id="price" value="<?= htmlspecialchars($product['price']) ?>" min="0" step="0.01" />
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Image :</label>
                                    <div class="controls">
                                        <input type="file" id="imageInput" class="span11" name="image" onchange="previewImage(event)" />
                                        <!-- Display the existing product image -->
                                        <?php if (!empty($product['image'])): ?>
                                            <img id="currentImage" src="uploads/products/<?= $product['image'] ?>" alt="Product Image" style="max-width: 100px;" />
                                        <?php endif; ?>
                                        <!-- New image preview -->
                                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100px; max-height: 100px; margin-top: 10px;" />
                                    </div>
                                </div>
                                <script>
                                    function previewImage(event) {
                                        const file = event.target.files[0];
                                        const imagePreview = document.getElementById('imagePreview');
                                        const currentImage = document.getElementById('currentImage');

                                        if (file) {
                                            const reader = new FileReader();
                                            reader.onload = function(e) {
                                                // If current image exists, replace it
                                                if (currentImage) {
                                                    currentImage.src = e.target.result;
                                                } else {
                                                    // Otherwise, show the new image in the preview
                                                    imagePreview.src = e.target.result;
                                                    imagePreview.style.display = 'block';
                                                }
                                            };
                                            reader.readAsDataURL(file);
                                        }
                                    }
                                </script>

                                <div class="control-group">
                                    <div class="control-group">
                                        <label class="control-label">Available Quantity :</label>
                                        <div class="controls">
                                            <input type="number" class="span11" name="qty" value="<?php echo $product['quantity']; ?>" id="qty" />
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
                                    <textarea name="description" id="description"><?= htmlspecialchars($product['description']) ?></textarea>
                                    <script>
                                        CKEDITOR.replace('description');
                                    </script>
                                </div>
                            </div>
                            <div class="widget-content nopadding">
                                <div class="form-horizontal">
                                    <div class="form-actions text-center">
                                    <input type="hidden" class="span11" name="id" value="<?php echo $product['id']; ?>" id="id" />

                                        <button type="submit" name="submit-btn" class="btn btn-success">Update Product Details</button>
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

    <!-- <script src="../js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function() {
            // load product image with jquery
            $('#product_image').change(function() {
                readURL(this);
            })

            // add product
            $('#createProduct').submit(function(e) {
                e.preventDefault();
                $('.alert').hide();
                var title = $('#name').val();
                var cat = $('#category_id option:selected').val();
                var des = $('#description').val();
                var price = $('#price').val();
                var qty = $('#qty').val();
                var status = $('#status').val();
                var image = $('#image').val();
                if (title == '') {
                    $('#createProduct').prepend('<div class="alert alert-danger">Title Field is Empty.</div>');
                } else if (cat == '') {
                    $('#createProduct').prepend('<div class="alert alert-danger">Category Field is Empty.</div>');
                } else if (des == '') {
                    $('#createProduct').prepend('<div class="alert alert-danger">Description Field is Empty.</div>');
                } else if (price == '') {
                    $('#createProduct').prepend('<div class="alert alert-danger">Price Field is Empty.</div>');
                } else if (qty == '') {
                    $('#createProduct').prepend('<div class="alert alert-danger">Quantity Field is Empty.</div>');
                } else if (image == '') {
                    $('#createProduct').prepend('<div class="alert alert-danger">Image Field is Empty.</div>');
                }else{
                    $.ajax({
                        url: 'edit-product-req.php',
                        type: 'POST',
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response == 1) {
                                $('#createProduct').prepend('<div class="alert alert-success">Product Update successfully.</div>');
                                setTimeout(function() {
                                    window.location.href = 'products.php';
                                }, 2000);
                            } else {
                                $('#createProduct').prepend('<div class="alert alert-danger">Error Updating product.</div>');
                            }
                        }
                    });
                }

            });
        });
    </script> -->

    <!--end-main-container-part-->

    <!--Footer-part-->
    <?php include "includes/footer.php"?>
</body>

</html>